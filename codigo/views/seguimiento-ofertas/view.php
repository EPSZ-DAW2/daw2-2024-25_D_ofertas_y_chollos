<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Ofertas $model */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'OFERTAS EN SEGUIMIENTO', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ficha-resumen">


    <p><?= Html::a('VOLVER A OFERTAS EN SEGUIMIENTO', ['seguimiento-ofertas/index'], ['class' => 'btn btn-success']) ?></p>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo',
            'descripcion:ntext',
            'precio_actual',
            'fecha_inicio',
            'fecha_fin',
            'estado',
        ],
    ]) ?>

    <p>
        <?= Html::a('Dejar de Seguir', ['dejar-de-seguir', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => ['confirm' => '¿Seguro que deseas dejar de seguir esta oferta?'],
        ]) ?>
    </p>
</div>