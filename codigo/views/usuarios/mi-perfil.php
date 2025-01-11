<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>



<hr>

<div class="perfil-opciones">
    <h3>Opciones del perfil</h3>

    <?= Html::a('Cambiar Contraseña', ['usuarios/cambiar-contrasena'], ['class' => 'btn btn-warning']) ?>

    <?= Html::a('Solicitar Baja', ['usuarios/solicitar-baja'], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Estás seguro de que quieres solicitar la baja? Esta acción es irreversible.',
            'method' => 'post',
        ],
    ]) ?>

    <?= Html::a('Notificaciones', [''], ['class' => 'btn']) ?>
</div>
</div>