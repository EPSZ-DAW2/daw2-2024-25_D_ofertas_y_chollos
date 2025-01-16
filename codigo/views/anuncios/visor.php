<?php
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $anuncios array */
/* @var $pagination yii\data\Pagination */

$this->title = 'Visor de Anuncios';
$this->registerCssFile('@web/themes/material-default/css/visor.css');
?>

<div class="visor-container">
    <div class="visor-header">
        <a href="<?= yii\helpers\Url::to(['anuncios/create']) ?>" class="btn btn-primary">Crear Anuncio</a>
    </div>
    <h1 class="visor-title">Visor de Anuncios</h1>

    <div class="section">
        <h2 class="section-title">Anuncios Disponibles</h2>
        <div class="ofertas-list">
            <?php foreach ($anuncios as $anuncio): ?>
                <div class="oferta-card">
                    <h3 class="oferta-title"><?= $anuncio->titulo ?></h3>
                    <p class="oferta-description"><?= $anuncio->descripcion ?></p>
                    <p class="oferta-fecha">Fecha: <?= $anuncio->fecha ?></p>
                    <p class="oferta-precio">Precio: €<?= $anuncio->precio ?></p>
                    <a href="<?= yii\helpers\Url::to(['view', 'id' => $anuncio->id]) ?>" class="oferta-link">Ver anuncio</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Paginación -->
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>