<?php 
use yii\helpers\Html;
use app\models\Categorias;
$this->title = Yii::t('app', 'Categorías');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class='site-index'>
    <h1><?= Html::encode($this->title) ?></h1>
        
    <?php if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->rol == 1)): ?>
        <?= Html::a(Yii::t('app', 'Crear Nueva Categoría'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Lista de categorías'), ['index'], ['class' => 'btn btn-success']) ?>
    <?php endif?>

    <div class="offers">
        <?php foreach ($categorias as $categoria): ?>
            <div class="offer">
                <h2><?= Html::encode($categoria->nombre)?></h2>
                <p>Descripción: <?= Html::encode($categoria->descripcion) ?></p>
                <?php if($categoria->categoria_padre_id != NULL): ?>
                    <p>Categoría padre: <?= Html::encode($categoria->categoriaPadre == NULL ? '' : $categoria->categoriaPadre->nombre) ?></p>
                <?php endif ?>
                <?= Html::a('Ver Detalles', ['categorias/view', 'id'=> $categoria->id], ['class' => 'btn btn-success']) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>