<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;

/**
 * @var $this \yii\base\View
 * @var $content string
 */

?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  
  <title><?= Html::encode($this->title ?: 'Ofertas y Chollos') ?></title>
  <?php $this->head(); ?>
  
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  
  <!-- CSS -->
  <link href="<?= $this->theme->baseUrl ?>/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?= $this->theme->baseUrl ?>/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
  <?php $this->beginBody(); ?>

  <?php

use yii\helpers\Url;
use app\views\etiquetas\EtiquetasWidget; ?>

  <header>
    <div id ="cabecera">
        <h1 class="titulo">Bienvenido a Ofertas y Chollos</h1>
    </div>
  </header>


  <nav class="light-blue lighten-1" role="navigation">
    <div class="container">
      <div class="nav-wrapper">
        <a href="<?= Yii::$app->homeUrl ?>" id="logo-container" class="brand-logo">Cholloferta</a>
        <?= Menu::widget([
            'options' => ['id' => 'nav-mobile', 'class' => 'right side-nav'],
            'items' => [
                ['label' => 'Inicio', 'url' => ['site/index']],
                ['label' => 'Ofertas', 'url' => ['ofertas/visor']],
                ['label' => 'Anuncios', 'url' => ['anuncios/visor']],
                ['label' => 'Categorías', 'url' => ['categorias/visor']],    
                ['label' => 'Contacto', 'url' => ['site/contact']],
                ['label' => 'Acceder', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ['label' => 'Registrarse', 'url' => ['usuarios/registro'], 'visible' => Yii::$app->user->isGuest],
                ['label' => Yii::$app->user->isGuest ? '' : 'Bienvenido, ' . Yii::$app->user->identity->nick,
                        'items' =>
                        [
                            ['label' => 'Cerrar sesión', 'url' => ['site/logout'], 'linkOptions' => ['data-method' => 'post']],
                        ],'visible' => !Yii::$app->user->isGuest,],
            ],

        ]); ?>
        

        

        
     
        
        <!-- Buscador 
            <form action="<?= Yii::$app->urlManager->createUrl(['site/buscar']) ?>" method="GET" class="right">
                <div class="input-field" style="margin-top: 0; margin-right: 10px;">
                    <input id="search" type="text" name="q" placeholder="Buscar..." required>
                    <label for="search" class="active"><i class="material-icons">search</i></label>
                </div>
            </form>
        -->

        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
      </div>
    </div>
  </nav>






        <div class="container-nav">
          <div class="navbar" id="navbar">
              <?= EtiquetasWidget::widget() ?>
          </div>
        </div>

        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->getNombreRol() === 'admin'): ?>
    <div class="admin-menu">
        <h3>Mantenimiento Admin</h3>
        <?= Menu::widget([
            'items' => [
                ['label' => ' Ofertas', 'url' => ['ofertas/index']],
                ['label' => 'Anuncios', 'url' => ['anuncios/index']],
                ['label' => 'Categorías', 'url' => ['categorias/index']],
                ['label' => 'Comentarios', 'url' => ['comentario/index']],
                ['label' => 'Etiquetas', 'url' => ['etiquetas/index']],
                ['label' => 'Incidencias', 'url' => ['incidencias/index']],
                ['label' => 'Usuarios', 'url' => ['usuarios/index']],
                ['label' => 'Logs', 'url' => ['logs/index']],
                ['label' => 'Mensajes', 'url' => ['mensajes/index']],
                ['label' => 'Patrocinadores', 'url' => ['patrocinadores/index']],
                ['label' => 'Preferencias', 'url' => ['preferencias/index']],
            ],
            'options' => ['class' => 'nav nav-pills nav-horizontal'],
        ]) ?>
    </div>
<?php endif; ?>




  <div class="container">
    <div class="section">
      <div class="row">
        <div class="col s12 m12">
          <?= $content; ?>
        </div>
      </div>
    </div>
  </div>

  
  
  
  <footer class="color-footer">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="orange-text">Sobre Nosotros</h5>
          <p class="grey-text lighten-4"  style="text-align: left;">Somos un equipo de estudiantes trabajando en este proyecto como si fuera nuestro trabajo a tiempo completo. Tu apoyo es muy apreciado.</p>
        </div>
        <div class="col l3 s12">
          <h5 class="orange-text">Enlaces</h5>
          <ul>
            <li><a class="white-text" href="#!">Enlace 1</a></li>
            <li><a class="white-text" href="#!">Enlace 2</a></li>
            <li><a class="white-text" href="#!">Enlace 3</a></li>
            <li><a class="white-text" href="#!">Enlace 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="orange-text">Redes Sociales</h5>
          <ul>
            <li><a class="white-text" href="#!">Facebook</a></li>
            <li><a class="white-text" href="#!">Twitter</a></li>
            <li><a class="white-text" href="#!">LinkedIn</a></li>
            <li><a class="white-text" href="#!">Instagram</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        © <?= date('Y') ?> Ofertas y Chollos. Todos los derechos reservados.
        <a class="orange-text lighten-3" href="#">Política de Privacidad</a>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="<?= $this->theme->baseUrl ?>/js/materialize.js"></script>
  <script src="<?= $this->theme->baseUrl ?>/js/init.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.sidenav');
      M.Sidenav.init(elems);
    });
  </script>
  

</body>
</html>
<?php $this->endPage(); ?>
