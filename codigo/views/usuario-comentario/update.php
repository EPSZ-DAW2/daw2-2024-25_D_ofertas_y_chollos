<?php

use app\models\Comentario;
use yii\helpers\Html;
use app\models\Ofertas;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ComentarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Editar Comentarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-index">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>




    <h1><?= Html::encode($this->title) ?></h1>

    <div class="comentario-info">
        <h3>Oferta</h3>
        <p><strong>Título:</strong> <?= Html::encode($model->oferta->titulo) ?></p>
        <p><strong>Descripción:</strong> <?= Html::encode($model->oferta->descripcion) ?></p>
        <p><strong>Precio Actual:</strong> <?= Html::encode($model->oferta->precio_actual) ?> €</p>
    </div>

    <div class="comentario-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>