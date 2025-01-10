<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use app\views\etiquetas\EtiquetasWidget;

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
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <meta name="description" content="Ofertas exclusivas y chollos imperdibles en tecnología, hogar, moda y más"/>
  <meta name="keywords" content="ofertas, chollos, tecnología, moda, hogar, deportes"/>
  <meta name="author" content="Equipo Ofertas y Chollos"/>
  
  <title><?= Html::encode($this->title ?: 'Ofertas y Chollos') ?></title>
  <?php $this->head(); ?>
  
  <!-- CSS -->
  <link href="<?= $this->theme->baseUrl ?>/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?= $this->theme->baseUrl ?>/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<?php $this->beginBody(); ?>

<header>
    <div id="cabecera" aria-label="Cabecera principal">
        <h1 class="titulo">¡¡¡Bienvenido a Ofertas y Chollos!!!</h1>
    </div>
</header>

<nav class="light-blue lighten-1" role="navigation">
    <div class="container">
        <div class="nav-wrapper">
            <a href="<?= Yii::$app->homeUrl ?>" id="logo-container" class="brand-logo" aria-label="Inicio">Cholloferta</a>
            <?= Menu::widget([
                'options' => ['id' => 'nav-mobile', 'class' => 'right side-nav'],
                'items' => [
                    ['label' => 'Inicio', 'url' => ['site/index']],
                    ['label' => 'Acerca de', 'url' => ['site/about']],
                    ['label' => 'Contacto', 'url' => ['site/contact']],
                    ['label' => 'Ofertas', 'url' => ['site/ofertas']],
                    ['label' => 'Categorías', 'url' => ['categorias/index']],    
                    ['label' => 'Acceder', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => Yii::$app->user->isGuest ? '' : 'Bienvenido, ' . Yii::$app->user->identity->username,
                        'items' =>
                        [
                            ['label' => 'Cerrar sesión', 'url' => ['site/logout'], 'linkOptions' => ['data-method' => 'post']],
                        ],'visible' => !Yii::$app->user->isGuest,],
                ],

            ]); ?>
        </div>
    </div>
</nav>

<div class="container-nav">
    <div class="navbar" id="navbar">
        <?= EtiquetasWidget::widget() ?>
    </div>
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

<footer class="color-footer" aria-label="Pie de página">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="orange-text">Sobre Nosotros</h5>
                <p class="grey-text lighten-4" style="text-align: left;">Somos un equipo de estudiantes trabajando en este proyecto como si fuera nuestro trabajo a tiempo completo. Tu apoyo es muy apreciado.</p>
            </div>
            <div class="col l3 s12">
                <h5 class="orange-text">Enlaces</h5>
                <ul>
                    <li><a class="white-text" href="#">Enlace 1</a></li>
                    <li><a class="white-text" href="#">Enlace 2</a></li>
                    <li><a class="white-text" href="#">Enlace 3</a></li>
                    <li><a class="white-text" href="#">Enlace 4</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="orange-text">Redes Sociales</h5>
                <ul>
                    <li><a class="white-text" href="#">Facebook</a></li>
                    <li><a class="white-text" href="#">Twitter</a></li>
                    <li><a class="white-text" href="#">LinkedIn</a></li>
                    <li><a class="white-text" href="#">Instagram</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        M.Sidenav.init(elems);
    });
</script>

</body>
</html>
<?php $this->endPage(); ?>
