<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Patrocinadores $model */

$this->title = Yii::t('app', 'Create Patrocinadores');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patrocinadores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patrocinadores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
