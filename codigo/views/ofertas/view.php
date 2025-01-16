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
?>
<div class="ofertas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Botones de acción -->
    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de que desea borrar esta oferta?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <!-- Botones de Bloquear y Desbloquear -->
    <p>
        <?= Html::a(Yii::t('app', 'Bloquear'), ['bloquear', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', 'Desbloquear'), ['desbloquear', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <!-- Seguimiento -->
    <p>
        <?php if ($esSeguidor): ?>
            <?= Html::a(Yii::t('app', 'Dejar de Seguir'), ['dejar-de-seguir', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?php else: ?>
            <?= Html::a(Yii::t('app', 'Seguir'), ['seguir', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
    </p>

    <p>
        <strong>Total de seguidores:</strong> <?= $model->getSeguidores()->count() ?>
    </p>

    <!-- Detalles de la oferta -->
    <?= DetailView::widget([
        'model' => $model,
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

            // Mostrar la categoría, zona, proveedor y comentarios
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
            [
                'label' => 'Comentarios',
                'value' => function ($model) {
                    return implode(', ', array_map(function ($comentario) {
                        return $comentario->texto;
                    }, $model->comentarios));
                },
            ],

            // El resto de atributos
            'anuncio_destacado',
            'estado',
            'denuncias',
            'fecha_primer_denuncia',
            'motivo_denuncia:ntext',
            'fecha_bloqueo',
            'motivo_bloqueo:ntext',
            'cerrado_comentar',
            'usuario_creador_id',
            'fecha_creacion',
            'usuario_modificador_id',
            'fecha_modificacion',
        ],
    ]) ?>

</div>
