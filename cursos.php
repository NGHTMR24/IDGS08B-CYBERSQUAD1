<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="imagenes/">
    <link rel="stylesheet" href="estilos.css">
    <style> 
    .course-column {
      display: flex;
      flex-direction: column;
      margin-left: 150px;
    }

    .course-item {
      margin-bottom: 20px;
    }

    .course-item img {
      width: 800px; /* Ajusta el tamaño de la imagen según tus necesidades */
    }

    .course-item h3 {
      font-size: 18px;
      margin: 10px 0;
    }

    .course-item p {
      font-size: 14px;
    }
</style>
    <title>Cursos</title>
</head>
<body>
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

      <div class="course-column">
        <div class="course-item">
          <img src="imagenes/curso_ingles_web copy.jpg" alt="Curso 1">
          <h3>Curso 1</h3>
          <p>Descripción del curso 1.</p>
          <a href="#" class="btn">Inscribirse</a>
        </div>
        
        <div class="course-item">
          <img src="ruta-de-la-imagen" alt="Curso 2">
          <h3>Curso 2</h3>
          <p>Descripción del curso 2.</p>
          <a href="#" class="btn">Inscribirse</a>
        </div>
        
        <!-- Agrega más cursos aquí -->
      </div>


      <footer>
        <div class="container">
            <p>&copy; 2023 Cursos Profesionales. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>