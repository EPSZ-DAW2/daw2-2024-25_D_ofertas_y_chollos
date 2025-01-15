<?php

use app\models\Ofertas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OfertasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Ofertas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ofertas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ofertas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo',
            'descripcion:ntext',
            'url_externa:url',
            'fecha_inicio',
            //'fecha_fin',
            //'precio_actual',
            //'precio_original',
            //'descuento',
            //'zona_id',
            //'categoria_id',
            //'proveedor_id',
            //'anuncio_destacado',
            //'estado',
            //'denuncias',
            //'fecha_primer_denuncia',
            //'motivo_denuncia:ntext',
            //'fecha_bloqueo',
            //'motivo_bloqueo:ntext',
            //'cerrado_comentar',
            //'usuario_creador_id',
            //'fecha_creacion',
            //'usuario_modificador_id',
            //'fecha_modificacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Ofertas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
