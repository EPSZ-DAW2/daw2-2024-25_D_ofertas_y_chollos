<?php

/** @var yii\web\View $this */

$this->title = 'Ofertas y Chollos';
?>
<div class="site-index">

    <!-- CONTENEDOR ARRIBA (CATEGORÍAS) -->
    <section class="contenedor-categorias" aria-label="Categorías principales">
        <div class="categorias">
            <p style="font-size: 30px; margin-top: -10px;">
                <a style="color: #000;" href="<?= Yii::$app->urlManager->createUrl(['categorias/index']) ?>" aria-label="Explora todas nuestras categorías">
                    <strong>Explora todas nuestras categorías</strong>
                </a>
            </p>
            <ul>
                <li><a href="#" aria-label="Tecnología">Tecnología</a></li>
                <li><a href="#" aria-label="Hogar">Hogar</a></li>
                <li><a href="#" aria-label="Moda">Moda</a></li>
                <li><a href="#" aria-label="Deportes">Deportes</a></li>
                <li><a href="#" aria-label="Juguetes">Juguetes</a></li>
                <li><a href="#" aria-label="Coches">Coches</a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl(['categorias/index']) ?>" aria-label="Más categorías">Más...</a></li>
            </ul>
        </div>
    </section>

    <!-- CONTENEDOR DEBAJO (OFERTAS) -->
    <section class="jumbotron" aria-label="Ofertas exclusivas">
        <h1 class="texto-inicial">Ofertas exclusivas que no querrás perderte</h1>
        <p style="font-size: 20px; font-weight: bold;">Aprovecha los mejores precios del mercado</p>
        <div class="offers" aria-live="polite">
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <div class="offer" aria-label="Oferta <?= $i ?>">
                    <h3>Oferta <?= $i ?></h3>
                    <p>Descripción breve de la oferta <?= $i ?>.</p>
                    <button aria-label="Ver más sobre la oferta <?= $i ?>">Ver más</button>
                </div>
            <?php endfor; ?>
        </div>
    </section>

</div>
