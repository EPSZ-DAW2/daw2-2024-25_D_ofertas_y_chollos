<?php

/** @var yii\web\View $this */

$this->title = 'Ofertas y Chollos';
?>
<div class="site-index">

    <!-- CONTENEDOR ARRIBA (CATEGORÍAS) -->
    <div class="contenedor-categorias">
        <aside class="categorias">
            <p><a style="color: #000;" href="<?= Yii::$app->urlManager->createUrl(['categorias/index']) ?>"><strong>Categorías</strong></a></p>
            <ul>
                <li><a href="#">Tecnología</a></li>
                <li><a href="#">Hogar</a></li>
                <li><a href="#">Moda</a></li>
                <li><a href="#">Deportes</a></li>
                <li><a href="#">Juguetes</a></li>
                <li><a href="#">Automóvil</a></li>
                <li><a href="#">Más...</a></li>
            </ul>
        </aside>
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
           
            </div>
        </div>
    </div>

</div>
