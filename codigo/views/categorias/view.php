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
            <?= Html::a($model->categoriaPadre->nombre)?>
        <?php endif ?>
        <p>Descripción: <?= Html::a($model->descripcion) ?></p>
        <p><?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'botonFormulario']) ?></p>
        <?= Html::a(Yii::t('app', 'Borrar Categoría'), ['delete', 'id' => $model->id], [
            'class' => 'botonFormulario',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de que quieres eliminar este elemento?'),
                'method' => 'post',
            ],
        ]) ?>
        <p><?= Html::a(Yii::t('app', 'Atrás'), ['index'], ['class' => 'botonFormulario']) ?></p>
    </div>
</div>