<?php 
use yii\helpers\Html;
use app\models\Categorias;
?>

<div class='site-index'>
    <h1>CATEGORÍAS</h1> 

    <div class="body-content">
        <?php foreach ($categorias as $categoria): ?>
            <div class="jumbotron text-center bg-transparent">
                <h2><?= Html::a($categoria->nombre)?></h2>
                <p>Descripción: <?= Html::a($categoria->descripcion) ?></p>
                <?php if($categoria->categoria_padre_id != NULL): ?>
                    <p><?= Html::a($categoria->categoria_padre_id)?></p>
                <?php endif ?>
                <?= Html::a('Ver Detalles', ['categorias/view', 'id'=> $categoria->id], ['class' => 'botonFormulario']) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>