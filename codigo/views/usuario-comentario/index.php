<?php

use app\models\Comentario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\ComentarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'MIS COMENTARIOS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-index">


    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('info')): ?>
        <div class="alert alert-info">
            <?= Yii::$app->session->getFlash('info') ?>
        </div>
    <?php endif; ?>


    <p><?= Html::a('Volver a Mi Perfil', ['usuarios/mi-perfil'], ['class' => 'btn btn-success']) ?></p>


    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($comentarios)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Comentario</th>
                    <th>Oferta</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comentarios as $comentario): ?>
                    <tr>
                        <td><?= Html::encode($comentario->texto) ?></td>
                        <td>
                            <?= $comentario->oferta
                                ? Html::a(
                                    Html::encode($comentario->oferta->titulo),
                                    ['ofertas/view', 'id' => $comentario->oferta->id]
                                )
                                : 'Oferta no encontrada';
                            ?>
                        </td>
                        <td><?= Html::encode($comentario->fecha_creacion) ?></td>
                        <td>
                            <?= Html::a('Editar', ['update', 'id' => $comentario->id], ['class' => 'btn btn-primary btn-sm']) ?>
                            <?= Html::a('Eliminar', ['delete', 'id' => $comentario->id], [
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => '¿Estás seguro de que quieres eliminar este comentario?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No has realizado ningún comentario todavía.</p>
    <?php endif; ?>
</div>