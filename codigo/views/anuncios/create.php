<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Anuncio $model */

$this->title = Yii::t('app', 'Create Anuncio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anuncios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
