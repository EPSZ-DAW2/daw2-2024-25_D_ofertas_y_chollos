<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Categorias;

$this->title = 'Detalles de la Categoría';
?>

<div class="categorias-index">

    <h1><?= Html::a($model->nombre)?></h1>
    <div class="body-content">
        <div class="jumbotron text-center bg-transparent">
            <h2>Descripción: <?= Html::a($model->descripcion) ?></h2>
            <?php if($model->categoria_padre_id != NULL): ?>
                <h3>Categoría padre: <?= Html::a($model->categoriaPadre->nombre)?></h3>
            <?php endif ?>
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <p id='delete'><?= Html::a(Yii::t('app', 'Borrar Categoría'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'method' => 'post', // Elimina 'confirm' aquí si usas el JS personalizado
                ],
            ]) ?></p>
            </div>
        <?= Html::a(Yii::t('app', 'Atrás'), ['index'], ['class' => 'btn btn-success']) ?>
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