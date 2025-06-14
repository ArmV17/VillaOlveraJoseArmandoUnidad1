<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creaciones Ivy</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" href="img/logo.png" type="image/png">
  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body>
   <!-- Encabezado con logo y navegación -->
  <header>
    <div class="container nav-container">
      <div class="logo-box">
        <img src="img/logo.png" alt="Logo" width="70">
        <span>Creaciones Ivy</span>
      </div>
      <nav>
        <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#register">Register</a></li>
          <li><a href="#login">Login</a></li>
          <li><a href="#ayuda">Ayuda</a></li>
          <li><a href="#contacto">Contacto</a></li>
          <li><a href="#comentarios">Comentarios</a></li>
        </ul>
      </nav>
    </div>
  </header>

   <!-- Sección principal de bienvenida con registro/login -->
  <section id="home" class="hero">
    <div class="container hero-grid">
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
          <img src="img/banner.png" alt="Logo Creaciones Ivy">
        </div>
      </div>
      <div class="hero-form-card">
        <h3 id="register">Register</h3>
          <!-- Campos de registro -->
        <form method="POST" action="controladores/registrar.php" id="formularioRegistro">

        <?php if (isset($_SESSION['error_recaptcha'])): ?>
          <div style="background-color: #ffe4e9; color: #c0392b; padding: 10px; border-radius: 5px; margin-bottom: 10px; font-weight: bold;">
            <?= $_SESSION['error_recaptcha'] ?>
          </div>
          <?php unset($_SESSION['error_recaptcha']); ?>
        <?php endif; ?>


          <input type="text" name="usuario" placeholder="Usuario" pattern="[A-Za-z0-9_]{4,20}" title="Usuario entre 4 y 20 caracteres, solo letras, números y guiones bajos" required>
          <input type="text" name="nombre" placeholder="Nombre Completo" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ ]{3,50}" title="Nombre entre 3 y 50 letras" required>
          <input type="email" name="email" placeholder="Correo Electrónico" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"title="Ingresa un correo electrónico válido" required>

          <div style="display: flex; gap: 5px;">
            <?php include 'controladores/numpais.php'; ?>
            <select name="codigo_pais" required style="width: 100px;">
              <?php foreach ($paises as $codigo => $nombre): ?>
                <option value="<?= htmlspecialchars($codigo) ?>"><?= htmlspecialchars($nombre) ?></option>
              <?php endforeach; ?>
            </select>

            <input type="text" name="whatsapp" id="whatsapp" placeholder="WhatsApp (10 dígitos)" maxlength="10" title="Debe contener exactamente 10 números" required style="flex: 1;" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
          </div>

          <div style="position: relative;">
            <input type="password" name="password" id="password" placeholder="Contraseña" pattern=".{6,20}" title="La contraseña debe tener entre 6 y 20 caracteres" required style="width: 100%; padding-right: 40px;">
            <span onclick="mostrarPassword()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="#ccc">
                <path d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 12c-2.7 0-5-2.3-5-5s2.3-5 5-5 5 2.3 5 5-2.3 5-5 5z"/>
                <circle cx="12" cy="12" r="2.5"/>
              </svg>
            </span>
          </div>

          <div class="g-recaptcha" data-sitekey="6Lfb7VgrAAAAAKTi87qcz7_0zZbnYOrPwbHLUF7L" style="margin-bottom: 15px;"></div>

          <button type="submit" class="btn-primary" style="width: 100%;">Register</button>
        </form>

        <hr>

       <h3 id="login">Login</h3>
        <!-- Campos de login -->
        <form method="POST" action="controladores/login.php">
          <input type="text" name="usuario" placeholder="Usuario" required>
          <input type="password" name="password" placeholder="Contraseña" required>
          <button type="submit" class="btn-primary">Login</button>
        </form>

        <div style="margin-top: 15px; text-align: center;">
          <a href="#" onclick="abrirModal()" style="color: #ff85d5; text-decoration: underline;">¿Olvidaste tu contraseña?</a>
        </div>

        <div id="modalRecuperar" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
          <div style="background:#fff; padding:30px; border-radius:10px; max-width:400px; width:90%; text-align:center; position:relative;">
            <span onclick="cerrarModal()" style="position:absolute; top:10px; right:20px; cursor:pointer; font-size:30px;">&times;</span>
            <h2 style="color: #ff85d5;">Recuperar Contraseña</h2>
            <p>Ingresa tu correo electrónico para enviarte un código de recuperación.</p>
            <form method="POST" action="controladores/enviar_codigo.php">
              <input type="email" name="email" placeholder="Correo electrónico" required style="width: 100%; padding: 10px; margin-top: 10px; border: 1px solid #ccc; border-radius: 5px;">
              <button type="submit" class="btn-primary" style="margin-top: 15px; width: 100%;">Enviar Código</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Sección de ayuda con preguntas frecuentes -->
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
          <p>Puedes enviarnos un correo a <a href="mailto:armandorex2@cgmail.com" style="color: #ff85d5;">armandorex2@cgmail.com</a> o llenar el formulario de contacto abajo.</p>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Sección de contacto con formulario -->
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

        <div style="flex: 1; min-width: 300px;">
          <h3 style="color: #ff85d5;">Envíanos un Mensaje</h3>
          <form action="controladores/enviar_consulta.php" method="POST" style="margin-top: 20px;">
            <input type="text" name="nombre" placeholder="Tu nombre" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
            <input type="email" name="email" placeholder="Tu correo electrónico" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
            <textarea name="mensaje" placeholder="Escribe tu mensaje..." required style="width: 100%; padding: 10px; height: 150px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
            <button type="submit" class="btn-primary" style="width: 100%;">Enviar Mensaje</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección de comentarios desde la base de datos -->
  <section id="comentarios" class="hero">
    <div class="container">
      <h2>Comentarios</h2>
      <p>Para dejar tu comentario debes registrarte e iniciar sesión</p>

      <div style="max-height: 400px; overflow-y: auto; padding-right: 10px;">
        <?php
        require 'controladores/conexion.php';
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

  <!-- Mapa del sitio -->
  <section id="site-map" style="background-color: #f4f4f4; padding: 20px;">
  <div class="container">
    <h2 style="text-align: center; color: #ff85d5;">Mapa del Sitio</h2>
    <ul style="list-style-type: none; padding: 0; text-align: center;">
      <li><a href="#home" style="color: #ff85d5; text-decoration: none; font-size: 1.2em;">Inicio</a></li>
      <li><a href="#register" style="color: #ff85d5; text-decoration: none; font-size: 1.2em;">Registro</a></li>
      <li><a href="#login" style="color: #ff85d5; text-decoration: none; font-size: 1.2em;">Iniciar sesión</a></li>
      <li><a href="#ayuda" style="color: #ff85d5; text-decoration: none; font-size: 1.2em;">Ayuda</a></li>
      <li><a href="#contacto" style="color: #ff85d5; text-decoration: none; font-size: 1.2em;">Contacto</a></li>
      <li><a href="#comentarios" style="color: #ff85d5; text-decoration: none; font-size: 1.2em;">Comentarios</a></li>
    </ul>
  </div>
</section>

   <!-- Pie de página -->
  <footer>
    <div class="container">
      <p>&copy; 2025 Creaciones Ivy. Todos los derechos reservados.</p>
    </div>
  </footer>

  <!-- Scripts para recaptcha -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <script>
  function mostrarPassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcon.setAttribute('fill', '#fff');
    } else {
      passwordInput.type = 'password';
      eyeIcon.setAttribute('fill', '#ccc');
    }
  }

  function abrirModal() {
    document.getElementById('modalRecuperar').style.display = 'flex';
  }

  function cerrarModal() {
    document.getElementById('modalRecuperar').style.display = 'none';
  }
  </script>

</body>
</html>