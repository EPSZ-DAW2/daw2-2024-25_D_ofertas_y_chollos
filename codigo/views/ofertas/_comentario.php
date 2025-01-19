<?php

use yii\helpers\Html;

?>

<div class="comentario" style="margin-left: <?= $nivel * 20 ?>px; border-left: <?= $nivel > 0 ? '2px solid #ccc' : 'none' ?>; padding-left: 10px;">
    <p><strong><?= Html::encode($comentario->usuario->nombre) ?></strong> (<?= Yii::$app->formatter->asDatetime($comentario->fecha_creacion) ?>)</p>
    <p><?= Html::encode($comentario->texto) ?></p>
    <?php if (!$comentario->cerrado): ?>
        <?= Html::a('Responder', ['comentario/create', 'oferta_id' => $comentario->oferta_id, 'comentario_origen_id' => $comentario->id], ['class' => 'btn btn-link']) ?>
    <?php endif; ?>
    <?= Html::a('Denunciar', ['comentario/denunciar', 'id' => $comentario->id], [
        'class' => 'btn btn-link text-danger',
        'data' => [
            'confirm' => '¿Estás seguro de que deseas denunciar este comentario?',
            'method' => 'post',
        ],
    ]) ?>
    <?php if (Yii::$app->user->can('admin')): ?>
        <?php if (!$comentario->bloqueado): ?>
            <?= Html::a('Bloquear', ['bloquear', 'id' => $comentario->id], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => '¿Estás seguro de que deseas bloquear este comentario?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php else: ?>
            <?= Html::a('Desbloquear', ['desbloquear', 'id' => $comentario->id], [
                'class' => 'btn btn-success btn-sm',
                'data' => [
                    'confirm' => '¿Estás seguro de que deseas desbloquear este comentario?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    <?php endif; ?>
    <hr>

    <?php foreach ($comentario->comentarios as $respuesta): ?>
        <?= $this->render('_comentario', ['comentario' => $respuesta, 'nivel' => $nivel + 1]) ?>
    <?php endforeach; ?>
</div>
