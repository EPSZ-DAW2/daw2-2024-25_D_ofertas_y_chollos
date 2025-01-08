<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Categorias;

$this->title = 'Detalles de la Categoría';
?>

<div class="site-index">

    <h1><?= Html::a($model->nombre)?></h1>
    <div class="body-content">
        <?php if($model->categoria_padre_id != NULL): ?>
            <?= Html::a($model->categoria_padre_id)?>
        <?php endif ?>
        <p>Descripción: <?= Html::a($model->descripcion) ?></p>
    </div>
</div>