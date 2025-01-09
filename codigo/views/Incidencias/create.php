<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Incidencia $model */

$this->title = Yii::t('app', 'Create Incidencia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incidencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
