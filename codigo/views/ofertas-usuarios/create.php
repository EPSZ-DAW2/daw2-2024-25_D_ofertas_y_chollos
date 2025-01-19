<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ofertas $model */

$this->title = Yii::t('app', 'Create Ofertas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mis Ofertas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ofertas-create">

    <h1><?= Html::encode($this->title) ?></h1>

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



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>