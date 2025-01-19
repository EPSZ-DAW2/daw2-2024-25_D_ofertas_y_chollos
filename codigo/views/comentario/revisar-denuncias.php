<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Revisar Denuncias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-revisar-denuncias">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Volver a Comentarios', ['index'], ['class' => 'btn btn-primary']) ?>
	</p>

	<?php Pjax::begin(); ?>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'usuario.nombre',
				'label' => 'Usuario',
			],
			[
				'attribute' => 'oferta.titulo',
				'label' => 'Oferta',
				'format' => 'raw',
				'value' => function($model) {
					return Html::a(
						Html::encode($model->oferta->titulo),
						['/ofertas/view', 'id' => $model->oferta_id]
					);
				}
			],
			'texto:ntext',
			'denuncias',
			'fecha_primer_denuncia:datetime',
			[
				'attribute' => 'bloqueado',
				'value' => function($model) {
					return $model->bloqueado ? 'Sí' : 'No';
				},
				'filter' => [1 => 'Sí', 0 => 'No'],
			],

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {bloquear} {desbloquear} {delete}',
				'buttons' => [
					'view' => function($url, $model) {
						return Html::a('Ver', ['view', 'id' => $model->id], [
					            'class' => 'btn btn-info btn-sm mr-1',
					            'title' => 'Ver detalle'
					        ]);
					},
					'bloquear' => function($url, $model) {
						if (!$model->bloqueado) {
							return Html::a('Bloquear', ['bloquear', 'id' => $model->id], [
								'class' => 'btn btn-danger btn-sm',
								'data' => [
									'confirm' => '¿Estás seguro de que deseas bloquear este comentario?'
								]
							]);
						}
					},
					'desbloquear' => function($url, $model) {
						if ($model->bloqueado) {
							return Html::a('Desbloquear', ['desbloquear', 'id' => $model->id], [
								'class' => 'btn btn-success btn-sm',
								'data' => [
									'confirm' => '¿Estás seguro de que deseas desbloquear este comentario?'
								]
							]);
						}
					},
					'delete' => function($url, $model) {
						return Html::a('Eliminar', ['delete', 'id' => $model->id], [
							'class' => 'btn btn-danger btn-sm',
							'data' => [
								'confirm' => '¿Estás seguro de que deseas eliminar este comentario?'
							]
						]);
					},
				],
			],
		],
	]); ?>
	<?php Pjax::end(); ?>
</div>
