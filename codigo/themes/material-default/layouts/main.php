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
        <h1 class="titulo">¡¡¡Bienvenido a Ofertas y Chollos!!!</h1>
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
                ['label' => 'Acerca de', 'url' => ['site/about']],
                ['label' => 'Contacto', 'url' => ['site/contact']],
                ['label' => 'Ofertas', 'url' => ['site/ofertas']],
                ['label' => 'Anuncios', 'url' => ['site/chollos']],
                ['label' => 'Categorías', 'url' => ['site/categorias']],    
                ['label' => 'Acceder', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ['label' => Yii::$app->user->isGuest ? '' : 'Bienvenido, ' . Yii::$app->user->identity->username,
                        'items' =>
                        [
                            ['label' => 'Cerrar sesión', 'url' => ['site/logout'], 'linkOptions' => ['data-method' => 'post']],
                        ],'visible' => !Yii::$app->user->isGuest,],
            ],

        ]); ?>
         <div class="navbar">
     
        
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

  <div class="navbar">
  <?= EtiquetasWidget::widget() ?>
  </div>

  <div class="container">
    <div class="section">
      <div class="row">
        <div class="col s12 m12">
          <?= $content; ?>
        </div>
      </div>
    </div>
  </div>

  
  <div class="container">
    <div class="section">
      
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2> 
            <h5 class="center">Acelera el desarrollo</h5>
            <p class="light">Hemos creado un diseño predeterminado que incorpora nuestros componentes personalizados, con animaciones y transiciones optimizadas para una experiencia fluida.</p>
          </div>
        </div>
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">Enfocado en la experiencia del usuario</h5>
            <p class="light">Al usar principios de Material Design, creamos un sistema responsive unificado para una mejor experiencia en todas las plataformas.</p>
          </div>
        </div>
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Fácil de usar</h5>
            <p class="light">Ofrecemos documentación detallada y ejemplos de código para que los nuevos usuarios puedan comenzar rápidamente.</p>
          </div>
        </div>
      </div>
    </div>
    <br><br>
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
