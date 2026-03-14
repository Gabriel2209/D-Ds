


<!DOCTYPE html>
<html>

<head>
    <title>Netflix</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <header>
        <div class="logo-continer">
            <a href="index.html">
                <img src="utilidades/img/logo_netflix.png" alt="netflix">
            </a>
        </div>
    </header>
    <main>
        <form action="registrado.html" method="POST">
            <h1>Formulario de Registro</h1>

            <label for="nombre">Nombre Completo:
                <input type="text" id="nombre" name="nombre" required>
            </label>
            <label for="cedula">Cedula:
                <input type="text" id="cedula" name="cedula" required>
            </label>
            <label for="email">Correo Electrónico:
                <input type="email" id="email" name="email" required>
                <p id="error-email"></p>
            </label>
            <label for="password">
                Contraseña:
                <input type="password" id="password" name="password" required>
            </label>
            <label for="verified-password">
                Confirmar contraseña:
                <input type="password" id="verified-password" name="verified-password" required>
                <p id="error-pass"></p>
            </label>
            <label for="fechaNac">Fecha de nacimiento:
                <input type="date" id="fechaNac" name="fechaNac" required>
            </label>
            <label for="telefono">Teléfono:
                <input type="tel" id="telefono" name="telefono" required>
            </label>
            <fieldset>
                <legend>Género</legend>
                <label for="generoM">
                    Masculino
                    <input type="radio" id="generoM" name="genero" value="Masculino" required>
                </label>
                <label for="generoF">
                    Femenino
                    <input type="radio" id="generoF" name="genero" value="femenino">
                </label>
            </fieldset>
            <label for="preferencias">
                Géneros favoritos:
                <textarea name="preferencias" id="preferencias" maxlength="35"
                    placeholder="Ej: Acción, Comedia, Drama."></textarea>
            </label>
            <label for="terminos">
                <input type="checkbox" id="terminos" name="terminos" required>
                Aceptar Terminos y Condiciones
            </label>

            <button type="submit" id="btnRegistrarse">Registrarse</button>
        </form>
    </main>
    <footer>
        <div class="Flinks">
            <a href="https://help.netflix.com/support/412">Preguntas frecuentes</a>
            <a href="https://help.netflix.com/">Centro de ayuda</a>
            <a href="https://www.netflix.com/youraccount">Cuenta</a>
            <a href="https://media.netflix.com/">Prensa</a>
        </div>

        <div class="Flinks">
            <a href="https://help.netflix.com/contactus">Contacto</a>
            <a href="https://jobs.netflix.com/jobs">Empleo</a>
            <a href="https://help.netflix.com/legal/privacy">Privacidad</a>
            <a href="https://help.netflix.com/legal/termsofuse">Términos de uso</a>
        </div>

        <div class="Flinks">
            <a href="https://www.netflix.com/watch">Formas de ver</a>
            <a href="https://help.netflix.com/legal/corpinfo">Información corporativa</a>
            <a href="https://www.netflix.com/pa/browse/genre/839338">Solo en Netflix</a>
        </div>

        <p class="Fcopy">© 2026 Netflix Clone</p>
    </footer>
    <script src="script.js"></script>
</body>


</html>