<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

$this->title = 'Ofertas y Chollos';
?>
<div class="site-index" style="display: flex;">





<!-- CONTENEDOR FLEX PARA LOS BUSCADORES -->
<div class="search-container" style="display: flex; gap: 20px; margin-bottom: 20px;">
    <!-- BUSCADOR DE PALABRAS CLAVE -->
    <div class="search-bar">
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
    <div class="advanced-search">
        <?= Html::beginForm(['ofertas/advanced-search'], 'get', ['class' => 'form-inline']) ?>
        <div class="form-group">
            <?= Html::textInput('titulo', Yii::$app->request->get('titulo'), [
                'class' => 'form-control',
                'placeholder' => 'Título...',
                'style' => 'width: 200px; margin-right: 10px;'
            ]) ?>
        </div>
        <div class="form-group">
            <?= Html::textInput('zona_id', Yii::$app->request->get('zona'), [
                'class' => 'form-control',
                'placeholder' => 'Zona...',
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
        <div class="form-group">
            <?= Html::input('date', 'fecha_inicio', Yii::$app->request->get('fecha_inicio'), [
                'class' => 'form-control',
                'placeholder' => 'Fecha de inicio...',
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
                <?php foreach ($recientes as $oferta): ?>
                    <div class="offer">
                        <h3><?= Html::encode($oferta->titulo) ?></h3>
                        <p><?= Html::encode($oferta->descripcion) ?></p>
                        <p>Fecha de inicio: <?= Yii::$app->formatter->asDate($oferta->fecha_inicio) ?></p>
                        <a href="<?= yii\helpers\Url::to(['ofertas/view', 'id' => $oferta->id]) ?>" class="btn btn-primary">Ver más</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
