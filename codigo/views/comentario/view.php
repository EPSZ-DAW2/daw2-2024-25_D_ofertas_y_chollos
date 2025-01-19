<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Comentario $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comentario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['comentario/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['comentario/delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro de que deseas eliminar este comentario?',
            ],
        ]) ?>
        <?php if (!$model->bloqueado): ?>
            <?= Html::a('Bloquear', ['comentario/bloquear', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Estás seguro de que deseas bloquear este comentario?',
                ],
            ]) ?>
        <?php else: ?>
            <?= Html::a('Desbloquear', ['comentario/desbloquear', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => '¿Estás seguro de que deseas desbloquear este comentario?',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'oferta_id',
            'texto:ntext',
            'comentario_origen_id',
            'cerrado',
            'denuncias',
            'fecha_primer_denuncia',
            'motivo_denuncia:ntext',
            [
                'attribute' => 'bloqueado',
                'value' => $model->bloqueado ? 'Sí' : 'No',
            ],
            'fecha_bloqueo',
            'motivo_bloqueo:ntext',
            'usuario_id',
            'fecha_creacion',
            'fecha_modificacion',
        ],
    ]) ?>

</div>
