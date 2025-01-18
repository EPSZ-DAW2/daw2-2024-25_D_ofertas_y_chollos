<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Ofertas $model */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alertas de Ofertas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ofertas-view">


    <div class="form-group">
        <?= Html::a('Volver a las Alertas', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>


    <div class="oferta-card">
        <h1><?= Html::encode($this->title) ?></h1>





        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-bordered detail-view'],
            'attributes' => [
                'titulo',
                [
                    'attribute' => 'descripcion',
                    'format' => 'ntext',
                ],
                [
                    'attribute' => 'precio_actual',
                    'label' => 'Precio Actual (€)',
                    'value' => function ($model) {
                        return Yii::$app->formatter->asCurrency($model->precio_actual, 'EUR');
                    },
                ],
                [
                    'attribute' => 'fecha_inicio',
                    'label' => 'Fecha de Inicio',
                    'value' => function ($model) {
                        return Yii::$app->formatter->asDatetime($model->fecha_inicio);
                    },
                ],
            ],
        ]) ?>

    </div>
</div>



<style>
    .btn.btn-primary {
        background-color: #007bff;
        color: white !important;
    }

    .btn.btn-primary:hover {
        background-color: #0056b3;
        color: white !important;
    }


    .ofertas-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .oferta-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .oferta-title {
        font-size: 1.25em;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .oferta-description {
        margin-bottom: 10px;
        color: #555;
    }

    .oferta-actions {
        margin-top: 10px;
    }

    .btn.btn-primary {
        background-color: #007bff;
        color: white !important;
    }

    .btn.btn-primary:hover {
        background-color: #0056b3;
        color: white !important;
    }
</style>