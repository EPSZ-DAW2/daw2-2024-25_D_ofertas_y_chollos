<?php

namespace app\controllers;

use app\models\Anuncio;
use app\models\AnunciosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnunciosController implements the CRUD actions for Anuncio model.
 */
class AnunciosController extends Controller
{
    /**
     * @inheritDoc
     */
/*public function behaviors()
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
    }*/


    public function behaviors()
{
    return array_merge(
        parent::behaviors(),
        [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['create', 'update', 'delete'], // Acciones restringidas
                'rules' => [
                    [
                        'allow' => true,
                        'actions'=>['create','update','delete'],
                        'roles'=>['admin'],
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['busqueda'],
                        'roles'=>['invitado'],
                    ]
                ],
            ],
        ]
    );
}



    /*

    * Funcion para obtener un registro aleatorio

    */

    protected function getRandomAnuncio()
    {
        return Anuncio::getAnuncioAleatorio();
    }



    /**
     * Lists all Anuncio models.
     *
     * @return string
     */
    public function actionIndex()
    {

        //obtener el registro aleatorio
        $randomAnuncio = $this->getRandomAnuncio();

        $searchModel = new AnunciosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'randomAnuncio' => $randomAnuncio,
        ]);
    }
    


    

    /**
     * Displays a single Anuncio model.
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
     * Creates a new Anuncio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Anuncio();

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
     * Updates an existing Anuncio model.
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
     * Deletes an existing Anuncio model.
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
     * Finds the Anuncio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Anuncio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Anuncio::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionVisor()
{
    // Consulta para obtener todos los anuncios activos
    $query = Anuncio::find()->orderBy(['fecha' => SORT_DESC]);

    // Paginación
    $pagination = new \yii\data\Pagination([
        'defaultPageSize' => 10,
        'totalCount' => $query->count(),
    ]);

    // Anuncios con límite y desplazamiento para la página actual
    $anuncios = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

    // Renderiza la vista pasando los datos
    return $this->render('visor', [
        'anuncios' => $anuncios,
        'pagination' => $pagination,
    ]);
}

}
