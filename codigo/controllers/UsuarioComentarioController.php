<?php

namespace app\controllers;

use Yii;
use app\models\Comentario;
use app\models\Ofertas;
use app\models\ComentarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use function PHPUnit\Framework\throwException;

/**
 * ComentarioController implements the CRUD actions for Comentario model.
 */
class UsuarioComentarioController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST', 'GET'],
                    ],
                ],

                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [

                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'view',
                                'create',
                                'update',
                                'delete'
                            ],
                            'roles' => ['permisosBasicos'], // Solo pueden administradores
                        ],
                        [
                            'allow' => false, //negar acceso por defecto
                        ],

                    ],
                ],
            ]
        );
    }

    /**
     * Muestra comentarios del usuario .
     *
     * @return string
     */
    public function actionIndex()
    {
        $usuarioId = Yii::$app->user->id;

        $comentarios = Comentario::find()
            ->where(['usuario_id' => $usuarioId])
            //Relacion entre el usuario y la oferta
            ->with('oferta')
            ->all();

        return $this->render('index', [
            'comentarios' => $comentarios,
        ]);
    }

    /**
     * Displays a single Comentario model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comentario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Comentario();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comentario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //Si no pertenece al usuario se lanza la excepcion
        if ($model->usuario_id !== Yii::$app->user->id) {
            throw new NotFoundHttpException('No tienes permisos para modificar este comentario');
        }


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Comentario actualizado correctamente');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comentario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        //Si no pertenece al usuario se lanza la excepcion
        if ($model->usuario_id !== Yii::$app->user->id) {
            throw new NotFoundHttpException('No tienes permisos para modificar este comentario');
        }


        $model->delete();
        Yii::$app->session->setFlash('success', 'Comentario borrado correctamente');
        return $this->redirect(['index']);
    }

    /**
     * Bloquea un comentario
     *//*
    public function actionBloquear($id)
    {
        $model = $this->findModel($id);
        if ($model->bloqueado == 0) {
            $model->bloqueado = 1;
            $model->fecha_bloqueo = date('Y-m-d H:i:s');
            $model->motivo_bloqueo = 'Bloqueado por el Administrador';
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Comentario bloqueado correctamente.');
            }
        } else {
            Yii::$app->session->setFlash('info', 'El comentario ya está bloqueado.');
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }
*/
    /**
     * Desbloquea un comentario
     *//*
    public function actionDesbloquear($id)
    {
        $model = $this->findModel($id);
        if ($model->bloqueado == 1) {
            $model->bloqueado = 0;
            $model->fecha_bloqueo = null;
            $model->motivo_bloqueo = null;
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Comentario desbloqueado correctamente.');
            }
        } else {
            Yii::$app->session->setFlash('info', 'El comentario no está bloqueado.');
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Revisa los comentarios denunciados
     *//*
    public function actionRevisarDenuncias()
    {
        $searchModel = new ComentarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['>', 'denuncias', 0]);

        return $this->render('revisar-denuncias', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Comentario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Comentario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comentario::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El comentario solicitado no existe.');
    }
}
