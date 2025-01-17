<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Ofertas $model */
/** @var bool $esSeguidor */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ofertas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->registerCssFile('@web/themes/material-default/css/oferta-view.css');
?>
<div class="ofertas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Botones de acción -->
    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de que desea borrar esta oferta?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <!-- Detalles de la oferta -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'titulo',
            'descripcion:ntext',

            'fecha_inicio',
            'fecha_fin',
            'precio_actual',
            'precio_original',


            // Mostrar la categoría, zona, proveedor y comentarios
            [
                'label' => 'Categoría',
                'value' => $model->categoria ? $model->categoria->nombre : 'Sin categoría',
            ],
            [
                'label' => 'Zona',
                'value' => $model->zona ? $model->zona->nombre : 'Sin zona',
            ],
            [
                'label' => 'Proveedor',
                'value' => $model->proveedor ? $model->proveedor->razon_social : 'Sin proveedor',
            ],
        ],
    ]) ?>

</div>