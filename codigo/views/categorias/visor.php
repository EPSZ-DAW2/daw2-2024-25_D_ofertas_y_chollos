<?php 
use yii\helpers\Html;
use app\models\Categorias;
$this->title = Yii::t('app', 'Categorías');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/themes/material-default/css/visor.css');
?>


<div class='visor-container'>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <?php if(!Yii::$app->user->isGuest): ?>
            <p><?= Html::a(Yii::t('app', 'Proponer Nueva Categoría'), ['create'], ['class' => 'btn btn-success']) ?></p>
        <?php endif?>
        <?php if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->rol == 1 || Yii::$app->user->identity->rol == 2 || Yii::$app->user->identity->rol == 3)): ?>
            <p><?= Html::a(Yii::t('app', 'Lista de categorías'), ['index'], ['class' => 'btn btn-success']) ?></p>
        <?php endif?>
    </div>

    <h1 class="visor-title">Visor de <?= Html::encode($this->title) ?></h1>

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

    <div class="section">
    <h2 class="section-title">Categorías disponibles</h2>
        <div class="ofertas-list">
            <?php foreach ($models as $categoria): ?>
                <div class="oferta-card">
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
</div>