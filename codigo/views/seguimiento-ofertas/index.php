<?php

use yii\helpers\Html;

$this->title = 'Ofertas en Seguimiento';
?>
<div class="seguimiento-etiquetas-index">



    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('info')): ?>
        <div class="alert alert-info">
            <?= Yii::$app->session->getFlash('info') ?>
        </div>
    <?php endif; ?>



    <h1><?= Html::encode($this->title) ?></h1>

    <h3>Ofertas que sigues</h3>
    <ul class="list-group">
        <?php if ($ofertasSeguidas): ?>
            <?php foreach ($ofertasSeguidas as $seguimiento): ?>
                <div class="oferta-card">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h4><?= Html::encode($seguimiento->oferta->titulo) ?></h4>
                            <p><?= Html::encode($seguimiento->oferta->descripcion) ?></p>
                            <p><strong>Precio:</strong> <?= Html::encode($seguimiento->oferta->precio_actual) ?> €</p>
                        </div>
                        <div>



                            <?= Html::a('Ver más', ['view', 'id' => $seguimiento->oferta_id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Dejar de Seguir', ['dejar-de-seguir', 'id' => $seguimiento->oferta_id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => '¿Seguro que deseas dejar de seguir esta oferta?',
                                ],
                            ]) ?>
                        </div>
                    </li>
                </div>
            <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No estás siguiendo ninguna oferta actualmente.</p>
<?php endif; ?>
</div>

<h2>Ofertas disponibles para seguir</h2>
<div class="ofertas-listado">
    <?php if ($ofertasDisponibles): ?>
        <?php foreach ($ofertasDisponibles as $oferta): ?>
            <div class="oferta-card">
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h4><?= Html::encode($oferta->titulo) ?></h4>
                        <p><?= Html::encode($oferta->descripcion) ?></p>
                        <p><strong>Precio:</strong> <?= Html::encode($oferta->precio_actual) ?> €</p>
                    </div>
                    <div>
                        <?= Html::a('Ver más', ['view', 'id' => $oferta->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Seguir', ['seguir', 'id' => $oferta->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay ofertas disponibles para seguir.</p>
    <?php endif; ?>
</div>
</div>




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
        margin-bottom: 30px;
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