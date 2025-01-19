<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */
/** @var yii\widgets\ActiveForm $form */


$this->title = 'CAMBIO DE CONTRASEÑA';

?>
<div class="usuarios-form">

    <p><?= Html::a('Volver a Mi Perfil', ['usuarios/mi-perfil'], ['class' => 'btn btn-success']) ?></p>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Completa el siguiente formulario para cambiar tu contraseña:</p>

    <div class="form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'contrasena_actual')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nueva_contrasena')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'confirmar_contrasena')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Cambiar Contraseña', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>