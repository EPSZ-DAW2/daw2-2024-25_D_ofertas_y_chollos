<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Anuncio $model */

$this->title = Yii::t('app', 'Crear Categoría');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorías'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?= Html::a(Yii::t('app', 'Atrás'), ['visor'], ['class' => 'btn btn-success']) ?>
</div>