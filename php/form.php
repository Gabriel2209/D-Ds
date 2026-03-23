<?php
include "conn.php";
$pdo = new Conn();

if(isset($_POST['btnRegistrarse'])){
    $nombre = "";
    $cedula = "";
    $email = "";
    $password = "";
    $fechaNac = "";
    $telefono = "";
    $preferencias = "";
    $genero = "";
    $id_persona = 0;

    if(isset($_POST['id_persona'])){$id_persona = $_POST['id_persona'];}
    
    if(isset($_POST['nombre'])){ $nombre = $_POST['nombre'];}
    
    if(isset($_POST['cedula'])){$cedula = $_POST['cedula'];}
    
    if(isset($_POST['email'])){$email = $_POST['email'];}
    
    if(isset($_POST['password'])){$password = $_POST['password'];}
    
    if(isset($_POST['fechaNac'])){$fechaNac = $_POST['fechaNac'];}
    
    if(isset($_POST['telefono'])){$telefono = $_POST['telefono'];}
    
    if(isset($_POST['preferencias'])){$preferencias = $_POST['preferencias'];}
    
    if(isset($_POST['genero'])){$genero = $_POST['genero'];}

    if(strlen(trim($nombre)) >= 5 && strlen(trim($cedula)) >= 7 && strlen(trim($email)) >= 8 && $password != "" && strlen(trim($fechaNac)) == 10 && $telefono != "" && $genero != "" ){
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        if($id_persona == 0){
            try{
                $sqlInse = "INSERT INTO t_datos_personales (nombre_completo, cedula, correo, password, fecha_nacimiento, telefono, preferencias, genero )
                VALUES(:nombre, :cedula, :email, :password, :fechaNac, :telefono, :preferencias, :genero, )";
                $stmt = pdo->prepadre($sqlinse);
                $stmt = bindParam(":nombre", $nombre);
                $stmt = bindParam(":cedula", $cedula);
                $stmt = bindParam(":email", $email);
                $stmt = bindParam(":password", $password);
                $stmt = bindParam(":fechaNac", $fechaNac);
                $stmt = bindParam(":telefono", $telefono);
                $stmt = bindParam(":preferencias", $preferencias);
                $stmt = bindParam(":genero", $genero);
                $stmt->execute();
                echo "Datos guardado con Exito."
            }catch (PDOException $e){
                echo "Error al guardar los datos. ". $e->getMessage();
            }
        }
    
    }
}



?>


<!DOCTYPE html>
<html>

<head>
    <title>Netflix</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form.css">
</head>

<body>
    <header>
        <div class="logo-continer">
            <a href="../html/index.html">
                <img src="../utilidades/img/logo_netflix.png" alt="netflix">
            </a>
        </div>
    </header>
    <main>
        <form action="" method="POST">
            <h1>Formulario de Registro</h1>

            <label for="nombre">Nombre Completo:
                <input type="text" id="nombre" name="nombre" required>
                <input type="hidden" name="id_persona" >
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
                <textarea name="preferencias" id="preferencias"  maxlength="35"
                    placeholder="Ej: Acción, Comedia, Drama."></textarea>
            </label>
            <label for="terminos">
                <input type="checkbox" id="terminos" name="terminos" required>
                Aceptar Terminos y Condiciones
            </label>

            <button type="submit" id="btnRegistrarse" name="btnRegistrarse">Registrarse</button>
        </form>
    </main>
    
    <div class="table-cont">
        <table id="user-table" class="user-table" >
            <tr>
                <th>Nombre Completo</th>
                <th>Cedula</th>
                <th>Correo Electrónico</th>
                <th>Fecha de Nacimiento</th>
                <th>Telefono</th>
                <th>Genero</th>
                <th>Preferencias</th>
                <th>&nbsp;</th>
            </tr>
            <tr>
                <?php 
                    $sql = "SELECT * FROM t_datos_personales ORDER BY nombre_completo";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $PERSONAS = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($PERSONAS as $PERSONA){
                        echo "<tr>";
                            echo "<td>". $PERSONA['nombre_completo'] ."</td>";
                            echo "<td>". $PERSONA['cedula'] ."</td>";
                            echo "<td>". $PERSONA['correo'] ."</td>";
                            echo "<td>".date("y-m-d",strtotime($PERSONA['fecha_nacimiento']))  ."</td>";
                            echo "<td>". $PERSONA['telefono'] ."</td>";
                            echo "<td>". $PERSONA['genero'] ."</td>";
                            echo "<td>". $PERSONA['preferencias'] ."</td>";
                        echo "</tr>";
                    }
                ?>
            </tr>
        </table>
    </div>

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
    <script src="../js/script.js"></script>
</body>


</html>
