<?php
use yii\helpers\Html;
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
			'onclick' => 'denunciarComentario(' . $comentario->id . '); return false;'
		]) ?>
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
	
	<?php if ($comentario->respuestas): ?>
		<?php foreach ($comentario->respuestas as $respuesta): ?>
			<?= $this->render('_comentario', [
				'comentario' => $respuesta,
				'nivel' => $nivel + 1
			]) ?>
		<?php endforeach; ?>
	<?php endif; ?>
	
	<hr>
</div>

<script>
function denunciarComentario(id) {
	var motivo = prompt('Por favor, indica el motivo de la denuncia:');
	if (motivo) {
		var form = document.createElement('form');
		form.method = 'POST';
		form.action = '<?= \yii\helpers\Url::to(['comentario/denunciar']) ?>/' + id;

		var input = document.createElement('input');
		input.type = 'hidden';
		input.name = 'Comentario[motivo_denuncia]';
		input.value = motivo;

		// Añadir token CSRF
		var csrfInput = document.createElement('input');
		csrfInput.type = 'hidden';
		csrfInput.name = '<?= Yii::$app->request->csrfParam ?>';
		csrfInput.value = '<?= Yii::$app->request->csrfToken ?>';
		
		form.appendChild(csrfInput);
		form.appendChild(input);
		document.body.appendChild(form);
		form.submit();
	}
}
</script>
