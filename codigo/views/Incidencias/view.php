<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Incidencia $model */

$this->title = 'Incidencia '.$model->id.', '.$model->clase;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incidencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->registerCssFile('@web/themes/material-default/css/incidencia-view.css');
?>
<div class="incidencia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="action-buttons">
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de que desea borrar esta incidencia?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php if (is_null($model->fecha_aceptado)) {
            echo Html::a('Aceptar', ['aceptar', 'id' => $model->id], ['class' => 'btn btn-success']);
        } ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fecha_hora',
            'clase',
            'texto:ntext',
            'usuario_origen_id',
            [
                'attribute' => 'oferta_id',
                'visible' => !is_null($model->oferta_id),
            ],
            [
                'attribute' => 'comentario_id',
                'visible' => !is_null($model->comentario_id),
            ],
            [
                'attribute' => 'fecha_lectura',
                'visible' => !is_null($model->fecha_lectura),
            ],
            [
                'attribute' => 'fecha_aceptado',
                'visible' => !is_null($model->fecha_aceptado),
            ],
        ],
    ]) ?>

    <div class="action-buttons">
            <?= Html::a(Yii::t('app', 'Volver'), ['index'], ['class' => 'btn btn-primary', 'style' => 'margin-top: 20px;']) ?>
    </div>

</div>
