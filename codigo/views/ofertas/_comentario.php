<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="comentario" style="margin-left: <?= $nivel * 20 ?>px; border-left: <?= $nivel > 0 ? '2px solid #ccc' : 'none' ?>; padding-left: 10px;">
    <p><strong><?= Html::encode($comentario->usuario->nombre) ?></strong> (<?= Yii::$app->formatter->asDatetime($comentario->fecha_creacion) ?>)</p>
    <p><?= Html::encode($comentario->texto) ?></p>
    <?php if (!$comentario->cerrado): ?>
        <?= Html::a('Responder', ['comentario/create', 'oferta_id' => $comentario->oferta_id, 'comentario_origen_id' => $comentario->id], ['class' => 'btn btn-link']) ?>
    <?php endif; ?>
    <?php if (!$comentario->cerrado && Yii::$app->user->id !== $comentario->usuario_id): ?>
        <?= Html::a('Denunciar', '#', [
            'class' => 'btn btn-link text-danger',
            'data-toggle' => 'modal',
            'data-target' => "#modalDenuncia{$comentario->id}"
        ]) ?>

        <!-- Modal de Denuncia -->
        <div class="modal fade" id="modalDenuncia<?= $comentario->id ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Denunciar Comentario</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <?php $form = ActiveForm::begin([
                        'action' => ['comentario/denunciar', 'id' => $comentario->id]
                    ]); ?>
                    <div class="modal-body">
                        <?= $form->field($comentario, 'motivo_denuncia')->textarea([
                            'rows' => 4,
                            'placeholder' => 'Describe el motivo de la denuncia'
                        ])->label('Motivo de la denuncia') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <?= Html::submitButton('Denunciar', ['class' => 'btn btn-danger']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->user->can('admin')): ?>
        <?php if (!$comentario->bloqueado): ?>
            <?= Html::a('Bloquear', ['comentario/bloquear', 'id' => $comentario->id], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => '¿Estás seguro de que deseas bloquear este comentario?',
                ],
            ]) ?>
        <?php else: ?>
            <?= Html::a('Desbloquear', ['comentario/desbloquear', 'id' => $comentario->id], [
                'class' => 'btn btn-success btn-sm',
                'data' => [
                    'confirm' => '¿Estás seguro de que deseas desbloquear este comentario?',
                ],
            ]) ?>
        <?php endif; ?>
    <?php endif; ?>
    <hr>

    <?php if (!empty($comentario->respuestas)): ?>
        <?php foreach ($comentario->respuestas as $respuesta): ?>
            <?= $this->render('_comentario', [
                'comentario' => $respuesta,
                'nivel' => $nivel + 1
            ]) ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
