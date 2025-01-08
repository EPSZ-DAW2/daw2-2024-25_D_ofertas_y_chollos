<?php

namespace app\controllers;

use Yii;
use app\models\Categorias;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CategoriasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->view->title = 'Ofertas y Chollos - Categorías';

        // Mostramos todas las categorías
        $categorias= Categorias::find()->all();

        return $this->render('index', [
            'categorias'=>$categorias,
        ]);
    }

    // Action in PartidosController.php
    public function actionView($id, $categoriaID = null)
    {
        $model = $this->findModel($id);

        // Verificar si el equipo existe
        if ($model === null) {
            throw new NotFoundHttpException('La categoría no fue encontrada.');
        }

        // Renderizar la vista de detalles del partido
        return $this->render('view', [
            'model' => $model,
            'categoriaID' => $id, // Pasar el ID del partido a la vista
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
}
?>