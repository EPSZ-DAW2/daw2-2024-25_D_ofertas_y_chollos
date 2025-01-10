<?php

namespace app\controllers;

use Yii;
use app\models\Comentario;
use app\models\ComentarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ComentarioController implements the CRUD actions for Comentario model.
 */
class ComentarioController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['create', 'update', 'delete', 'bloquear', 'desbloquear', 'revisar-denuncias'],
                    'rules' => [
                        // Administradores
                        [
                            'allow' => true,
                            'actions' => ['bloquear', 'desbloquear', 'revisar-denuncias', 'delete', 'update'],
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                return Yii::$app->user->identity->rol === 'admin';
                            },
                        ],
                        // Usuarios autenticados
                        [
                            'allow' => true,
                            'actions' => ['create', 'view'],
                            'roles' => ['@'],
                        ],
                        // Invitados
                        [
                            'allow' => true,
                            'actions' => ['index', 'view'],
                            roles => ['?'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'bloquear' => ['POST'],
                        'desbloquear' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Comentario models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ComentarioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Bloquea un comentario
     */
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

    /**
     * Desbloquea un comentario
     */
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
     */
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
