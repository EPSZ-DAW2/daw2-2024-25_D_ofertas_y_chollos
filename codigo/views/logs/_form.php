<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Log $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nivel')->textInput(['maxlength' => true, 'placeholder' => 'INFO, WARNING o ERROR']) ?>

    <?= $form->field($model, 'modulo')->textInput(['maxlength' => true, 'placeholder' => 'Base de datos, Registro, Ofertas...']) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
