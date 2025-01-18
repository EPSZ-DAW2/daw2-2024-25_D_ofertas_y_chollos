<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Nuevas ofertas de tu preferencia';
?>
<div class="preferencias-usuarios-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($ofertas)): ?>
        <?php foreach ($ofertas as $oferta): ?>
            <div class="list-group-item">
                <div class="oferta-card">
                    <h4 class="list-group-item-heading"><?= Html::encode($oferta->titulo) ?></h4>
                    <p class="list-group-item-text"><?= Html::encode($oferta->descripcion) ?></p>
                    <p><strong>Precio:</strong> <?= Html::encode($oferta->precio_actual) ?> €</p>
                    <p><strong>Creada el:</strong> <?= Html::encode(Yii::$app->formatter->asDatetime($oferta->fecha_creacion)) ?></p>


                    <div>
                        <?= Html::a('Ver más', ['alertas-ofertas/view', 'id' => $oferta->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron ofertas relevantes según tus preferencias.</p>
        <?php endif; ?>
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


    .ofertas-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .oferta-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .oferta-title {
        font-size: 1.25em;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .oferta-description {
        margin-bottom: 10px;
        color: #555;
    }

    .oferta-actions {
        margin-top: 10px;
    }

    .btn.btn-primary {
        background-color: #007bff;
        color: white !important;
    }

    .btn.btn-primary:hover {
        background-color: #0056b3;
        color: white !important;
    }
</style>