<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Ofertas y Chollos';
?>
<div class="site-index">

    <!-- CONTENEDOR FLEX PARA LOS BUSCADORES -->
    <div class="search-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <!-- BUSCADOR DE PALABRAS CLAVE -->
        <div class="search-bar" style="flex: 1; margin-right: 20px;">
            <?= Html::beginForm(['ofertas/search'], 'get', ['class' => 'form-inline']) ?>
            <div class="form-group">
                <?= Html::textInput('keyword', Yii::$app->request->get('keyword'), [
                    'class' => 'form-control',
                    'placeholder' => 'Buscar ofertas...',
                    'style' => 'width: 300px; margin-right: 10px;'
                ]) ?>
            </div>
            <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
            <?= Html::endForm() ?>
        </div>

        <!-- BUSCADOR AVANZADO -->
        <div class="advanced-search" style="flex: 1; text-align: right;">
            <?= Html::beginForm(['ofertas/advanced-search'], 'get', ['class' => 'form-inline']) ?>
            <div class="form-group">
                <?= Html::textInput('titulo', Yii::$app->request->get('titulo'), [
                    'class' => 'form-control',
                    'placeholder' => 'Título...',
                    'style' => 'width: 200px; margin-right: 10px;'
                ]) ?>
            </div>
            <div class="form-group">
                <?= Html::textInput('categoria', Yii::$app->request->get('categoria'), [
                    'class' => 'form-control',
                    'placeholder' => 'Categoría...',
                    'style' => 'width: 200px; margin-right: 10px;'
                ]) ?>
            </div>
            <div class="form-group">
                <?= Html::textInput('precio_max', Yii::$app->request->get('precio_max'), [
                    'class' => 'form-control',
                    'placeholder' => 'Precio máximo...',
                    'style' => 'width: 200px; margin-right: 10px;'
                ]) ?>
            </div>
            <?= Html::submitButton('Buscar Avanzado', ['class' => 'btn btn-success']) ?>
            <?= Html::endForm() ?>
        </div>
    </div>

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
                <li><a href="<?= Yii::$app->urlManager->createUrl(['categorias/visor']) ?>">Más...</a></li>
            </ul>
        </div>
    </div>

    <!-- CONTENEDOR DEBAJO (OFERTAS) -->
    <div class="jumbotron">
        
       <h1 class="texto-inicial">Anuncios de ofertas</h1>
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
