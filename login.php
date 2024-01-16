<?php
session_start();
if($_POST){
    include("./bd.php");
    $conexion = mysqli_connect("localhost", "root", "", "sabaticos");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        // Consulta para verificar las credenciales
        $consulta = "SELECT * FROM usuario WHERE usuario = '$usuario' AND password = '$password'";
        $resultado = mysqli_query($conexion, $consulta);
        $fila = mysqli_fetch_assoc($resultado);
        if ($fila) {
            // Credenciales válidas, iniciar sesión y redirigir según el tipo de usuario
            $_SESSION["usuario"] = $fila["usuario"];
            $_SESSION["password"] = $fila["password"];
            $_SESSION["tipo"] = $fila["tipo"]; // Agrega esta línea para establecer el tipo de usuario
            $_SESSION["id"] = $fila["id"];
            $_SESSION["correo"] = $fila["correo"]; // Guarda el correo electrónico en la sesión
            // Obtener el ID del usuario
            $id_usuario = $fila["id"];
            $_SESSION["id"] = $fila["id"];

            // Obtener la idFichaInscripcion
            $sentencia_ficha = $conexion->prepare("SELECT idFichaInscripcion FROM fichainscripcion WHERE id_usuario=?");
            $sentencia_ficha->bind_param("i", $id_usuario);
            $sentencia_ficha->execute();
            $resultado_ficha = $sentencia_ficha->get_result();
            $registro_ficha = $resultado_ficha->fetch_assoc();
            $idFichaInscripcion = $registro_ficha['idFichaInscripcion'];

            // Resto del código...
            if ($fila["tipo"] == "alumno") {
                header("Location: index.php");
                exit();
            } elseif ($fila["tipo"] == "maestro") {
                header("Location: index_M.php");
                exit();
            } elseif ($fila["tipo"] == "administrador") {
                header("Location: index_A.php");
                exit();
            }
        } else {
            // Credenciales inválidas, mostrar mensaje de error
            $mensaje_error = "Usuario o contraseña incorrectos";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="imagenes/">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<style>
  body {
    background-color: #ffdd90;
    background-image: url("a.jpg");
  }
</style>
<header>
        <div class="logo">
          <img src="imagenes/logo-universidad-tecnologica-santa-catarina-PhotoRoom.png" alt="Logotipo de la página">
        </div>
        <nav>
        <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="cursos.php">Cursos</a></li>
                <li><a href="registrarse.php">Registrarse</a></li>
                <li><a href="login.php">Inicio de session</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="Faq.php">FAQ</a></li>
          </ul>
        </nav>
      </header>
  <main class="container">
<div class="row"><center></center>
<div class="col-md-4">   
        </div>  
        <div class="col-md-4">
</br></br>
<style>
    .card {
      background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);
    }
    .btn-primary {
      background-color: blue;
      color: white;
    }

    .btn-secondary {
      background-color: #696969;
      color: white;
    }
    .btn-warning {
      background-color: #FFD700 ;
      color: black;
    }
  </style>
  </br>
          <div class="card">
              <div class="card-header">
                    <a name="" id="" class="btn btn-primary" href="registrarse.php" role="button" style=" width: 150px; ;">Regístrate</a>
              </div>
                <div class="card-body">                    
                <?php if(isset($mensaje_error)){ ?>
                    <div id="mensaje-error" class="alert alert-danger" role="alert">
                        <strong><?php echo $mensaje_error; ?></strong> 
                    </div>
                <?php } ?>                  
                <form action="" method="post">
                    <div class="mb-3">
                      <label for="usuario" class="form-label"><strong>Usuario:</strong></label>
                      <input type="text"
                      class="form-control" name="usuario" id="usuario" placeholder="Escriba su nombre de usuario." maxlength="16">
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label"><strong>Contraseña:</strong></label>
                      <input type="password"
                      class="form-control" name="password" id="password" placeholder="Escriba su contraseña" maxlength="16">
                    </div>
                    <div class="space">
                    <div class="space">
                      <button type="submit" class="btn btn-warning" style="width: 100px; display: inline-block; margin: 0 0px;">Entrar</button>
                      <button type="button" class="btn btn-secondary" style="width: 160px; display: inline-block; margin: 0 10px;" onclick="limpiarCampos()">Limpiar campos</button>
                  </div>                   
                    </div>
                </form>
                </div>
            </div>
        </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
<script>
    function limpiarCampos() {
        document.getElementById('usuario').value = '';
        document.getElementById('password').value = '';
    }

    document.getElementById('usuario').addEventListener('input', function() {
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16);
        }
    });
    document.getElementById('password').addEventListener('input', function() {
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16);
        }
    });
</script>
<script>
    // Función para ocultar el mensaje de error después de 5 segundos
    setTimeout(function() {
        var mensajeError = document.getElementById('mensaje-error');
        if (mensajeError) {
            mensajeError.style.display = 'none';
        }
    }, 4000);
</script>
