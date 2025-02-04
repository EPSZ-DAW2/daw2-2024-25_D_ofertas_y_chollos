<?php

use app\models\Incidencia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\IncidenciasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Incidencias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidencia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Incidencia'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha_hora',
            'clase',
            'texto:ntext',
            'usuario_origen_id',
            //'oferta_id',
            //'comentario_id',
            //'fecha_lectura',
            //'fecha_aceptado',
            [
                'attribute' => 'aceptada',
                'label' => 'Aceptada',
                'value' => function ($model) {
                    return $model->fecha_aceptado === null ? 'No' : 'Sí';
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Incidencia $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
