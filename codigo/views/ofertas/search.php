<?php

/** @var yii\web\View $this */
/** @var app\models\Ofertas[] $models */
/** @var string $keyword */

use yii\helpers\Html;

$this->title = 'Resultados de búsqueda';
?>
<div class="ofertas-search">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Resultados para: <strong><?= Html::encode($keyword) ?></strong></p>

    <div class="resultados-busqueda">
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $model): ?>
                <?= $this->render('_ficha_resumen', ['model' => $model]) ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron resultados.</p>
        <?php endif; ?>
    </div>

</div>
