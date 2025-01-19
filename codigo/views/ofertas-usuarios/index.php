<?php

use app\models\Ofertas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OfertasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'MIS OFERTAS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ofertas-index">

    <p><?= Html::a('Volver a Mi Perfil', ['usuarios/mi-perfil'], ['class' => 'btn btn-success']) ?></p>


    <h1><?= Html::encode($this->title) ?></h1>


    <div class="">
        <?= Html::a('Crear Oferta', ['ofertas-usuarios/create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>


    <?php
    ?>

    <?php foreach ($dataProvider->getModels() as $model): ?>
        <div class="oferta-card">
            <?= $this->render('ficha-resumen', ['model' => $model]) ?>
        </div>
    <?php endforeach; ?>




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
        margin: 30px;
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