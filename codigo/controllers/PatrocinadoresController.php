<?php

namespace app\controllers;

use Yii; // Asegúrate de agregar esta línea
use app\models\Patrocinadores;
use app\models\PatrocinadoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * PatrocinadoresController implements the CRUD actions for Patrocinadores model.
 */
class PatrocinadoresController extends Controller
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Patrocinadores models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PatrocinadoresSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Patrocinadores model.
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
     * Creates a new Patrocinadores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Patrocinadores();

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
     * Updates an existing Patrocinadores model.
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
     * Deletes an existing Patrocinadores model.
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
     * Finds the Patrocinadores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Patrocinadores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Patrocinadores::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Aprobar un patrocinador
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionAprobar($id)
    {
        $model = $this->findModel($id);

        if ($model->aprobado != 0) {
            Yii::$app->session->setFlash('warning', 'El patrocinador ya está aprobado o rechazado.');
        } else {
            $model->aprobado = 1; // Estado "Aprobado"
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Patrocinador aprobado con éxito.');
            } else {
                Yii::$app->session->setFlash('error', 'Error al aprobar al patrocinador.');
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Rechazar un patrocinador
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionRechazar($id)
    {
        $model = $this->findModel($id);

        if ($model->aprobado != 0) {
            Yii::$app->session->setFlash('warning', 'El patrocinador ya está aprobado o rechazado.');
        } else {
            $model->aprobado = 2; // Estado "Rechazado"
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Patrocinador rechazado con éxito.');
            } else {
                Yii::$app->session->setFlash('error', 'Error al rechazar al patrocinador.');
            }
        }

        return $this->redirect(['index']);
    }
}
