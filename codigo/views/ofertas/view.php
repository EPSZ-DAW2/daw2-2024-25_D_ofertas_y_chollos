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
    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->rol === 'admin'): ?>
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
    <?php endif; ?>

    <?php if ($model->patrocinador_id === null): ?>
        <?php if (!Yii::$app->user->isGuest): ?>
            <?= Html::a(Yii::t('app', 'Patrocinar'), ['ofertas/patrocinar', 'id' => $model->id], [
                'class' => 'btn btn-info',
                'data' => [
                    'confirm' => Yii::t('app', '¿Estás seguro de que quieres patrocinar esta oferta?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    <?php else: ?>
        <p><strong>Patrocinador:</strong> <?= Html::encode($model->patrocinador->nick) ?></p>
    <?php endif; ?>



        <?php if ($model->destacada == 0): ?>
            <?= Html::a(Yii::t('app', 'Destacar'), ['ofertas/destacar', 'id' => $model->id], [
                'class' => 'btn btn-info',
                'data' => [
                    'confirm' => Yii::t('app', '¿Estás seguro de que quieres destacar esta oferta?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php else: ?>
            <p><strong>     oferta  destacada.</strong></p>
        <?php endif; ?>
   
</div>

    <!-- Seguimiento -->
    <div class="follow-section">
        <?php if (!Yii::$app->user->isGuest): ?>
            <?php if ($esSeguidor): ?>
                <?= Html::a(Yii::t('app', 'Dejar de Seguir'), ['dejar-de-seguir', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
            <?php else: ?>
                <?= Html::a(Yii::t('app', 'Seguir'), ['seguir', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif; ?>
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

    <!-- Sección de Comentarios -->
    <div class="comentarios-section">
        <h2>Comentarios</h2>
    
        <?php if (Yii::$app->user->isGuest): ?>
            <p>Inicia sesión para dejar un comentario.</p>
        <?php else: ?>
            <?= Html::a('Añadir Comentario', ['comentario/create', 'oferta_id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    
        <?php foreach ($model->comentarios as $comentario): ?>
            <div class="comentario">
                <p><strong><?= Html::encode($comentario->usuario->nombre) ?></strong> (<?= Yii::$app->formatter->asDatetime($comentario->fecha_creacion) ?>)</p>
                <p><?= Html::encode($comentario->texto) ?></p>
                <?php if (!$comentario->cerrado): ?>
                    <?= Html::a('Responder', ['comentario/create', 'oferta_id' => $model->id, 'comentario_origen_id' => $comentario->id], ['class' => 'btn btn-link']) ?>
                <?php endif; ?>
                <?= Html::a('Denunciar', ['comentario/denunciar', 'id' => $comentario->id], [
                    'class' => 'btn btn-link text-danger',
                    'data' => [
                        'confirm' => '¿Estás seguro de que deseas denunciar este comentario?',
                        'method' => 'post',
                    ],
                ]) ?>
                <hr>
            </div>
        <?php endforeach; ?>
    </div>

</div>
