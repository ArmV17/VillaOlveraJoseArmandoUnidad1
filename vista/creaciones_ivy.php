<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}

require '../controladores/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Creaciones Ivy</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="icon" href="../img/logo.png" type="image/png">
</head>

<body>
  <header>
    <div class="container nav-container">
      <div style="display: flex; align-items: center;">
        <div class="logo-box">
          <img src="../img/logo.png" alt="Logo" width="70">
          <span>Creaciones Ivy</span>
        </div>
        <div class="usuario-box">
          <?php echo htmlspecialchars($_SESSION['usuario']); ?>
        </div>
      </div>
      <nav>
        <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#productos">Catalogo</a></li>
          <li><a href="#ayuda">Ayuda</a></li>
          <li><a href="#contacto">Contacto</a></li>
          <li><a href="#buzon">Comentarios</a></li>
        </ul>
        <a href="../controladores/logout.php" class="logout-btn">Cerrar Sesión</a>
      </nav>
    </div>
  </header>

  <section id="home" class="hero">
    <div class="container hero-grid">
      <!-- Texto y Banner -->
      <div class="hero-text">
        <h2>Decoraciones de Eventos y Ramos de Flores Eternas</h2><br><hr><br>
        <p>
          En <strong>Creaciones Ivy</strong>, somos especialistas en diseñar momentos inolvidables que perduran en el corazón de tus seres queridos.<br>
          Creamos ambientes únicos para celebrar los instantes más importantes de la vida: cumpleaños, aniversarios, bodas y eventos especiales.<br>
        </p>
        <p>
          Nuestros ramos de flores, cuidadosamente seleccionados y arreglados con pasión, están pensados para transmitir emociones profundas y hacer sentir especial a esa persona tan importante.
        </p><br>
        <div class="logo-banner">
          <img src="../img/banner.png" alt="Logo Creaciones Ivy">
        </div>
      </div>

      <div class="photo-pyramid">
        <div class="top-photo">
          <img src="../img/graduacion.jpg" alt="Foto 1">
        </div>
        <div class="bottom-photos">
          <img src="../img/Flor.jpg" alt="Foto 2" class="Foto2">
          <img src="../img/boda.jpg" alt="Foto 3" class="Foto3">
        </div>
      </div>
    </div>
  </section>

  <section id="productos" class="hero">
    <div class="container">
      <h2 style="text-align: center; color: #ff85d5;">Catálogo de Productos</h2>
      <form method="GET" style="text-align: center; margin: 20px 0;">
        <input type="text" name="buscar" placeholder="Buscar producto..." style="padding: 10px; width: 300px; border-radius: 5px; border: 1px solid #ccc;">
        <button type="submit" class="btn-primary">Buscar</button>
      </form>

      <div class="hero-grid">
        <?php
        $productos = [
          "Rosa" => "Flor.jpg",
          "Ramo 3 Rosas" => "Ramo1.jpg",
          "Ramo 10 Rosas" => "ramo10.jpg",
          "Ramo 15 Rosas" => "ramo15.jpg",
          "Ramo 30 Rosas" => "ramo30.jpg",
          "Decoraciones Boda" => "boda.jpg",
          "Decoraciones 15 Años" => "15años.jpg",
          "Decoraciones de Cumpleaños" => "cumple.jpg",
          "Decoraciones de Tiendas" => "tienda.jpg",
          "Decoraciones de Confirmacion" => "confirmacion.jpg",
          "Ramos Graduación" => "graduacion.jpg"
        ];

        $busqueda = isset($_GET['buscar']) ? strtolower(trim($_GET['buscar'])) : '';

        foreach ($productos as $nombre => $imagen) {
          if ($busqueda === '' || strpos(strtolower($nombre), $busqueda) !== false) {
            echo "
              <div style='text-align:center; margin: 20px;'>
                <img src='../img/$imagen' alt='$nombre' style='width: 250px; height: 250px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);'><br>
                <strong style='color: #ff85d5; display: block; margin-top: 10px;'>$nombre</strong>
              </div>
            ";
          }
        }
        ?>
      </div>
    </div>
  </section>

  <section id="ayuda" class="hero" style="background: #fff5fb; padding: 60px 20px;">
    <div class="container">
      <h2 style="text-align: center; color: #ff85d5;">¿Necesitas Ayuda?</h2>
      <p style="text-align: center; max-width: 700px; margin: 20px auto; font-size: 1.1em;">
        Encuentra respuestas a las preguntas más frecuentes o contáctanos para obtener asistencia personalizada.
      </p>

      <div style="margin-top: 40px;">
        <h3 style="color: #ff85d5;">Preguntas Frecuentes (FAQs)</h3>
        <div style="margin: 20px 0; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
          <h4>¿Cómo puedo registrarme?</h4>
          <p>Simplemente dirígete a la sección de registro, llena el formulario y listo, tu cuenta estará creada.</p>
        </div>
        <div style="margin: 20px 0; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
          <h4>¿Cómo restablezco mi contraseña?</h4>
          <p>Haz clic en "¿Olvidaste tu contraseña?" en la página de inicio de sesión y sigue las instrucciones para recibir un código de recuperación por correo electrónico.</p>
        </div>
        <div style="margin: 20px 0; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
          <h4>¿Cómo contacto con soporte?</h4>
          <p>Puedes enviarnos un correo a <a href="mailto:armandorex2@cgmail.com" style="color: #ff85d5;">armandorex2@cgmail.com</a> o llenar el formulario de contacto</p>
        </div>
      </div>
    </div>
  </section>

  <section id="contacto" class="hero" style="background: #fff; padding: 60px 20px;">
    <div class="container">
      <h2 style="text-align: center; color: #ff85d5;">Contáctanos</h2>
      <p style="text-align: center; max-width: 700px; margin: 20px auto; font-size: 1.1em;">
        ¿Tienes preguntas, comentarios o necesitas más información? Estamos aquí para ayudarte.
      </p>

      <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 40px; margin-top: 40px;">
        <div style="flex: 1; min-width: 250px;">
          <h3 style="color: #ff85d5;">Información</h3>
          <p><strong>Dirección:</strong> Cordillera de los Andes #196, Saltillo, Coahuila</p>
          <p><strong>Teléfono:</strong> +52 844 345 8402</p>
          <p><strong>Horario:</strong> Lunes a Viernes 9:00 a.m. - 6:00 p.m.</p>
        </div>

        <!-- Formulario de Contacto -->
        <div style="flex: 1; min-width: 300px;">
          <h3 style="color: #ff85d5;">Envíanos un Mensaje</h3>
          <form action="../controladores/enviar_consulta.php" method="POST" style="margin-top: 20px;">
            <input type="text" name="nombre" placeholder="Tu nombre" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
            <input type="email" name="email" placeholder="Tu correo electrónico" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
            <textarea name="mensaje" placeholder="Escribe tu mensaje..." required style="width: 100%; padding: 10px; height: 150px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
            <button type="submit" class="btn-primary" style="width: 100%;">Enviar Mensaje</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section id="buzon" class="hero">
    <div class="container hero-form-card">
      <h2>Dejar Comentario</h2>
      <form method="POST" action="../controladores/guardar_comentario.php">
        <textarea name="comentario" placeholder="Escribe aquí el comentario que aparecerá en el sitio..." required style="height: 100px; border: 1px solid #ccc; border-radius: 5px; padding: 10px;"></textarea>
        <button type="submit" class="btn-primary" style="margin-top: 10px;">Publicar Comentario</button>
      </form>
    </div>
  </section>

  <section id="comentarios" class="hero">
    <div class="container">
      <h2>Comentarios</h2>

      <div style="max-height: 400px; overflow-y: auto; padding-right: 10px;">
        <?php
        require '../controladores/conexion.php';
        setlocale(LC_TIME, 'es_ES.UTF-8'); 
        date_default_timezone_set('America/Mexico_City');
        $consulta = $conn->query("SELECT usuario, comentario, fecha FROM comentarios ORDER BY fecha DESC");
        while ($row = $consulta->fetch_assoc()):
        ?>
          <div style="background: #fff; margin: 15px 0; padding: 15px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
              <strong style="font-size: 1.1em; color: #ff85d5;"><?= htmlspecialchars($row['usuario']) ?></strong>
              <span style="font-size: 0.9em; color: #888;">
                <?= strftime('%d de %B %Y %I:%M %p', strtotime($row['fecha'])) ?>
              </span>
            </div>
            <p style="margin-top: 10px;"><?= nl2br(htmlspecialchars($row['comentario'])) ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
        
  <section id="site-map" style="background-color: #f4f4f4; padding: 20px;">
    <div class="container">
      <h2 style="text-align: center; color: #ff85d5;">Mapa del Sitio</h2>
      <ul style="list-style-type: none; padding: 0; text-align: center;">
        <li><a href="#home" style="color: #ff85d5; text-decoration: none; font-size: 1.2em;">Home</a></li>
        <li><a href="#productos" style="color: #ff85d5; text-decoration: none; font-size: 1.2em;">Catalogo</a></li>
        <li><a href="#ayuda" style="color: #ff85d5; text-decoration: none; font-size: 1.2em;">Ayuda</a></li>
        <li><a href="#contacto" style="color: #ff85d5; text-decoration: none; font-size: 1.2em;">Contacto</a></li>
        <li><a href="#buzon" style="color: #ff85d5; text-decoration: none; font-size: 1.2em;">Comentarios</a></li>
      </ul>
    </div>
  </section>

  <footer>
    <div class="container">
      <p>&copy; 2025 Creaciones Ivy. Todos los derechos reservados.</p>
    </div>
  </footer>

  <div id="modal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="imgModal">
  </div>

  <script>
    // Modal y contenido
    const modal = document.getElementById("modal");
    const modalImg = document.getElementById("imgModal");
    const images = document.querySelectorAll('.photo-pyramid img');
    const close = document.getElementsByClassName("close")[0];

    // Mostrar imagen en modal
    images.forEach(img => {
      img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
      }
    });

    modal.onclick = function(e) {
      if (e.target === modal) {
        modal.style.display = "none";
      }
    }
  </script>

<div id="chatbase-chatbot" style="position: fixed; bottom: 30px; right: 20px; z-index: 9999; border-radius: 10px; overflow: hidden;">
  
  <div id="chatbot-container" style="position: relative;">
    
    <!-- Botón de minimizar (visible cuando está minimizado) -->
    <button id="minimize-btn" onclick="toggleChatbot()" style="position: absolute; bottom: 10px; right: 10px; background: #ff85d5; border: none; color: white; border-radius: 50%; width: 30px; height: 30px; font-size: 18px; cursor: pointer; display: block;">
      -
    </button>

    <!-- Logo y texto de Chat cuando está minimizado -->
    <div id="minimized" onclick="toggleChatbot()" style="display: block; background-color: #ff85d5; color: white; padding: 10px; text-align: center; border-radius: 10px; width: 120px; cursor: pointer;">
      <img src="../img/logo.png" alt="Logo Creaciones Ivy" style="width: 40px; vertical-align: middle;">
      <span style="margin-left: 10px;">Chat</span>
    </div>

    <!-- Iframe visible -->
    <iframe id="chatbase-iframe" src="https://www.chatbase.co/chatbot-iframe/NmahtFfO2bvMOjemV7H23" width="350" height="500" frameborder="0" style="border-radius: 10px; display: none;"></iframe>
  </div>
</div>

<script>
  // Función para minimizar y maximizar el chatbot
  function toggleChatbot() {
    const iframe = document.getElementById('chatbase-iframe');
    const minimized = document.getElementById('minimized');
    const button = document.getElementById('minimize-btn');
    
    // Si el iframe está visible, lo ocultamos y mostramos el logo con texto
    if (iframe.style.display === 'none') {
      iframe.style.display = 'block';  // Muestra el iframe
      minimized.style.display = 'none';  // Oculta el logo y texto
      button.style.display = 'block';  // Oculta el botón de minimizar cuando está expandido
    } else {
      iframe.style.display = 'none';  // Oculta el iframe
      minimized.style.display = 'block'; // Muestra el logo y texto
      button.style.display = 'none';  // Muestra el botón de minimizar cuando está minimizado
    }
  }

  // Inicia el chatbot minimizado
  window.onload = function() {
    document.getElementById('chatbase-iframe').style.display = 'none';  // Asegura que el iframe esté oculto inicialmente
    document.getElementById('minimized').style.display = 'block';  // Muestra el logo y texto
    document.getElementById('minimize-btn').style.display = 'none';  // Muestra el botón de minimizar
  }
</script>

</body>
</html>