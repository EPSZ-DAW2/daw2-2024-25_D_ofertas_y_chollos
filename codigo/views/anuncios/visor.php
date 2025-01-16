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

$this->title = 'Anuncios';
$this->registerCssFile('@web/themes/material-default/css/visor.css');
?>

   
<div class="visor-container">
<div class="visor-header">
        <a href="<?= yii\helpers\Url::to(['anuncios/create']) ?>" class="btn btn-primary">Crear Anuncio</a>
    </div>
    <h1 class="visor-title">Visor de Anuncios</h1>
        <h2 class="section-title">Anuncios disponibles</h2>
        <div class="ofertas-list">
            <?php foreach ($id as $anuncios): ?>
                <div class="anuncio-card">
                    <h3 class="titulo del anuncio"><?= $anuncio->titulo ?></h3>
                    <p class="descripcion del anuncio"><?= $anucio->descripcion ?></p>
                    <p class="fecha del anuncio">Fecha de inicio: <?= $anuncio->fecha_inicio ?></p>
                    <a href="<?= yii\helpers\Url::to(['view', 'id' => $anuncio->id]) ?>" class="oferta-link">Ver oferta</a>
                </div>
            <?php endforeach; ?>
        </div>
</div>