<?php

use yii\helpers\Html;

$this->title = 'Ofertas en Seguimiento';
?>
<div class="seguimiento-etiquetas-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <h3>Ofertas que sigues</h3>
    <ul class="list-group">
        <?php if ($ofertasSeguidas): ?>
            <?php foreach ($ofertasSeguidas as $seguimiento): ?>
                <?= $this->render('/ofertas-usuarios/ficha-resumen', ['model' => $seguimiento->oferta]) ?>
                <p>
                    <?= Html::a('Dejar de Seguir', ['dejar-de-seguir', 'id' => $seguimiento->oferta_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Seguro que deseas dejar de seguir esta oferta?',
                        ],
                    ]) ?>
                </p>
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
            <?= $this->render('/ofertas-usuarios/ficha-resumen', ['model' => $oferta]) ?>
            <p>
                <?= Html::a('Seguir', ['seguir', 'id' => $oferta->id], ['class' => 'btn btn-primary']) ?>
            </p>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay ofertas disponibles para seguir.</p>
    <?php endif; ?>
</div>
</div>