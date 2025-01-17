<?php

use app\models\Usuarios;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\bootstrap5\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\UsuariosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Gestión de Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>


    <p>

        <?= Html::a(Yii::t('app', 'Crear nuevo usuarios'), ['create'],    [
            'class' => 'btn btn-success'
        ]) ?>
    </p>


    <?php
    $dataProvider->pagination->pageSize = 15;
    $dataProvider->pagination->pageParam = 'p';
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => LinkPager::class,
            'maxButtonCount' => 5,
            'options' => ['class' => 'pagination'],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            'nick',
            'nombre',
            'apellidos',
            'fecha_registro',
            [
                'attribute' => 'registro_confirmado',
                'format' => 'html',
                'value' => 'registroConfirmadoVista',
                'label' => Yii::t('app', 'Confirmado'),
            ],
            'fecha_ultimo_acceso',
            'accesos_fallidos',
            [
                'attribute' => 'bloqueado',
                'format' => 'html',
                'value' => 'estadoBloqueoVista',
                'label' => Yii::t('app', 'Bloqueado'),
            ],
            'fecha_bloqueo',
            'motivo_bloqueo',

            [
                'attribute' => 'rol',
                'format' => 'html',
                'value' => 'nombreRol',

                'label' => Yii::t('app', 'Rol'),
            ],

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
                                'method' => 'post',
                            ]
                        ]);
                    },
                ],

            ],
        ],
    ]); ?>


</div>