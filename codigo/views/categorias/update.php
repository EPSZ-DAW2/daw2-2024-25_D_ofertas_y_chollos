<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Categorias $model */

$this->title = Yii::t('app', 'Update Categoría: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="categorias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?= Html::a(Yii::t('app', 'Atrás'), ['visor'], ['class' => 'btn btn-success']) ?>
</div>