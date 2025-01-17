<?php

use app\models\Patrocinadores;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PatrocinadoresSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Patrocinadores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patrocinadores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Patrocinadores'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'usuario_id',
            'nombre',
            [
                'attribute' => 'aprobado',
                'value' => function ($model) {
                    return $model->aprobado == 1 ? 'Aprobado' : ($model->aprobado == 2 ? 'Rechazado' : 'Pendiente');
                },
                'label' => 'Estado de Aprobación',
            ],
            'creado_en',
            //'actualizado_en',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {aprobar} {rechazar}', // Agregamos las nuevas acciones
                'buttons' => [
                    'aprobar' => function ($url, $model, $key) {
                        if ($model->aprobado == 0) { // Mostrar solo si está pendiente
                            return Html::a('Aprobar', ['aprobar', 'id' => $model->id], [
                                'class' => 'btn btn-success',
                                'data-method' => 'post', // Método POST para aprobar
                                'data-confirm' => '¿Estás seguro de aprobar este patrocinador?',
                            ]);
                        }
                    },
                    'rechazar' => function ($url, $model, $key) {
                        if ($model->aprobado == 0) { // Mostrar solo si está pendiente
                            return Html::a('Rechazar', ['rechazar', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data-method' => 'post', // Método POST para rechazar
                                'data-confirm' => '¿Estás seguro de rechazar este patrocinador?',
                            ]);
                        }
                    },
                ],
                'urlCreator' => function ($action, Patrocinadores $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>

</div>
