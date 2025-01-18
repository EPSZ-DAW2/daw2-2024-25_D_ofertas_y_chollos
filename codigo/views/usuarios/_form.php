<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    select {
        display: block !important;
    }
</style>
<div class="usuarios-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(
        //si es un registro nuevo no se mostrara ese mensaje
        $model->isNewRecord
            ? ['maxlenght' => true] //Para create no se muestra nada
            : [
                'maxlength' => true,
                'value' => '',
                'placeholder' => 'Deja vacío para mantener la contraseña actual'
            ]
    ) ?>

    <?= $form->field($model, 'nick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <!--- $form->field($model, 'fecha_registro')->textInput() --->

    <!--- $form->field($model, 'registro_confirmado')->textInput() --->

    <!--- $form->field($model, 'fecha_ultimo_acceso')->textInput() --->

    <!--- $form->field($model, 'accesos_fallidos')->textInput() --->

    <!---- $form->field($model, 'bloqueado')->textInput() --->

    <!----  $form->field($model, 'fecha_bloqueo')->textInput() --->

    <!--- $form->field($model, 'motivo_bloqueo')->textInput(['maxlength' => true]) --->




    <?= $form->field($model, 'rol', ['options' => ['style' => 'margin-bottom: 20px;']])->dropDownList(
        $roles,
        ['prompt' => 'Selecciona un rol']
    ) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>