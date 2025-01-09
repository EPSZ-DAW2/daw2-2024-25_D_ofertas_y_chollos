<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Incidencia $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="incidencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_hora')->textInput() ?>

    <?= $form->field($model, 'clase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'usuario_origen_id')->textInput() ?>

    <?= $form->field($model, 'usuario_destino_id')->textInput() ?>

    <?= $form->field($model, 'oferta_id')->textInput() ?>

    <?= $form->field($model, 'comentario_id')->textInput() ?>

    <?= $form->field($model, 'fecha_lectura')->textInput() ?>

    <?= $form->field($model, 'fecha_aceptado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
