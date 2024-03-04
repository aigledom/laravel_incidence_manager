<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva incidencia</title>
</head>

<body style="margin: 0; padding: 0; box-sizing: border-box; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;background-color: rgba(52, 58, 64, 0.25); width:100%;">

    <!--LOGO HEADER-->
    <header style="margin:auto; text-align: center;">
        <img src="https://lh3.google.com/u/0/d/14hZ2953LQjPcKkuKGuknY-o9evD-uDij=w1920-h953-iv1" class="logo" border="0" style="max-width:736px;">
    </header>

    <!--BLUE DIVIDER-->
    <div style="text-align: center;">
        <span style="padding: 0.5rem 3rem; width:640px; margin:auto; display: block; background-color: rgba(0, 123, 255, 0.75); border-top-right-radius: 0.25rem; border-top-left-radius: 0.25rem;"></span>
    </div>

    <!--MAIN CONTENT-->
    <main style="text-align: center;">

        <div style="margin:auto; background-color: #f8f9fa; padding: 2rem 3rem; width:640px; text-align: justify;">

            <h2 style="color: rgba(0, 123, 255, 0.75);">Estimado {{$nombreUsuario ?? 'Usuario'}}</h2>

            <p>Te informamos que se ha creado una nueva incidencia que ha sido asignada a ti. A continuación, encontrarás
                los detalles de la incidencia:</p>

            <ul style="list-style: none; padding: 0; margin: 0; background-color: #f8f9fa; border-radius: .25rem; box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);">

                <li style="background-color: rgba(0,123,255,.03); padding: .75rem 1.25rem; border-bottom: 1px solid rgba(0, 123, 255, 0.125);">
                    <strong>Número de incidencia: </strong>
                    {{$incidencia->id ?? 'Número de incidencia no disponible'}}
                </li>

                <li style="background-color: rgba(0,123,255,.03); padding: .75rem 1.25rem; border-bottom: 1px solid rgba(0, 123, 255, 0.125);">
                    <strong>Categoría: </strong>
                    {{$nombreCategoria ?? 'Categoría no disponible'}}
                </li>

                <li style="background-color: rgba(0,123,255,.03); padding: .75rem 1.25rem; border-bottom: 1px solid rgba(0, 123, 255, 0.125);">
                    <strong>Fecha de creación: </strong>
                    {{$incidencia->fecha_creacion ?? 'Fecha de creación no disponible'}}
                </li>
                <li style="background-color: rgba(0,123,255,.03); padding: .75rem 1.25rem;">
                    <strong>Descripción: </strong>
                    {{$incidencia->descripcion ?? 'No hay descripción'}}
                </li>
            </ul>

            <p class="pt-4">Por favor, toma las medidas necesarias para abordar esta incidencia en el menor tiempo
                posible. Si tienes alguna pregunta o necesitas más información, no dudes en ponerte en contacto con el
                equipo de soporte.</p>

            <p>¡Gracias por tu atención!<br>
                <span style="padding-left: .5rem;">Atentamente,</span><br>
                <span style="padding-left: .5rem;">{{env('NOMBRE_AYUNTAMIENTO','NOMBRE AYUNTAMIENTO')}}</span>
            </p>

            <div style="text-align: center; margin-top: 20px;">
                <a href="{{env('WEBSITE','web.prueba.com').'/incidencias/'.($incidencia->id ?? '')}}" style="text-decoration: none; color: rgba(0, 123, 255, 0.75); padding: .375rem .75rem; border: 1px solid rgba(0, 123, 255, 0.75); border-radius: .25rem; background-color: #fff; cursor: pointer; font-size: 1rem; line-height: 1.5; outline: none; transition: color .15s, background-color .15s, border-color .15s; text-align: center; display: inline-block;">Ver
                    Incidencia</a>
            </div>

        </div>

    </main>

    <!--FOoter-->
    <footer style="text-align: center; align-content: center; margin-bottom:2rem">

        <div style="margin:auto; background-color: rgba(0, 123, 255, 0.75); text-align: center; align-content: center; flex-direction: column; border-bottom-right-radius: 0.25rem; border-bottom-left-radius: 0.25rem; padding: 1.5rem 3rem; width:640px;">
            <h3 style="color: #fff; margin: 0;">Datos de contacto</h3>
            <div id="metodosContacto" style="display: flex; justify-content: space-around; align-content: center; padding: 1rem 0;">
                <div style="margin: auto; display: flex; justify-content: space-around; align-content: center;border: 1px solid rgba(160,160,160,.6); background-color: rgba(240, 173, 78, .4);border-radius:0.5em;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/Phone_font_awesome.svg/240px-Phone_font_awesome.svg.png" alt="Teléfono" style="width: 2.5em; height: 2.5em; background-color: rgba(240, 173, 78, 0.8);border-radius: 0.25rem; padding: 0.2rem;">
                    <a style="color: #fff; margin:auto;padding:0 0.3rem;">{{env('TELEFONO','123546789')}}</a>
                </div>
                <div style="margin: auto; display: flex; justify-content: space-around; align-content: center;border: 1px solid rgba(160,160,160,.6); background-color: rgba(217, 83, 79, .4);border-radius:0.5em;">
                    <img src="https://icons.iconarchive.com/icons/fa-team/fontawesome/256/FontAwesome-Envelope-icon.png" alt="Mail" style="width: 2.5em; height: 2.5em; background-color: rgba(41, 43, 44, 0.8);border-radius: 0.25rem; padding: 0.2rem;">
                    <a style="color: #fff; margin:auto;padding:0 0.3rem;">{{env('MAIL','evelb.prueba@gmail.com')}}</a>
                </div>
                <div style="margin: auto; display: flex; justify-content: space-around; align-content: center;border: 1px solid rgba(160,160,160,.6); background-color: rgba(41, 43, 44, .4);border-radius:0.5em;">
                    <img src="https://icons.iconarchive.com/icons/fa-team/fontawesome/256/FontAwesome-Globe-icon.png" alt="Web" style="width: 2.5em; height: 2.5em; background-color: rgba(217, 83, 79, 0.8);border-radius: 0.25rem; padding: 0.2rem;">
                    <a style="color: #fff; margin:auto;padding:0 0.3rem;">{{env('WEBSITE','web.prueba.com')}}</a>
                </div>
            </div>
        </div>
    </footer>
    <div style="height: 100%;"></div>
</body>

</html>