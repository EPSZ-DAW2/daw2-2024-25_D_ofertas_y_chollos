<?php

use app\models\Anuncio;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AnunciosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Anuncios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Anuncio'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'precio',
            'fecha',
            //'oferta_id',
            // Configuración de la columna de acciones
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {bloquear} {desbloquear}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['view', 'id' => $model->id]);
                    }
                    if ($action === 'update') {
                        return Url::to(['update', 'id' => $model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['delete', 'id' => $model->id]);
                    }
                    if ($action === 'bloquear') {
                        return Url::to(['bloquear', 'id' => $model->id]);
                    }
                    if ($action === 'desbloquear') {
                        return Url::to(['desbloquear', 'id' => $model->id]);
                    }
                    return '';
                },
                'buttons' => [
                    'bloquear' => function ($url, $model, $key) {
                        return Html::a('Bloquear', ['bloquear', 'id' => $model->id], [
                            'class' => 'btn boton-bloq',
                            'data-confirm' => '¿Está seguro de bloquear este anuncio?',
                        ]);
                    },
                    'desbloquear' => function ($url, $model, $key) {
                        return Html::a('Desbloquear', ['desbloquear', 'id' => $model->id], [
                            'class' => 'btn boton-desbloq',
                            'data-confirm' => '¿Está seguro de desbloquear este anuncio?',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>




