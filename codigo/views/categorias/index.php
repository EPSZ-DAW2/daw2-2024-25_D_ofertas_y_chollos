<?php 
use yii\helpers\Html;
use app\models\Categorias;
?>

<div class='site-index'>
    <h1>CATEGORÍAS</h1> 

    <div class="body-content">
        <?php foreach ($categorias as $categoria): ?>
            <h2><?= Html::a($categoria->nombre)?></h2>
            <p>Descripción: <?= Html::a($categoria->descripcion) ?></p>
            <?php if($categoria->categoria_padre_id != NULL): ?>
                <?= Html::a($categoria->categoria_padre_id)?>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
</div>
