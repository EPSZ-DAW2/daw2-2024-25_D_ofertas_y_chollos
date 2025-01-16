<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Categorias;
use app\models\Ofertas;

$this->title = 'Detalles de la Categoría';
?>

<div class="site-index">

    <h1><?= Html::encode($model->nombre)?></h1>
    <div class="body-content">
        <div class="jumbotron text-center bg-transparent">
            <h2>Descripción: <?= Html::encode($model->descripcion) ?></h2>
            <?php if($model->categoria_padre_id != NULL): ?>
                <h3>Categoría padre: <?= Html::encode($model->categoriaPadre->nombre)?></h3>
            <?php endif ?>
            <?php if(!Yii::$app->user->isGuest && (Yii::$app->user->identity->rol == 1 || Yii::$app->user->identity->rol == 2 || Yii::$app->user->identity->rol == 3)): ?>
                <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                <p id='delete'><?= Html::a(Yii::t('app', 'Borrar Categoría'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'method' => 'post', 
                    ],
                ]) ?></p>
                </div>
            <?php endif?>
            <?= Html::a(Yii::t('app', 'Atrás'), ['visor'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <h3>Ofertas relacionadas:</h3>

    <div class="offers">
        <?php if (!empty($ofertas)): ?>
            <ul>
                <?php foreach ($ofertas as $oferta): ?>
                    <div class="offer">
                        <li>
                            <h4><?= Html::encode($oferta->titulo) ?></h4><br>
                            <strong><?= Html::encode($oferta->descripcion) ?></strong><br>
                            <span style="text-decoration: line-through;">Precio original: <?= Html::encode($oferta->precio_original) ?>€</span><br>
                            <span>Precio actual: <?= Html::encode($oferta->precio_actual) ?>€</span><br>
                            <?= Html::a('Ver detalles', ['ofertas/view', 'id' => $oferta->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        </li>
                    </div>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay ofertas relacionadas con esta categoría.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('delete').addEventListener('click', function(e) {
            e.preventDefault(); // Prevenir la acción por defecto
            if (confirm('¿Estás seguro de eliminar esta categoría?')) {
                // Si se confirma, redirige manualmente al enlace
                window.location.href = this.querySelector('a').getAttribute('href');
            }
        });
    });
</script>