<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $tag */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Resultados por Etiqueta';
?>
<div class="ofertas-search-by-tag">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Resultados para la etiqueta: <strong><?= Html::encode($tag) ?></strong></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'titulo',
            'descripcion:ntext',
            [
                'attribute' => 'url_externa',
                'format' => 'url',
                'label' => 'URL',
            ],
            'fecha_inicio',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]) ?>

</div>
