<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Categorias;

$this->title = 'Detalles de la Categoría';
?>

<div class="site-index">

    <h1><?= Html::a($model->nombre)?></h1>
    <div class="body-content">
        <?php if($model->categoria_padre_id != NULL): ?>
            <?= Html::a($model->categoriaPadre->nombre)?>
        <?php endif ?>
        <p>Descripción: <?= Html::a($model->descripcion) ?></p>
        <button><?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'botonFormulario']) ?></button>
        </br>
        <button id="delete"><?= Html::a(Yii::t('app', 'Borrar Categoría'), ['delete', 'id' => $model->id], [
            'class' => 'botonFormulario',
            'data' => [
                'method' => 'post', // Elimina 'confirm' aquí si usas el JS personalizado
            ],
        ]) ?></button>
        </br>
        <button><?= Html::a(Yii::t('app', 'Atrás'), ['index'], ['class' => 'botonFormulario']) ?></button>
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