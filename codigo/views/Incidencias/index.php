<?php

use app\models\Incidencias;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\IncidenciasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Incidencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidencias-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Incidencias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
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
            //'usuario_destino_id',
            //'oferta_id',
            //'comentario_id',
            //'fecha_lectura',
            //'fecha_aceptado',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Incidencias $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
