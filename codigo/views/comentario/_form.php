<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Comentario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="comentario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?php if (!$model->cerrado): ?>
        <?= $form->field($model, 'comentario_origen_id')->hiddenInput()->label(false) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar Comentario', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
