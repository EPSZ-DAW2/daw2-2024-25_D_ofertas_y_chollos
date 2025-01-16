<?php
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $recientes array */
/* @var $destacados array */
/* @var $patrocinados array */
/* @var $personalizados array */
/* @var $paginationRecientes yii\data\Pagination */
/* @var $paginationDestacados yii\data\Pagination */
/* @var $paginationPatrocinados yii\data\Pagination */
/* @var $paginationPersonalizados yii\data\Pagination */

$this->title = 'Visor de Ofertas';
$this->registerCssFile('@web/themes/material-default/css/visor.css');
?>

   
<div class="visor-container">
<div class="visor-header">
        <a href="<?= yii\helpers\Url::to(['ofertas/create']) ?>" class="btn btn-primary">Crear Nueva Oferta</a>
    </div>
    <h1 class="visor-title">Visor de Ofertas</h1>

    <div class="section">
        <h2 class="section-title">Ofertas Recientes</h2>
        <div class="ofertas-list">
            <?php foreach ($recientes as $oferta): ?>
                <div class="oferta-card">
                    <h3 class="oferta-title"><?= $oferta->titulo ?></h3>
                    <p class="oferta-description"><?= $oferta->descripcion ?></p>
                    <p class="oferta-fecha">Fecha de inicio: <?= $oferta->fecha_inicio ?></p>
                    <a href="<?= yii\helpers\Url::to(['view', 'id' => $oferta->id]) ?>" class="oferta-link">Ver oferta</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Ofertas Destacadas</h2>
        <div class="ofertas-list">
            <?php foreach ($destacados as $oferta): ?>
                <div class="oferta-card">
                    <h3 class="oferta-title"><?= $oferta->titulo ?></h3>
                    <p class="oferta-description"><?= $oferta->descripcion ?></p>
                    <p class="oferta-fecha">Fecha de inicio: <?= $oferta->fecha_inicio ?></p>
                    <a href="<?= yii\helpers\Url::to(['view', 'id' => $oferta->id]) ?>" class="oferta-link">Ver oferta</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Ofertas Patrocinadas</h2>
        <div class="ofertas-list">
            <?php foreach ($patrocinados as $oferta): ?>
                <div class="oferta-card">
                    <h3 class="oferta-title"><?= $oferta->titulo ?></h3>
                    <p class="oferta-description"><?= $oferta->descripcion ?></p>
                    <p class="oferta-fecha">Fecha de inicio: <?= $oferta->fecha_inicio ?></p>
                    <a href="<?= yii\helpers\Url::to(['view', 'id' => $oferta->id]) ?>" class="oferta-link">Ver oferta</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Ofertas Personalizadas</h2>
        <div class="ofertas-list">
            <?php foreach ($personalizados as $oferta): ?>
                <div class="oferta-card">
                    <h3 class="oferta-title"><?= $oferta->titulo ?></h3>
                    <p class="oferta-description"><?= $oferta->descripcion ?></p>
                    <p class="oferta-fecha">Fecha de inicio: <?= $oferta->fecha_inicio ?></p>
                    <a href="<?= yii\helpers\Url::to(['view', 'id' => $oferta->id]) ?>" class="oferta-link">Ver oferta</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>