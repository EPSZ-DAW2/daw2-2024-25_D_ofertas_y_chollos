<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Ofertas $model */
/** @var bool $esSeguidor */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ofertas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->registerCssFile('@web/themes/material-default/css/oferta-view.css');
?>
<div class="ofertas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Botones de acción -->
    <div class="action-buttons">
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de que desea borrar esta oferta?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Bloquear'), ['bloquear', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', 'Desbloquear'), ['desbloquear', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

        <?php if (!Yii::$app->user->isGuest): ?>
    <?php if ($model->patrocinador_id === null): ?>
        <?= Html::a('Patrocinar esta Oferta', ['ofertas/patrocinar', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => '¿Estás seguro de que quieres patrocinar esta oferta?',
                'method' => 'post',
            ],
        ]) ?>
    <?php else: ?>
        <p>Esta oferta ya está patrocinada por <?= Html::encode($model->patrocinador->nick) ?></p>
    <?php endif; ?>
<?php endif; ?>

    </div>

    <!-- Seguimiento -->
    <div class="follow-section">
        <?php if ($esSeguidor): ?>
            <?= Html::a(Yii::t('app', 'Dejar de Seguir'), ['dejar-de-seguir', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?php else: ?>
            <?= Html::a(Yii::t('app', 'Seguir'), ['seguir', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <p><strong>Total de seguidores:</strong> <?= $model->getSeguidores()->count() ?></p>
    </div>

    <!-- Detalles de la oferta -->
    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-bordered detail-view'],
        'attributes' => [
            'id',
            'titulo',
            'descripcion:ntext',
            'url_externa:url',
            'fecha_inicio',
            'fecha_fin',
            'precio_actual',
            'precio_original',
            'descuento',
            [
                'label' => 'Categoría',
                'value' => $model->categoria ? $model->categoria->nombre : 'Sin categoría',
            ],
            [
                'label' => 'Zona',
                'value' => $model->zona ? $model->zona->nombre : 'Sin zona',
            ],
            [
                'label' => 'Proveedor',
                'value' => $model->proveedor ? $model->proveedor->razon_social : 'Sin proveedor',
            ],
        ],
    ]) ?>

</div>
