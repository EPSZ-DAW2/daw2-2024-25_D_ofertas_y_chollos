<?php

use yii\helpers\Html;

$this->title = 'ETIQUETAS EN SEGUIMIENTO';
?>
<div class="seguimiento-etiquetas-index">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('info')): ?>
        <div class="alert alert-info">
            <?= Yii::$app->session->getFlash('info') ?>
        </div>
    <?php endif; ?>

    <p><?= Html::a('Volver a Mi Perfil', ['usuarios/mi-perfil'], ['class' => 'btn btn-success']) ?></p>


    <h1><?= Html::encode($this->title) ?></h1>

    <h3>Etiquetas que sigues</h3>
    <ul class="list-group">
        <?php foreach ($etiquetasSeguidas as $seguida): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= $seguida->etiqueta ? Html::encode($seguida->etiqueta->nombre) : 'Etiqueta no encontrada'; ?>

                <?= Html::a('Dejar de Seguir', ['dejar-de-seguir', 'id' => $seguida->etiqueta_id], [
                    'class' => 'btn',
                    'data' => [
                        'confirm' => '¿Estás seguro de que quieres dejar de seguir esta etiqueta?',
                        'method' => 'post',
                    ],
                ]) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3>Etiquetas disponibles</h3>
    <ul class="list-group">
        <?php foreach ($etiquetasDisponibles as $etiqueta): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= Html::encode($etiqueta->nombre) ?>
                <?= Html::a('Seguir', ['seguir', 'id' => $etiqueta->id], [
                    'class' => 'btn ',
                ]) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>