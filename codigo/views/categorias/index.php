<?php 
use yii\helpers\Html;
use app\models\Categorias;
//Añadir botón de añadir, editar y borrar categoría
?>

<div class='site-index'>
    <h1>CATEGORÍAS</h1> 

    <div class="body-content">
        <?php // Mostramos todas las categorías que encuentra?>
        <?php foreach ($categorias as $categoria): ?>
            <h2><?= Html::a($categoria->nombre)?></h2>
            <p>Descripción: <?= Html::a($categoria->descripcion) ?></p>
            <?php if($categoria->categoria_padre_id != NULL): ?>
                <?= Html::a($categoria->categoria_padre_id)?>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
</div>
