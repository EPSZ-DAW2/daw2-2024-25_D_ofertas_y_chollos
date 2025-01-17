<?php 
use yii\helpers\Html;
use app\models\Categorias;
$this->title = Yii::t('app', 'Categorías');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class='site-index'>
    <h1><?= Html::encode($this->title) ?></h1>
        
    <?php if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->rol == 1 || Yii::$app->user->identity->rol == 2 || Yii::$app->user->identity->rol == 3)): ?>
        <?= Html::a(Yii::t('app', 'Crear Nueva Categoría'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Lista de categorías'), ['index'], ['class' => 'btn btn-success']) ?>
    <?php endif?>

    <!-- CONTENEDOR FLEX PARA LOS BUSCADORES -->
    <div class="search-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <!-- BUSCADOR DE PALABRAS CLAVE -->
        <div class="search-bar" style="flex: 1; margin-right: 20px;">
            <?= Html::beginForm(['categorias/search'], 'get', ['class' => 'form-inline']) ?>
            <div class="form-group">
                <?= Html::textInput('keyword', Yii::$app->request->get('keyword'), [
                    'class' => 'form-control',
                    'placeholder' => 'Buscar categorías...',
                    'style' => 'width: 300px; margin-right: 10px;'
                ]) ?>
            </div>
            <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
            <?= Html::endForm() ?>
        </div>
    </div>

    <div class="offers">
        <?php foreach ($models as $categoria): ?>
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