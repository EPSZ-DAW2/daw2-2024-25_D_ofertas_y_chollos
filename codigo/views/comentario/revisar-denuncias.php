<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>

<div class="comentario-revisar-denuncias">
	<h1>Revisar Comentarios Denunciados</h1>

	<?php Pjax::begin(); ?>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			'id',
			[
				'attribute' => 'texto',
				'format' => 'ntext',
				'contentOptions' => ['style' => 'max-width:300px; overflow:hidden; text-overflow:ellipsis;'],
			],
			[
				'attribute' => 'usuario.nombre',
				'label' => 'Autor',
			],
			'denuncias',
			[
				'attribute' => 'motivo_denuncia',
				'format' => 'raw',
				'label' => 'Motivos de denuncia',
				'value' => function($model) {
					$denuncias = json_decode($model->motivo_denuncia, true);
					if (!$denuncias) return '';
					
					$html = '<ul class="lista-sin-estilo">';
					foreach ($denuncias as $userId => $motivo) {
						$usuario = \app\models\Usuarios::findOne($userId);
						$nombreUsuario = $usuario ? Html::encode($usuario->nombre) : 'Usuario #' . $userId;
						$html .= '<li><strong>' . $nombreUsuario . '</strong>: ' . Html::encode($motivo) . '</li>';
					}
					$html .= '</ul>';
					return $html;
				},
				'contentOptions' => ['style' => 'max-width:300px;'],
			],
			'fecha_primer_denuncia:datetime',
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {bloquear} {eliminar}',
				'buttons' => [
					'bloquear' => function($url, $model, $key) {
						if (!$model->bloqueado) {
							return Html::a('Bloquear', ['bloquear', 'id' => $model->id], [
								'class' => 'btn btn-danger btn-sm',
								'data' => [
									'confirm' => '¿Estás seguro de que deseas bloquear este comentario?',
									'method' => 'post',
								],
							]);
						}
						return Html::a('Desbloquear', ['desbloquear', 'id' => $model->id], [
							'class' => 'btn btn-success btn-sm',
							'data' => [
								'confirm' => '¿Estás seguro de que deseas desbloquear este comentario?',
								'method' => 'post',
							],
						]);
					},
					'eliminar' => function($url, $model, $key) {
						return Html::a('Eliminar', ['delete', 'id' => $model->id], [
							'class' => 'btn btn-danger btn-sm',
							'data' => [
								'confirm' => '¿Estás seguro de que deseas eliminar este comentario?',
								'method' => 'post',
							],
						]);
					},
				],
			],
		],
	]); ?>
	<?php Pjax::end(); ?>
</div>

<?php
$this->registerCss("
	.lista-sin-estilo {
		margin: 0;
		padding: 0;
		list-style: none;
	}
	.lista-sin-estilo li {
		margin-bottom: 5px;
		padding: 5px;
		background: #f8f9fa;
		border-radius: 3px;
	}
");
?>
