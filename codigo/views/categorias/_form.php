<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Categorias $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="categoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?php if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->rol == 1 || Yii::$app->user->identity->rol == 2 || Yii::$app->user->identity->rol == 3)): ?>
        <?= $form->field($model, 'categoria_padre_id')->textInput() ?>

        <?= $form->field($model, 'revisado')->textInput() ?>
    <?php endif?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
