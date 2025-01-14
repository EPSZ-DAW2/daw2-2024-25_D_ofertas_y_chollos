<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Categorias;

$this->title = 'Crear Categoría';
?>

<div class='site-index'>  
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ]); ?>

    <div class='body-content'>
    <h1>CREADOR DE CATEGORÍAS</h1> 
    <p>Por favor, rellene los campos para la creación de una categoría:</p>
    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['placeholder' => 'Ingrese el nombre...', 'class' => 'campo']) ?>
    <?= $form->field($model, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textInput(['placeholder' => 'Ingrese la descripción...', 'class' => 'campo']) ?>
    <?= $form->field($model, 'revisado', ['options' => ['class' => 'campoTitulo']])
    ->textInput([
        'placeholder' => '¿Está revisado?', 
        'class' => 'campo'
    ]); ?>
    <?= $form->field($model, 'categoria_padre_id', ['options' => ['class' => 'campoTitulo']])
    ->textInput([
        'placeholder' => 'Ingrese la categoría padre...', 
        'class' => 'campo'
    ]); ?>
    <br>
    <?= Html::submitButton('Añadir Categoría', ['class' => 'botonFormulario']) ?>
    <br>
    <button><?= Html::a(Yii::t('app', 'Atrás'), ['index'], ['class' => 'botonFormulario']) ?></button>

    <?php ActiveForm::end(); ?>
</div>