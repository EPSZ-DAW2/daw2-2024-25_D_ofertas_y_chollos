<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ofertas[] $ofertasPatrocinadas */

$this->title = Yii::t('app', 'Ofertas Patrocinadas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ofertas-patrocinadas">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (empty($ofertasPatrocinadas)): ?>
        <p><?= Yii::t('app', 'No hay ofertas patrocinadas disponibles en este momento.') ?></p>
    <?php else: ?>
        <?php foreach ($ofertasPatrocinadas as $oferta): ?>
            <div class="oferta">
                <h3><?= Html::encode($oferta->titulo) ?></h3>
                <p><strong><?= Yii::t('app', 'Descripción:') ?></strong> <?= Html::encode($oferta->descripcion) ?></p>
                <p><strong><?= Yii::t('app', 'Patrocinador:') ?></strong> <?= Html::encode($oferta->patrocinador->nick) ?></p>
                <?= Html::a(Yii::t('app', 'Ver Detalles'), ['ofertas/view', 'id' => $oferta->id], ['class' => 'btn btn-primary']) ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>
