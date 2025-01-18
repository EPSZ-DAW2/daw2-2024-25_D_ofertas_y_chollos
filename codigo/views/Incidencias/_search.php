<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\IncidenciasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="incidencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha_hora') ?>

    <?= $form->field($model, 'clase') ?>

    <?= $form->field($model, 'texto') ?>

    <?= $form->field($model, 'usuario_origen_id') ?>

    <?php // echo $form->field($model, 'oferta_id') ?>

    <?php // echo $form->field($model, 'comentario_id') ?>

    <?php // echo $form->field($model, 'fecha_lectura') ?>

    <?php // echo $form->field($model, 'fecha_aceptado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
