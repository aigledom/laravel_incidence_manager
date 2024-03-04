<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Consultas
{
    public static function roles()
    {
        return json_decode(file_get_contents(base_path('public/json/roles.json')));
    }
    public static function getCamposIncidencia()
    {
        // Se obtiene la lista de campos disponibles en la tabla 'incidencias'
        $camposIncidencias = Schema::getColumnListing('incidencias');
        // Excluye los campos innecesarios y lo devuelve
        $camposIncidencias = array_diff($camposIncidencias, ['id', 'id_cat', 'fecha_resolucion', 'created_at', 'updated_at', 'fecha_creacion', 'estado']);
        return $camposIncidencias;
    }

    public static function getCamposNulos($campos)
    {
        $camposNulos = [];
        // Obtengo info de si es nullable
        $columnasInfo = DB::select("SELECT COLUMN_NAME, IS_NULLABLE FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = 'incidencias'");
        foreach ($columnasInfo as $columna) {
            // Verifica si el campo es nullable y si está en la lista de campos
            if ($columna->IS_NULLABLE == 'YES' && in_array($columna->COLUMN_NAME, $campos)) {
                $camposNulos[] = $columna->COLUMN_NAME;
            }
        }
        return $camposNulos;
    }

    public static function updateCampos($camposNulos)
    {
        //Elimina la restricción de clave foránea si existe
        if (Consultas::hasForeignKey('webincidencias', 'incidencias', 'FK_incidencias_id_cat')) {
            DB::statement("ALTER TABLE incidencias DROP FOREIGN KEY FK_incidencias_id_cat");
        }
        //Se recogen los campos elegidos como nulos
        // Actualiza la estructura de la tabla 'incidencias' para reflejar las selecciones del administrador
        Schema::table('incidencias', function ($table) use ($camposNulos) {
            $table->timestamps = false;
            foreach (Consultas::getCamposIncidencia() as $campo) {
                //Recojo el tipo que tiene el campo en la base de datos
                $columnType =  DB::getDoctrineColumn('incidencias', $campo)->getType()->getName();
                //Cambia los tipos a los que son correctos en BDD
                if ($columnType == 'string') $columnType = "VARCHAR(255)";
                if ($columnType == 'bigint') $columnType = "BIGINT(20)";
                if (in_array($campo, $camposNulos)) {
                    //Lo actualizo a nulo manteniendo su tipo
                    $sql = "ALTER TABLE incidencias MODIFY $campo $columnType NULL";
                } else {
                    //Lo actualizo a no nulo manteniendo su tipo
                    $sql = "ALTER TABLE incidencias MODIFY $campo $columnType NOT NULL";
                };
                DB::update($sql);
            }
        });
        // Restablecer la restricción de clave foránea si es necesario
        Schema::table('incidencias', function ($table) {
            $table->foreign('id_cat', 'FK_incidencias_id_cat')->references('id')->on('categorias');
        });
    }

    private static function hasForeignKey($schema, $table, $constraint)
    {
        $query =
            "SELECT CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = '$schema'
            AND TABLE_NAME = '$table'
            AND CONSTRAINT_NAME = '$constraint'";
        if (!empty(DB::select($query))) {
            return true;
        }
        return false;
    }

    public static function getIncidencias()
    {
        return  DB::table('incidencias')->leftJoin('categorias', 'incidencias.id_cat', '=', 'categorias.id')->where("id_empresa", auth()->user()->id_empresa)->get();
    }

    public static function getUsuariosIncidencia($id_cat)
    {
        return  DB::table('users')->leftJoin('empresas', 'users.id_empresa', '=', 'empresas.id')->leftJoin('categorias', 'empresas.id', '=', 'categorias.id_empresa')->where("categorias.id", $id_cat)->get();
    }

    public static function getNivel()
    {
        if (auth()->check()) {
            $r = array_filter(Consultas::roles()->roles, function ($rol) {
                return ($rol->name == ucfirst(auth()->user()->rol));
            });
            return reset($r)->nivel;
        }
        return false;
    }

    public static function getRolesInferiores($nivel)
    {
        if (auth()->check()) {
            $roles = array_filter(Consultas::roles()->roles, function ($rol) use ($nivel) {
                return ($rol->nivel < $nivel && $rol->name != "sinRol");
            });
            return $roles;
        }
        return false;
    }
}
