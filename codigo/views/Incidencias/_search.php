<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\IncidenciasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="incidencias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha_hora') ?>

    <?= $form->field($model, 'clase') ?>

    <?= $form->field($model, 'texto') ?>

    <?= $form->field($model, 'usuario_origen_id') ?>

    <?php // echo $form->field($model, 'usuario_destino_id') ?>

    <?php // echo $form->field($model, 'oferta_id') ?>

    <?php // echo $form->field($model, 'comentario_id') ?>

    <?php // echo $form->field($model, 'fecha_lectura') ?>

    <?php // echo $form->field($model, 'fecha_aceptado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
