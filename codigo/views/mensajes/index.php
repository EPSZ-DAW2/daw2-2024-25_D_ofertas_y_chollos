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

$this->title = Yii::t('app', ' Mis Mensajes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensajes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Nuevo Mensaje', ['create'], ['class' => 'btn btn-success']) ?></p>

    <ul class="list-group">
        <?php foreach ($mensajes as $mensaje): ?>
            <li class="list-group-item">
                <strong>De:</strong> <?= Html::encode($mensaje->nombreUsuarioOrigen) ?><br>
                <strong>Para:</strong> <?= Html::encode($mensaje->nombreUsuarioDestino) ?><br>
                <?= Html::encode($mensaje->texto) ?><br>
                <small><i>Enviado el <?= Html::encode($mensaje->fecha_hora) ?></i></small>
                <?= Html::a('Ver Detalle', ['view', 'id' => $mensaje->id], ['class' => 'btn btn-info btn-sm']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>