<?php

/** @var yii\web\View $this */

$this->title = 'Ofertas y Chollos';
?>
<div class="site-index">

    <!-- CONTENEDOR ARRIBA (CATEGORÍAS) -->
    <div class="contenedor-categorias">
        <div class="categorias">
            <p style="font-size: 30px; margin-top: -10px;"><a style="color: #000;" href="<?= Yii::$app->urlManager->createUrl(['categorias/index']) ?>"><strong>Explora todas nuestras categorías</strong></a></p>
            <ul>
                <li><a href="#">Tecnología</a></li>
                <li><a href="#">Hogar</a></li>
                <li><a href="#">Moda</a></li>
                <li><a href="#">Deportes</a></li>
                <li><a href="#">Juguetes</a></li>
                <li><a href="#">Coches</a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl(['categorias/index']) ?>">Más...</a></li>
            </ul>
        </div>
    </div>

    <!-- CONTENEDOR DEBAJO (OFERTAS) -->
    <div class="jumbotron">
        <h1 class="texto-inicial">Ofertas exclusivas que no querrás perderte</h1>
        <p style="font-size: 20px; font-weight: bold;">Aprovecha los mejores precios del mercado</p>
        <div class="offers">
            <div class="offer">
                <h3>Oferta 1</h3>
                <p>Descripción breve de la oferta 1.</p>
                <button>Ver más</button>
            </div>
            <div class="offer">
                <h3>Oferta 2</h3>
                <p>Descripción breve de la oferta 2.</p>
                <button>Ver más</button>
            </div>
            <div class="offer">
                <h3>Oferta 3</h3>
                <p>Descripción breve de la oferta 3.</p>
                <button>Ver más</button>
            </div>
            <div class="offer">
                <h3>Oferta 4</h3>
                <p>Descripción breve de la oferta 4.</p>
                <button>Ver más</button>
            </div>

            <div class="offer">
                <h3>Oferta 5</h3>
                <p>Descripción breve de la oferta 5.</p>
                <button>Ver más</button>
            </div>

            <div class="offer">
                <h3>Oferta 6</h3>
                <p>Descripción breve de la oferta 6.</p>
                <button>Ver más</button>
            </div>
           
            </div>
        </div>
    </div>


    <!--
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
  </div>-->


</div>
