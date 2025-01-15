<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Ofertas $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ofertas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ofertas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'titulo',
            'descripcion:ntext',
            'url_externa:url',
            'fecha_inicio',
            'fecha_fin',
            'precio_actual',
            'precio_original',
            'descuento',
            'zona_id',
            'categoria_id',
            'proveedor_id',
            'anuncio_destacado',
            'estado',
            'denuncias',
            'fecha_primer_denuncia',
            'motivo_denuncia:ntext',
            'fecha_bloqueo',
            'motivo_bloqueo:ntext',
            'cerrado_comentar',
            'usuario_creador_id',
            'fecha_creacion',
            'usuario_modificador_id',
            'fecha_modificacion',
        ],
    ]) ?>

</div>
