<?php

use app\models\Mensajes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\MensajesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', ' Avisos Administradores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensajes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Volver a Mi Perfil', ['usuarios/mi-perfil'], ['class' => 'btn btn-success']) ?></p>

    <h3>Mensajes no leídos</h3>
    <?php if (!empty($mensajesNoLeidos)): ?>
        <ul class="list-group">
            <?php foreach ($mensajesNoLeidos as $mensaje): ?>
                <li class="list-group-item">
                    <strong>De:</strong> <?= Html::encode($mensaje->nombreUsuarioOrigen) ?><br>
                    <?= Html::encode($mensaje->texto) ?><br>
                    <small><i>Enviado el <?= Html::encode($mensaje->fecha_hora) ?></i></small>

                <?php endforeach; ?>
        </ul>


    <?php else: ?>
        <p>No tienes ningún mensaje no leído</p>
    <?php endif; ?>



    <h3>Mensajes anteriores</h3>
    <?php if (!empty($mensajesOtros)): ?>
        <ul class="list-group">
            <?php foreach ($mensajesOtros as $mensaje): ?>
                <li class="list-group-item">
                    <strong>De:</strong> <?= Html::encode($mensaje->nombreUsuarioOrigen) ?><br>
                    <?= Html::encode($mensaje->texto) ?><br>
                    <small><i>Enviado el <?= Html::encode($mensaje->fecha_hora) ?></i></small>
                </li>
            <?php endforeach; ?>
        </ul>


    <?php else: ?>
        <p>No tienes avisos de administradores</p>
    <?php endif; ?>

</div>