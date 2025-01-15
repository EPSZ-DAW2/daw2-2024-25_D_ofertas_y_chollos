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


<?php
$fechaUltimoAccesoAnterior = Yii::$app->session->get('fechaUltimoAccesoAnterior', 'No disponible');
?>
<hr>

<div class="perfil-opciones">
    <h3>Opciones del perfil</h3>

    <p><strong>Fecha de último acceso (anterior):</strong> <?= Html::encode($fechaUltimoAccesoAnterior) ?></p>

    <?= Html::a('Cambiar Contraseña', ['usuarios/cambiar-contrasena'], ['class' => 'btn btn-warning']) ?>

    <?= Html::a('Solicitar Baja', ['usuarios/solicitar-baja'], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Estás seguro de que quieres solicitar la baja? Esta acción es irreversible.',
            'method' => 'post',
        ],
    ]) ?>

    <?= Html::a(
        isset($mensajesNuevos) && $mensajesNuevos > 0
            ? "Notificaciones ({$mensajesNuevos})"
            : 'Notificaciones',
        ['mensajes/index'],
        ['class' => isset($mensajesNuevos) && $mensajesNuevos > 0 ? 'btn btn-primary' : 'btn']
    ) ?>


    <?php if ($mensajesNuevos > 0): ?>
        <h4>Mensajes Nuevos:</h4>
        <ul>
            <?php
            $mensajes = \app\models\Mensajes::find()
                ->where(['usuario_destino_id' => Yii::$app->user->identity->id])
                ->andWhere(['>', 'fecha_hora', Yii::$app->session->get('fechaUltimoAccesoAnterior', '2000-01-01 00:00:00')])
                ->all();

            foreach ($mensajes as $mensaje): ?>
                <li><?= Html::encode($mensaje->texto) ?> - <em><?= $mensaje->fecha_hora ?></em></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tienes mensajes nuevos.</p>
    <?php endif; ?>

    <p><strong>Datos de depuración:</strong></p>
    <ul>
        <li><strong>Usuario ID:</strong> <?= Html::encode(Yii::$app->user->identity->id ?? 'No disponible') ?></li>
        <li><strong>Fecha de Último Acceso (Anterior):</strong> <?= Html::encode(Yii::$app->session->get('fechaUltimoAccesoAnterior', 'No disponible')) ?></li>
        <li><strong>Mensajes Nuevos:</strong> <?= Html::encode($mensajesNuevos ?? 'No disponible') ?></li>
    </ul>


</div>