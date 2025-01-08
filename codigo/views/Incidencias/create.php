<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Incidencias $model */

$this->title = 'Create Incidencias';
$this->params['breadcrumbs'][] = ['label' => 'Incidencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidencias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
