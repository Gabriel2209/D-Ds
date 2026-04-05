<?php
include "conn.php"; // conexión a la BD
$pdo = new Conn(); // instancia de la conexión

// ----------- EDITAR -----------
if(isset($_GET['editar'])){
    $id = $_GET['editar']; // obtenemos el id por URL
    try{
        $sql = "SELECT * FROM t_datos_personales WHERE id_persona = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id',$id); // enlazamos el parámetro
        $stmt->execute();

        $persona = $stmt->fetch(PDO::FETCH_ASSOC); // obtenemos los datos
    }catch(PDOException $e){
        echo "Algo salio mal al editar ". $e->getMessage();
    }
}

// ----------- ELIMINAR -----------
if(isset($_GET['eliminar'])){
    $id = $_GET['eliminar']; // id a eliminar

    try{
        $sql = "DELETE FROM t_datos_personales WHERE id_persona = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        // redirección con mensaje
        header("location: " . $_SERVER['PHP_SELF'] . "?msg=eliminado");
        exit();
    }catch(PDOException $e){
        echo "Error al eliminar: " . $e->getMessage();
    }
}

// ----------- INSERTAR / ACTUALIZAR -----------
if(isset($_POST['btnRegistrarse'])){

    // variables vacías
    $nombre = "";
    $cedula = "";
    $email = "";
    $password = "";
    $verified_password = "";
    $fechaNac = "";
    $telefono = "";
    $preferencias = "";
    $genero = "";
    $id_persona = 0;
    $terminos = "";

    // capturar datos del formulario
    if(isset($_POST['id_persona'])){$id_persona = $_POST['id_persona'];}
    if(isset($_POST['nombre'])){ $nombre = $_POST['nombre'];}
    if(isset($_POST['cedula'])){$cedula = $_POST['cedula'];}
    if(isset($_POST['email'])){$email = $_POST['email'];}
    if(isset($_POST['password'])){$password = $_POST['password'];}
    if(isset($_POST['verified-password'])){$verified_password = $_POST['verified-password'];}
    if(isset($_POST['fechaNac'])){$fechaNac = $_POST['fechaNac'];}
    if(isset($_POST['telefono'])){$telefono = $_POST['telefono'];}
    if(isset($_POST['preferencias'])){$preferencias = $_POST['preferencias'];}
    if(isset($_POST['genero'])){$genero = $_POST['genero'];}
    if(isset($_POST['terminos'])){$terminos = $_POST['terminos'];}

    // validación básica
    if(strlen(trim($nombre)) >= 5 && strlen(trim($cedula)) >= 7 && strlen(trim($email)) >= 8 && strlen(trim($fechaNac)) == 10 && $telefono != "" && $genero != "" && $terminos != "" ){

        // -------- INSERT --------
        if($id_persona == 0){

            // validar contraseña
            if($password != $verified_password || empty($password)){
                echo "La constraseñas no coinciden ";
                return;
            }

            try{
                $sqlInse = "INSERT INTO t_datos_personales 
                (nombre_completo, cedula, correo, contrasena, fecha_nacimiento, telefono, genero, generos_fav )
                VALUES(:nombre, :cedula, :email, :contrasena, :fecha_nacimiento, :telefono, :genero, :generos_fav )";

                $passwordHash = password_hash($password, PASSWORD_DEFAULT); // encriptar contraseña

                $stmt = $pdo->prepare($sqlInse);
                $stmt->bindParam(":nombre", $nombre);
                $stmt->bindParam(":cedula", $cedula);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":contrasena", $passwordHash);
                $stmt->bindParam(":fecha_nacimiento", $fechaNac);
                $stmt->bindParam(":telefono", $telefono);
                $stmt->bindParam(":genero", $genero);
                $stmt->bindParam(":generos_fav", $preferencias);
                $stmt->execute();

                // redirección
                header("location: " .$_SERVER['PHP_SELF']. "?msg=creado");
                exit();

            }catch (PDOException $e){
                echo "Error al guardar los datos. ". $e->getMessage();
            }

        // -------- UPDATE --------
        }elseif($id_persona > 0){

            try{
                $sqlUpt = "UPDATE t_datos_personales 
                SET nombre_completo = :nombre_completo, 
                cedula = :cedula, 
                correo = :correo, 
                contrasena = :contrasena, 
                fecha_nacimiento = :fecha_nacimiento, 
                telefono = :telefono, 
                genero = :genero, 
                generos_fav = :generos_fav
                WHERE id_persona = :id_persona";

                // si se escribe nueva contraseña
                if(!empty($password)){
                    if($password != $verified_password){
                        echo "Las contraseñas no coinciden. ";
                        return;
                    }
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                }else{
                    // mantener contraseña actual
                    if(!isset($persona)){
                        $sql = "SELECT contrasena FROM t_datos_personales WHERE id_persona = :id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(":id", $id_persona);
                        $stmt->execute();
                        $persona = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                    $passwordHash = $persona['contrasena'];
                }

                $stmt = $pdo->prepare($sqlUpt);
                $stmt->bindParam(":id_persona", $id_persona);
                $stmt->bindParam(":nombre_completo", $nombre);
                $stmt->bindParam(":cedula", $cedula);
                $stmt->bindParam(":correo", $email);
                $stmt->bindParam(":contrasena", $passwordHash);
                $stmt->bindParam(":fecha_nacimiento", $fechaNac);
                $stmt->bindParam(":telefono", $telefono);
                $stmt->bindParam(":genero", $genero);
                $stmt->bindParam(":generos_fav", $preferencias);
                $stmt->execute();

                // redirección
                header("location: " .$_SERVER['PHP_SELF'] . "?msg=actualizado");
                exit();

            } catch(PDOException $e){
                echo "Algo salio mal al Actualizar los datos. " . $e->getMessage();
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
            <h1>
                <?php echo isset($persona) ? "Actualizar Usuario" : "Formulario de Registro" ?>
            </h1>

            <label for="nombre">Nombre Completo:
                <input type="text" id="nombre" name="nombre" value="<?php echo isset($persona) ? htmlspecialchars($persona['nombre_completo']) : ''; ?>" required>
                <input type="hidden" name="id_persona" value="<?php echo isset($persona) ? $persona['id_persona'] : 0; ?>">
            </label>
            <label for="cedula">Cedula:
                <input type="text" id="cedula" name="cedula" value="<?php echo isset($persona) ? htmlspecialchars($persona['cedula']): ''; ?>" required>
            </label>
            <label for="email">Correo Electrónico:
                <input type="email" id="email" name="email" value="<?php echo isset($persona) ? htmlspecialchars($persona['correo']) : ''; ?>" required>
                <p id="error-email"></p>
            </label>
            <label for="password">
                Contraseña:
                <input type="password" id="password" name="password" >
            </label>
            <label for="verified-password">
                Confirmar contraseña:
                <input type="password" id="verified-password" name="verified-password" >
                <p id="error-pass"></p>
            </label>
            <label for="fechaNac">Fecha de nacimiento:
                <input type="date" id="fechaNac" name="fechaNac" value="<?php echo isset($persona) ? htmlspecialchars($persona['fecha_nacimiento']) : ''; ?>" required>
            </label>
            <label for="telefono">Teléfono:
                <input type="tel" id="telefono" name="telefono" value="<?php echo isset($persona) ? htmlspecialchars($persona['telefono']) : ''; ?>" required>
            </label>
            <fieldset>
                <legend>Género</legend>
                <label for="generoM">
                    Masculino
                    <input type="radio" id="generoM" name="genero" value="Masculino" <?php if(isset($persona) && $persona['genero']=="Masculino") echo "checked"; ?> required>
                </label>
                <label for="generoF">
                    Femenino
                    <input type="radio" id="generoF" name="genero" value="Femenino" <?php if(isset($persona) && $persona['genero']=="Femenino") echo "checked"; ?>>
                </label>
            </fieldset>
            <label for="preferencias">
                Géneros favoritos:
                <textarea name="preferencias" id="preferencias"  maxlength="35"
                    placeholder="Ej: Acción, Comedia, Drama."><?php echo isset($persona) ? htmlspecialchars($persona['generos_fav']) : '';?></textarea>
            </label>
            <label for="terminos">
                <input type="checkbox" id="terminos" name="terminos"<?php if(isset($persona)) echo "checked" ?>  required>
                Aceptar Terminos y Condiciones
            </label>

            <button type="submit" id="btnRegistrarse" name="btnRegistrarse">
                <?php echo isset($persona) ? "Actualizar" : "Registrarse"; ?>
            </button>
        </form>
    </main>
    
    <div class="table-cont">
        <table id="user-table" class="user-table" >
            <tr>
                <th>&nbsp;</th>
                <th>Nombre Completo</th>
                <th>Cedula</th>
                <th>Correo Electrónico</th>
                <th>Fecha de Nacimiento</th>
                <th>Telefono</th>
                <th>Genero</th>
                <th>Preferencias</th>
                <th>&nbsp;</th>
            </tr>
            
            <?php 
                $sql = "SELECT * FROM t_datos_personales ORDER BY nombre_completo";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $PERSONAS = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($PERSONAS as $PERSONA){
                    echo "<tr>";
                        echo "<td><a href='?editar=".$PERSONA['id_persona']."'>Editar</a></td>";
                        echo "<td data-label='Nombre'>". htmlspecialchars($PERSONA['nombre_completo']) ."</td>";
                        echo "<td data-label='Cedula'>". htmlspecialchars($PERSONA['cedula']) ."</td>";
                        echo "<td data-label='Correo'>". htmlspecialchars($PERSONA['correo']) ."</td>";
                        echo "<td data-label='Fecha de nacimiento'>".date("y-m-d",strtotime($PERSONA['fecha_nacimiento']))  ."</td>";
                        echo "<td data-label='Telefono'>". htmlspecialchars($PERSONA['telefono']) ."</td>";
                        echo "<td data-label='Genero'>". htmlspecialchars($PERSONA['genero']) ."</td>";
                        echo "<td data-label='Preferencias'>". htmlspecialchars($PERSONA['generos_fav']) ."</td>";
                        echo "<td><a href='#' onclick='confirmarEliminar(".$PERSONA['id_persona'].")' >Eliminar</a></td>";
                    echo "</tr>";
                }
            ?>
            
            
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!-- libreria para poner alerta bonitas que alert()  -->
    <script src="../js/script.js"></script>
    <script>
        <?php if(isset($_GET['msg'])){ ?>

            <?php if($_GET['msg'] == "creado"){ ?>
                Swal.fire("Listo", "Usuario registrado", "success");
            <?php } ?>

            <?php if($_GET['msg'] == "actualizado"){ ?>
                Swal.fire("Listo", "Datos actualizados", "success");
            <?php } ?>

            <?php if($_GET['msg'] == "eliminado"){ ?>
                Swal.fire("Eliminado", "Usuario eliminado", "warning");
            <?php } ?>

        <?php } ?>
    </script>
</body>


</html>
