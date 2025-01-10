<?php

namespace app\controllers;

use Yii;
use app\models\Ofertas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OfertasController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = 'Ofertas y Chollos - Ofertas';
        $ofertas = Ofertas::find()->all();

        return $this->render('index', [
            'ofertas' => $ofertas,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Ofertas();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Oferta creada con éxito.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Error al crear la oferta.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Oferta actualizada con éxito.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Error al actualizar la oferta.');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Oferta eliminada con éxito.');
        } else {
            Yii::$app->session->setFlash('error', 'Error al eliminar la oferta.');
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Ofertas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La oferta solicitada no existe.');
    }
}
