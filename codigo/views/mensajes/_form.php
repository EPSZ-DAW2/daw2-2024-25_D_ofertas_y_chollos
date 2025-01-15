<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Mensajes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mensajes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_hora')->textInput() ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'usuario_origen_id')->textInput() ?>

    <?= $form->field($model, 'usuario_destino_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
