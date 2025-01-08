<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Etiqueta $model */

$this->title = 'Create Etiqueta';
$this->params['breadcrumbs'][] = ['label' => 'Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etiqueta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
