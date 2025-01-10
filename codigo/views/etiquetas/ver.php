<?php
use yii\helpers\Html;

/** @var app\models\Etiqueta $etiqueta */
/** @var array $ofertas */

$this->title = Html::encode($etiqueta->nombre);
$this->params['breadcrumbs'][] = ['label' => 'Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="etiqueta-ver">
    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Ofertas relacionadas con "<?= Html::encode($etiqueta->nombre) ?>"</h2>
    <ul>
        <?php foreach ($ofertas as $oferta): ?>
            <li>
                <strong><?= Html::encode($oferta['titulo']) ?></strong><br>
                <?= Html::encode($oferta['descripcion']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
