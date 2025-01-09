<?php 
use yii\helpers\Html;
use app\models\Categorias;
?>

<div class='site-index'>
    <h1>CATEGORÍAS</h1> 

    <?= Html::a('Añadir Nueva Categoría', ['categorias/create'], ['class' => 'botonFormulario']) ?>

    <div class="body-content">
        <?php foreach ($categorias as $categoria): ?>
            <div class="jumbotron text-center bg-transparent">
                <h2><?= Html::a($categoria->nombre)?></h2>
                <p>Descripción: <?= Html::a($categoria->descripcion) ?></p>
                <p><?= Html::a($categoria->categoriaPadre == NULL ? '' : $categoria->categoriaPadre->nombre) ?></p>
                <?= Html::a('Ver Detalles', ['categorias/view', 'id'=> $categoria->id], ['class' => 'botonFormulario']) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>