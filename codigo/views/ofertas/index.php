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
        <?= Html::a(Yii::t('app', 'Crear nueva oferta'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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

            [
                'attribute' => 'categoria_id',
                'value' => 'categoria.nombre',
                'label' => 'Categoría',
            ],
            [
                'attribute' => 'zona_id',
                'value' => 'zona.nombre',
                'label' => 'Zona',
            ],
            [
                'attribute' => 'proveedor_id',
                'value' => 'proveedor.nombre',
                'label' => 'Proveedor',
            ],
            [
                'attribute' => 'estado',
                'label' => 'Estado',
            ],

            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {bloquear} {desbloquear}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'bloquear' => function ($url, $model, $key) {
                        if ($model->estado === 'visible') {
                            return Html::a('Bloquear', $url, [
                                'class' => 'btn btn-warning',
                                'data-confirm' => '¿Estás seguro de bloquear esta oferta?',
                            ]);
                        }
                        return '';
                    },
                    'desbloquear' => function ($url, $model, $key) {
                        if ($model->estado === 'bloqueada') {
                            return Html::a('Desbloquear', $url, [
                                'class' => 'btn btn-success',
                                'data-confirm' => '¿Estás seguro de desbloquear esta oferta?',
                            ]);
                        }
                        return '';
                    },
                ],
            ],
        ],
    ]); ?>

</div>
