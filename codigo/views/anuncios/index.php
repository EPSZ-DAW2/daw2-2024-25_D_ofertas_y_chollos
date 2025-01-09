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
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Anuncio $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>



<!-- DIV para mostrar el anuncio aleatorio -->


<div style="border: 1px solid #ccc; padding: 20px; width: 300px; margin: 20px auto; text-align: center;">
    <?php if ($randomAnuncio): ?>    
    <h3>Random Anuncio</h3>
    <p>
        <?= Html::encode($randomAnuncio->titulo) ?>
    </p>
    <p>
        <?= Html::encode($randomAnuncio->descripcion) ?>
    </p>
    <p>
        <?= Html::encode($randomAnuncio->precio) ?>
    </p>
    <p>
        <?= Html::encode($randomAnuncio->fecha) ?>
    </p>
    <p>
        <?= Html::encode($randomAnuncio->oferta_id) ?>
    </p>
    <?php else: ?>
        <p>No hay anuncio aleatorio</p>
    <?php endif; ?>
</div>
