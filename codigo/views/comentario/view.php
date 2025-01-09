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
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
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
            'bloqueado',
            'fecha_bloqueo',
            'motivo_bloqueo:ntext',
            'usuario_id',
            'fecha_creacion',
            'fecha_modificacion',
        ],
    ]) ?>

</div>
