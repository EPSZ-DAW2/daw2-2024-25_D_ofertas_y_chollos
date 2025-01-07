<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Categorias;

$this->title = 'Crear Categoría';
?>

<div class='site-index'>  
    <h1>CREADOR DE PARTIDOS</h1> 

    <div class='body-content'>
    <p>Por favor, rellene los campos para la creación de un partido:</p>
    <?= $form->field($model, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput(['placeholder' => 'Ingrese el nombre...', 'class' => 'campo']) ?>
    <?= $form->field($model, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textInput(['placeholder' => 'Ingrese la descripción...', 'class' => 'campo']) ?>
</div>