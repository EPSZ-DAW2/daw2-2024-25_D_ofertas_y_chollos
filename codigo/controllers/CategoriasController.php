<?php

namespace app\controllers;

use Yii;
use app\models\Categorias;
use app\models\Ofertas;
use app\models\CategoriasSearch;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CategoriasController extends \yii\web\Controller
{
    /**
     * Lists all Anuncio models.
     *
     * @return string
     */
    public function actionIndex()
    {

        //obtener el registro aleatorio
        $randomCategoria = $this->getRandomCategoria();

        $searchModel = new CategoriasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'randomCategoria' => $randomCategoria,
        ]);
    }

    protected function getRandomCategoria()
    {
        return Categorias::getCategoriaAleatoria();
    }

    public function actionVisor()
    {
        $this->view->title = 'Ofertas y Chollos - Categorías';

        $searchModel = new CategoriasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // Mostramos todas las categorías
        $models= Categorias::find()->all();

        return $this->render('visor', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'models'=>$models,
        ]);
    }

    // Action in PartidosController.php
    public function actionView($id, $categoriaID = null)
    {
        $model = $this->findModel($id);

        // Verificar si el modelo existe
        if ($model === null) {
            throw new NotFoundHttpException('La categoría no fue encontrada.');
        }

        // Consultar las ofertas relacionadas con la categoría, limitando a 3 resultados
        $query = Ofertas::find()->where(['categoria_id' => $id])->limit(3);
        $ofertas = $query->all();

        // Renderizar la vista de detalles de la categoría
        return $this->render('view', [
            'model' => $model,
            'categoriaID' => $id, // Pasar el ID de la categoría a la vista
            'ofertas' => $ofertas,
        ]);
    }

 
    protected function findModel($id)
    {
        if (($model = Categorias::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El partido solicitado no existe.');
        }
    }

    public function actionCreate()
    {
        /*if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }*/

        $model = new Categorias();

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());

            if ($model->save()) {
                return $this->redirect(['categorias/index']);
            } else {
                print_r($model->errors);
                // Muestra los errores de validación del modelo Equipos
                Yii::$app->session->setFlash('error', 'Error al guardar la categoría.');

                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    // Acción para borrar un partido
    public function actionDelete($id)
    {
        /*if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }*/

        $categoria = Categorias::findOne($id);

        if ($categoria === null) {
            throw new NotFoundHttpException('El partido no fue encontrado.');
        }

        $categoria->delete();

        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        /*if (Yii::$app->user->isGuest ||(Yii::$app->user->identity->id_rol != 1 && Yii::$app->user->identity->id_rol != 2 && Yii::$app->user->identity->id_rol != 4))
        {
            // Usuario no autenticado o no tiene el rol adecuado
            Yii::$app->session->setFlash('error', 'No tienes permisos para realizar esta acción.');
            return $this->redirect(['index']);
        }*/

        // Buscar el partido por su ID
        $model = Categorias::findOne($id);

        // Verificar si el partido existe
        if ($model === null) {
            throw new NotFoundHttpException('La categoría no fue encontrada.');
        }

        // Procesar el formulario cuando se envía
        if (Yii::$app->request->isPost) {
            // Cargar los datos del formulario en el modelo de jornada
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                // Redirigir a la vista de detalles después de la actualización exitosa
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        // Renderizar la vista de actualización con el formulario y el modelo de jornada
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSearch($keyword = null)
    {
        $query = Categorias::find()
            ->where(['like', 'nombre', $keyword])
            ->orWhere(['like', 'descripcion', $keyword])
            ->andWhere(['revisado' => 1]);

        $models = $query->all();

        return $this->render('visor', [
            'models' => $models,
            'keyword' => $keyword,
        ]);
    }
}
?>