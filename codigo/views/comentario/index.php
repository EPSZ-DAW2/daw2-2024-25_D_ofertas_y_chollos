<?php

use app\models\Comentario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ComentarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Comentarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Comentario', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Revisar Denuncias', ['revisar-denuncias'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'oferta_id',
            'texto:ntext',
            'cerrado',
            [
                'attribute' => 'bloqueado',
                'value' => function($model) {
                    return $model->bloqueado ? 'Sí' : 'No';
                },
                'filter' => [1 => 'Sí', 0 => 'No'],
            ],
            'denuncias',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {bloquear} {desbloquear}',
                'buttons' => [
                    'bloquear' => function($url, $model, $key) {
                        if (!$model->bloqueado) {
                            return Html::a('Bloquear', ['comentario/bloquear', 'id' => $model->id], [
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => '¿Estás seguro de que deseas bloquear este comentario?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                        return '';
                    },
                    'desbloquear' => function($url, $model, $key) {
                        if ($model->bloqueado) {
                            return Html::a('Desbloquear', ['comentario/desbloquear', 'id' => $model->id], [
                                'class' => 'btn btn-success btn-sm',
                                'data' => [
                                    'confirm' => '¿Estás seguro de que deseas desbloquear este comentario?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                        return '';
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
