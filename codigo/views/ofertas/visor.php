<?php
/** @var yii\web\View $this */
/** @var app\models\Ofertas[] $recientes */
/** @var app\models\Ofertas[] $destacados */
/** @var app\models\Ofertas[] $patrocinados */
/** @var app\models\Ofertas[] $personalizados */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Visor de Ofertas';
?>

<div class="ofertas-visor">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Filtros (Opcional) -->
    <div class="filtros">
        <a href="<?= yii\helpers\Url::to(['ofertas/visor', 'filter' => 'recientes']) ?>">Recientes</a>
        | <a href="<?= yii\helpers\Url::to(['ofertas/visor', 'filter' => 'destacadas']) ?>">Destacadas</a>
        | <a href="<?= yii\helpers\Url::to(['ofertas/visor', 'filter' => 'patrocinadas']) ?>">Patrocinadas</a>
        | <a href="<?= yii\helpers\Url::to(['ofertas/visor', 'filter' => 'personalizadas']) ?>">Personalizadas</a>
    </div>

    <!-- Sección: Recientes -->
    <h2>Ofertas Recientes</h2>
    <ul>
        <?php foreach ($recientes as $oferta): ?>
            <li>
                <?= Html::a(Html::encode($oferta->titulo), ['view', 'id' => $oferta->id]) ?>
                - <?= Html::encode($oferta->descripcion) ?>
                - <small>Publicado el: <?= Yii::$app->formatter->asDate($oferta->fecha_creacion) ?></small>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Paginación -->
    <?= LinkPager::widget([
        'pagination' => $paginationRecientes, // Asegúrate de que esto esté configurado en el controlador
    ]) ?>

    <!-- Sección: Destacados -->
    <h2>Ofertas Destacadas</h2>
    <ul>
        <?php foreach ($destacados as $oferta): ?>
            <li>
                <?= Html::a(Html::encode($oferta->titulo), ['view', 'id' => $oferta->id]) ?>
                - <?= Html::encode($oferta->descripcion) ?>
                - <small>Publicado el: <?= Yii::$app->formatter->asDate($oferta->fecha_inicio) ?></small>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Paginación -->
    <?= LinkPager::widget([
        'pagination' => $paginationDestacados,
    ]) ?>

    <!-- Sección: Patrocinados -->
    <h2>Ofertas Patrocinadas</h2>
    <ul>
        <?php foreach ($patrocinados as $oferta): ?>
            <li>
                <?= Html::a(Html::encode($oferta->titulo), ['view', 'id' => $oferta->id]) ?>
                - <?= Html::encode($oferta->descripcion) ?>
                - <small>Publicado el: <?= Yii::$app->formatter->asDate($oferta->fecha_inicio) ?></small>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Paginación -->
    <?= LinkPager::widget([
        'pagination' => $paginationPatrocinados,
    ]) ?>

    <!-- Sección: Personalizados -->
    <h2>Ofertas Personalizadas</h2>
    <ul>
        <?php foreach ($personalizados as $oferta): ?>
            <li>
                <?= Html::a(Html::encode($oferta->titulo), ['view', 'id' => $oferta->id]) ?>
                - <?= Html::encode($oferta->descripcion) ?>
                - <small>Publicado el: <?= Yii::$app->formatter->asDate($oferta->fecha_inicio) ?></small>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Paginación -->
    <?= LinkPager::widget([
        'pagination' => $paginationPersonalizados,
    ]) ?>
</div>
