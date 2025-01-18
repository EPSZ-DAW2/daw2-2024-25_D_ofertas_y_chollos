<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Incidencia $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="incidencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clase')->textInput(['maxlength' => true, 'placeholder'=>'Denuncia, Reclamación...']) ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'usuario_origen_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <?= $form->field($model, 'oferta_id')->textInput(['placeholder'=>'En caso de que la incidencia sea sobre una oferta']) ?>

    <?= $form->field($model, 'comentario_id')->textInput(['placeholder'=>'En caso de que la incidencia sea sobre un comentario']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
