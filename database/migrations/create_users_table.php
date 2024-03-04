<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('rol');
            $table->string('telefono')->nullable();
            $table->unsignedBigInteger('id_empresa')->nullable();
            $table->rememberToken();
            $table->foreign('id_empresa')->references('id')->on('empresas');
            $table->timestamps();
        });

        // Crear el usuario por defecto
        $defaultUser = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('abc123.,'),
            'rol' => 'admin',
            'telefono' => null,
            'id_empresa' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('users')->insert($defaultUser);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
