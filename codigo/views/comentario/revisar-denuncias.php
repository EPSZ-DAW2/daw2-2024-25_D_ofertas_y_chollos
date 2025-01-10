<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComentarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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

			'id',
			'oferta_id',
			'texto:ntext',
			'denuncias',
			'motivo_denuncia:ntext',
			'fecha_primer_denuncia',

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
						return '';
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
