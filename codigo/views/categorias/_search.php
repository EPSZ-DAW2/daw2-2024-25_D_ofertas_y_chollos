<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CategoriasSearch;

/** @var yii\web\View $this */
/** @var app\models\CategoriasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="categorias-search">

    <?php 
    if (!$model instanceof \app\models\CategoriasSearch) {
        throw new \yii\base\InvalidConfigException('El modelo no es una instancia válida de CategoriasSearch');
    }
    ?>

    <?php $form = ActiveForm::begin([
        'action' => ['visor'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>
    <?= $form->field($model, 'nombre') ?>
    <?= $form->field($model, 'descripcion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Buscar'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reiniciar'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>