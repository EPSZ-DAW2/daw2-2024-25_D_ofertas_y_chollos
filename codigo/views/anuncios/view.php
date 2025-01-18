<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Anuncio $model */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anuncios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->registerCssFile('@web/themes/material-default/css/anuncio-view.css');
?>
<div class="anuncio-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <!-- Botones de acción -->
    <div class="action-buttons">
    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->rol === 'admin'): ?>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de que desea borrar este anuncio?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Bloquear'), ['bloquear', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', 'Desbloquear'), ['desbloquear', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>

        <!-- Botón para ir a la oferta que corresponde dicho anuncio -->
        <?= Html::a('Ver Oferta', ['ofertas/view', 'id' => $model->oferta_id], ['class' => 'btn btn-primary']) ?>

    </div>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-bordered detail-view'],
        'attributes' => [
            
            'titulo',
            'descripcion:ntext',
            'precio',
            'fecha',
            'estado',
            
        ],
    ]) ?>

    

</div>
