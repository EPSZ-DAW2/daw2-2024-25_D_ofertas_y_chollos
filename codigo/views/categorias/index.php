<?php 
use yii\helpers\Html;
use app\models\Categorias;
$this->title = Yii::t('app', 'Categorías');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class='site-index'>
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= Html::a(Yii::t('app', 'Crear Nueva Categoría'), ['create'], ['class' => 'btn btn-success']) ?>

    <div class="offers">
        <?php foreach ($categorias as $categoria): ?>
            <div class="offer">
                <h2><?= Html::a($categoria->nombre)?></h2>
                <p>Descripción: <?= Html::a($categoria->descripcion) ?></p>
                <?php if($categoria->categoria_padre_id != NULL): ?>
                    <p>Categoría padre: <?= Html::a($categoria->categoriaPadre == NULL ? '' : $categoria->categoriaPadre->nombre) ?></p>
                <?php endif ?>
                <?= Html::a('Ver Detalles', ['categorias/view', 'id'=> $categoria->id], ['class' => 'btn btn-success']) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>