<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Log $model */

$this->title = 'Log '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->registerCssFile('@web/themes/material-default/css/log-view.css');
?>
<div class="log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="action-buttons">
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Está seguro de que desea borrar este log?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fecha_hora',
            'nivel',
            'modulo',
            'descripcion',
        ],
    ]) ?>

    <div class="action-buttons">
            <?= Html::a(Yii::t('app', 'Volver'), ['index'], ['class' => 'btn btn-primary', 'style' => 'margin-top: 20px;']) ?>
    </div>

</div>
