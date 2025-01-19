<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Usuarios $model */
/** @var yii\widgets\ActiveForm $form */


$this->title = 'MI PERFIL';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>


    <div class="usuarios-form">
        <h3>DATOS DE USUARIO</h3>
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
        <h3>OPCIONES DE PERFIL</h3>

        <?= Html::a('Cambiar Contraseña', ['usuarios/cambiar-contrasena'], ['class' => 'btn btn-warning']) ?>

        <?= Html::a(
            isset($mensajesNuevos) && $mensajesNuevos > 0
                ? "Notificaciones ({$mensajesNuevos})"
                : 'Notificaciones',
            ['mensajes/index'],
            ['class' => isset($mensajesNuevos) && $mensajesNuevos > 0 ? 'btn btn-primary' : 'btn']
        ) ?>
        <?= Html::a(
            isset($mensajesAdminNuevos) && $mensajesAdminNuevos > 0
                ? "Avisos de Administrador ({$mensajesAdminNuevos})"
                : 'Avisos de Administrador',
            ['mensajes/admin'],
            ['class' => isset($mensajesAdminNuevos) && $mensajesAdminNuevos > 0 ? 'btn btn-primary' : 'btn btn-secondary']
        ) ?>
        <?= Html::a('Alertas de Ofertas', ['alertas-ofertas/index'], ['class' => 'btn btn-primary']) ?>

    </div>

    <hr>






    <div class="perfil-mensajes">
        <h3>MENSAJES NUEVOS</h3>
        <?php if (isset($mensajesNuevos) && $mensajesNuevos > 0): ?>
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
    </div>

    <hr>



    <div class="perfil-funcionalidades">
        <h3>MÁS OPCIONES</h3>
        <div class="row">
            <div class="col-md-4">
                <?= Html::a('Mis Comentarios', ['usuario-comentario/index'], ['class' => 'btn btn-info btn-block']) ?>
            </div>
            <div class="col-md-4">
                <?= Html::a('Seguimiento de Ofertas', ['seguimiento-ofertas/index'], ['class' => 'btn btn-info btn-block']) ?>
            </div>
            <div class="col-md-4">
                <?= Html::a('Seguimiento de Etiquetas', ['seguimiento-etiquetas/index'], ['class' => 'btn btn-info btn-block']) ?>
            </div>

            <div class="col-md-4">
                <?= Html::a('Preferencias', ['preferencias/index'], ['class' => 'btn btn-info btn-block']) ?>
            </div>
            <div class="col-md-4">
                <?= Html::a('Mis Ofertas', ['ofertas-usuarios/index'], ['class' => 'btn btn-info btn-block']) ?>
            </div>
            <div class="col-md-4">
                <?= Html::a('Solicitar Baja', ['usuarios/solicitar-baja'], [
                    'class' => 'btn btn-info btn-block',
                    'data' => [
                        'confirm' => '¿Estás seguro de que quieres solicitar la baja? Esta acción es irreversible.',
                        'data-method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>



<style>
    .perfil {
        max-width: 900px;
        margin: 0 auto;
    }

    .perfil-opciones,
    .perfil-mensajes,
    .perfil-funcionalidades {
        margin-top: 20px;
    }

    .btn-block {
        width: 100%;
        margin-bottom: 10px;
    }
</style>