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
                    'class' => AccessControl::class,
                    'only' => ['index', 'view', 'create', 'update', 'delete', 'bloquear', 'desbloquear', 'denunciar'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'update', 'delete', 'bloquear', 'desbloquear'],
                            'roles' => ['admin'], // Solo administradores
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create', 'update', 'delete'],
                            'roles' => ['@'], // Usuarios autenticados pueden crear, actualizar y eliminar sus propios comentarios
                            'matchCallback' => function ($rule, $action)  {
                                if ($action->id === 'create') return true;
                                $id = Yii::$app->request->get('id');
                                $comentario = Comentario::findOne($id);
                                return $comentario && $comentario->usuario_id == Yii::$app->user->id;
                            }
                        ],
                        [
                            'allow' => true,
                            'actions' => ['denunciar'],
                            'roles' => ['@'], // Usuarios autenticados pueden denunciar comentarios
                        ], 
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
            'model' => $this->findModel($id, false),
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

        $model->oferta_id = Yii::$app->request->get('oferta_id');
        $model->comentario_origen_id = Yii::$app->request->get('comentario_origen_id');

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->usuario_id = Yii::$app->user->id;
            $model->fecha_creacion = date('Y-m-d H:i:s');

            if ($model->save()) {
                return $this->redirect(['ofertas/view', 'id' => $model->oferta_id]);
            }
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
        $model = $this->findModel($id, true);

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
        return $this->redirect(['revisar-denuncias']);
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
        return $this->redirect(['revisar-denuncias']);
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
     * Denuncia un comentario
     */
    public function actionDenunciar($id)
    {
    	$model = $this->findModel($id, false);
    	
    	// Verificar que no sea un comentario propio
    	if ($model->usuario_id === Yii::$app->user->id) {
    		Yii::$app->session->setFlash('error', 'No puedes denunciar tus propios comentarios.');
    		return $this->redirect(['ofertas/view', 'id' => $model->oferta_id]);
    	}
    	
    	// Decodificar usuarios que han denunciado
    	$denuncias = $model->motivo_denuncia ? json_decode($model->motivo_denuncia, true) : [];
    	
    	// Verificar si el usuario ya denunció
    	if (isset($denuncias[Yii::$app->user->id])) {
    		Yii::$app->session->setFlash('error', 'Ya has denunciado este comentario anteriormente.');
    		return $this->redirect(['ofertas/view', 'id' => $model->oferta_id]);
    	}
    	
    	// Registrar nueva denuncia
    	$denuncias[Yii::$app->user->id] = Yii::$app->request->post('Comentario')['motivo_denuncia'];
    	$model->motivo_denuncia = json_encode($denuncias);
    	$model->denuncias = count($denuncias);
    	
    	// Si es la primera denuncia, registrar la fecha
    	if ($model->denuncias == 1) {
    		$model->fecha_primer_denuncia = date('Y-m-d H:i:s');
    	}
    	
    	if ($model->denuncias >= Yii::$app->params['umbralDenuncias']) {
    		$model->bloqueado = 1;
    		$model->fecha_bloqueo = date('Y-m-d H:i:s');
    		$model->motivo_bloqueo = 'Exceso de denuncias';
    	}
    
    	if ($model->save(false)) {
    		Yii::$app->session->setFlash('success', 'Comentario denunciado correctamente.');
    	} else {
    		Yii::$app->session->setFlash('error', 'No se pudo denunciar el comentario.');
    	}
    
    	return $this->redirect(['ofertas/view', 'id' => $model->oferta_id]);
    }

    /**
     * Finds the Comentario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Comentario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $comprobarTitular = true)
    {
    	$model = Comentario::findOne(['id' => $id]);
    	
    	if ($model === null) {
    		throw new NotFoundHttpException('El comentario solicitado no existe.');
    	}
    	
    	// Solo verificar propiedad si se requiere
    	if ($comprobarTitular && !Yii::$app->user->can('admin')) {
    		if ($model->usuario_id !== Yii::$app->user->id) {
    			throw new ForbiddenHttpException('No tienes permiso para acceder a este comentario.');
    		}
    	}
    	
    	return $model;
    }
}
