<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Actualizar datos de la categoría';
?>

<div class="site-index">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ]); ?>

    <div class="body-content">
        <h1>Modificar datos de la categoría</h1>
        <p>Por favor, rellene los campos para la modificación de la categoría:</p>
        <?= $form->field($categoria, 'nombre', ['options' => ['class' => 'campoTitulo']])->textInput([
            'placeholder' => 'Ingrese el nombre nuevo...', 
            'class' => 'campo'
        ]) ?>
        <?= $form->field($categoria, 'descripcion', ['options' => ['class' => 'campoTitulo']])->textInput([
            'placeholder' => 'Ingrese la descripción nueva...', 
            'class' => 'campo'
        ]) ?>
        <?= $form->field($categoria, 'revisado', ['options' => ['class' => 'campoTitulo']])
        ->textInput([
            'placeholder' => '¿Está revisado?', 
            'class' => 'campo'
        ]); ?>
        <?= $form->field($categoria, 'categoria_padre_id', ['options' => ['class' => 'campoTitulo']])
        ->textInput([
            'placeholder' => 'Ingrese la categoría padre...', 
            'class' => 'campo'
        ]); ?>
        <br>
        <?= Html::submitButton('Modificar Categoría', ['class' => 'btn btn-success']) ?>
        <br>
        <?= Html::a(Yii::t('app', 'Atrás'), ['index'], ['class' => 'btn btn-success']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>