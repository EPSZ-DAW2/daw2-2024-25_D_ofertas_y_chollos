<?php

use app\models\Usuarios;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UsuariosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Gestión de Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Crear nuevo usuarios'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            'nick',
            'nombre',
            'apellidos',
            'fecha_registro',
            'registro_confirmado',
            'fecha_ultimo_acceso',
            'accesos_fallidos',
            'bloqueado',
            'fecha_bloqueo',
            'motivo_bloqueo',
            'rol',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('Editar', $url, ['class' => '']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Eliminar', $url, [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Vas a eliminar a este usuario ¿Estás seguro?',
                                'metho' => 'post',
                            ]
                        ]);
                    },
                ],

            ],
        ],
    ]); ?>


</div>