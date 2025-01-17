<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\Etiqueta $etiqueta */
/** @var app\models\Oferta[] $ofertas */

$this->title = Html::encode($etiqueta->nombre);
$this->params['breadcrumbs'][] = ['label' => 'Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/themes/material-default/css/visor.css');
?>

<div class="etiqueta-ver">
    

    <h1 class="section-title">Ofertas relacionadas con "<?= Html::encode($etiqueta->nombre) ?>"</h1>

    <div class="ofertas-list">
        <?php if (!empty($ofertas)): ?>
            <?php foreach ($ofertas as $oferta): ?>
                <div class="oferta-card">
                    <h3 class="oferta-title"><?= Html::encode($oferta->titulo) ?></h3>
                    <p class="oferta-description"><?= Html::encode($oferta->descripcion) ?></p>
                    <p class="oferta-fecha">Fecha de inicio: <?= Html::encode($oferta->fecha_inicio) ?></p>
                    <a href="<?= Url::to(['ofertas/view', 'id' => $oferta->id]) ?>" class="oferta-link">Ver oferta</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay ofertas relacionadas con esta etiqueta.</p>
        <?php endif; ?>
    </div>
</div>