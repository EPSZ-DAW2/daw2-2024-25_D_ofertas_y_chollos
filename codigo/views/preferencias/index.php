<?php

use yii\helpers\Html;

$this->title = 'GESTIÓN DE PREFERENCIAS';
?>
<div class="preferencias-usuarios-index">


    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <p><?= Html::a('Volver a Mi Perfil', ['usuarios/mi-perfil'], ['class' => 'btn btn-success']) ?></p>


    <h1><?= Html::encode($this->title) ?></h1>



    <h3>Categorías que sigues</h3>
    <ul class="list-group">
        <?php if (!empty($categoriasPreferidas)): ?>
            <?php foreach ($categoriasPreferidas as $seguida): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $seguida->categoria ? Html::encode($seguida->categoria->nombre) : 'Categoría no encontrada'; ?>
                    <?= Html::a('Dejar de Seguir', ['eliminar', 'tipo' => 'categoria', 'id' => $seguida->categoria_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Estás seguro de que quieres dejar de seguir esta categoría?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No estás siguiendo ninguna categoría.</p>
        <?php endif; ?>
    </ul>

    <h3>Categorías disponibles</h3>
    <ul class="row">
        <?php foreach ($categoriasDisponibles as $categoria): ?>
            <div class="col s3">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title" style="color: black; font-weight: bold;">
                            <?= Html::encode($categoria->nombre) ?>
                        </span>
                    </div>
                    <div class="card-action">
                        <?= Html::a('Seguir', ['anadir', 'tipo' => 'categoria', 'id' => $categoria->id], [
                            'class' => 'btn btn-primary',
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </ul>


    <h3>Etiquetas que sigues</h3>
    <ul class="list-group">
        <?php if (!empty($etiquetasPreferidas)): ?>
            <?php foreach ($etiquetasPreferidas as $seguida): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $seguida->etiqueta ? Html::encode($seguida->etiqueta->nombre) : 'Etiqueta no encontrada'; ?>
                    <?= Html::a('Dejar de Seguir', ['eliminar', 'tipo' => 'etiqueta', 'id' => $seguida->etiqueta_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Estás seguro de que quieres dejar de seguir esta etiqueta?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No estás siguiendo ninguna etiqueta.</p>
        <?php endif; ?>
    </ul>




    <h3>Etiquetas disponibles</h3>
    <div class="row">
        <?php foreach ($etiquetasDisponibles as $etiqueta): ?>
            <div class="col s3">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title" style="color: black; font-weight: bold;"><?= Html::encode($etiqueta->nombre) ?></span>
                    </div>
                    <div class="card-action">
                        <?= Html::a('Seguir', ['anadir', 'tipo' => 'etiqueta', 'id' => $etiqueta->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <h3>Zonas que sigues</h3>
    <ul class="list-group">
        <?php if (!empty($zonasPreferidas)): ?>
            <?php foreach ($zonasPreferidas as $seguida): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $seguida->zona ? Html::encode($seguida->zona->nombre) : 'Zona no encontrada'; ?>
                    <?= Html::a('Dejar de Seguir', ['eliminar', 'tipo' => 'zona', 'id' => $seguida->zona_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Estás seguro de que quieres dejar de seguir esta zona?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No estás siguiendo ninguna zona.</p>
        <?php endif; ?>
    </ul>



    <h3>Zonas disponibles</h3>
    <div class="row">
        <?php foreach ($zonasDisponibles as $zona): ?>
            <div class="col s3">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title" style="color: black; font-weight: bold;"><?= Html::encode($zona->nombre) ?></span>
                    </div>
                    <div class="card-action">
                        <?= Html::a('Seguir', ['anadir', 'tipo' => 'zona', 'id' => $zona->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!----HTML--->

<style>
    .btn.btn-primary {
        background-color: #007bff;
        color: white !important;
    }

    .btn.btn-primary:hover {
        background-color: #0056b3;
        color: white !important;
    }
</style>