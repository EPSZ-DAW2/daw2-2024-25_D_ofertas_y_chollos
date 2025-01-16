<?php

/** @var yii\web\View $this */
/** @var app\models\Ofertas $model */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="ficha-resumen">
    <h3><?= Html::encode($model->titulo) ?></h3>
    <p><?= Html::encode($model->descripcion) ?></p>
    <p><strong>Precio:</strong> <?= Html::encode($model->precio_actual) ?> €</p>
    <p><strong>Fecha de inicio:</strong> <?= Html::encode($model->fecha_inicio) ?></p>
    <a href="<?= Url::to(['view', 'id' => $model->id]) ?>" class="btn btn-primary">Ver más</a>
</div>
