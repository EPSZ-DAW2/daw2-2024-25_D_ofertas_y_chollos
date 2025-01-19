<?php

/** @var yii\web\View $this */
/** @var app\models\Ofertas[] $models */
/** @var string $titulo */
/** @var string $zona_id */
/** @var string $precio_max */
/** @var string $fecha_inicio */
/** @var string $mensaje */

use yii\helpers\Html;

$this->title = 'Resultados de búsqueda avanzada';
?>
<div class="ofertas-advanced-search">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($mensaje)): ?>
        <p class="alert alert-warning"><?= Html::encode($mensaje) ?></p>
    <?php else: ?>
        <p>Filtros aplicados:</p>
        <ul>
            <li><strong>Título:</strong> <?= Html::encode($titulo) ?></li>
            <li><strong>Zona:</strong> <?= Html::encode($zona) ?></li>
            <li><strong>Precio Máximo:</strong> <?= Html::encode($precio_max) ?></li>
            <li><strong>Fecha de Inicio:</strong> <?= Html::encode($fecha_inicio) ?></li>
        </ul>
    <?php endif; ?>

    <div class="resultados-busqueda">
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $model): ?>
                <?= $this->render('_ficha_resumen', ['model' => $model]) ?>
            <?php endforeach; ?>
        <?php elseif (empty($mensaje)): ?>
            <p>No se encontraron resultados.</p>
        <?php endif; ?>
    </div>

</div>
