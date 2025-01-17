<?php

namespace app\controllers;

use Yii;
use app\models\Seguimientos;
use app\models\Ofertas;
use app\models\Usuariosofertas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SeController implements the CRUD actions for oferta model.
 */
class SeguimientoOfertasController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge();
    }

    /**
     * Muestra las ofertas que sigue el usuario y las que puede seguir.
     *
     * @return string
     */
    public function actionIndex()
    {
        $usuarioId = Yii::$app->user->id;


        //consulta de las ofertas seguidas
        $ofertasSeguidas = Seguimientos::find()
            ->where(['usuario_id' => $usuarioId])
            ->with('oferta')
            ->all();


        //consulta de las que no sigue
        $seguidasIds = Seguimientos::find()
            ->select('oferta_id')
            ->where(['usuario_id' => $usuarioId])
            ->column();

        // ofertas disponibles
        $ofertasDisponibles = Ofertas::find()
            ->where(['not in', 'id', $seguidasIds])
            ->andWhere(['estado' => 'visible'])
            ->all();

        //Renderizamos la vista con las consultas realizadas
        return $this->render('index', [
            'ofertasSeguidas' => $ofertasSeguidas,
            'ofertasDisponibles' => $ofertasDisponibles
        ]);
    }

    /**
     * Accion para seguir una nueva oferta por un usuario
     * 
     */
    public function actionSeguir($id)
    {
        $usuarioId = Yii::$app->user->id;

        // Verificar si la oferta existe
        $oferta = Ofertas::findOne($id);
        if (!$oferta) {
            throw new NotFoundHttpException('La oferta no existe.');
        }


        //Verificar si el usuario sigue la oferta
        if (Seguimientos::esSeguidor($usuarioId, $id)) {
            Yii::$app->session->setFlash('info', 'Ya estás siguiendo esta oferta.');
        } else {
            //Empezamos seguimiento
            if (Seguimientos::seguir($usuarioId, $id)) {
                Yii::$app->session->setFlash('sucess', 'Has empezado a seguir esta oferta');
            } else {
                Yii::$app->session->setFlash('error', 'No se pudo seguir esta oferta');
            }
        }


        return $this->redirect(['index']);
    }

    /**
     * Accion que hace que un usuario deje de seguir una oferta
     */
    public function actionDejarDeSeguir($id)
    {
        $usuarioId = Yii::$app->user->id;



        //Eliminar el seguimiento
        if (Seguimientos::dejarDeSeguir($usuarioId, $id)) {
            Yii::$app->session->setFlash('info', 'Has dejado de seguir esta oferta.');
        } else {

            Yii::$app->session->setFlash('error', 'No estabas siguiendo esta oferta');
        }

        return $this->redirect(['index']);
    }



    /**
     * Accion para ver una oferta
     */
    public function actionView($id)
    {
        $usuarioId = Yii::$app->user->id;


        // Verificar que el usuario está siguiendo la oferta
        $seguimiento = Seguimientos::findOne(['usuario_id' => $usuarioId, 'oferta_id' => $id]);
        if (!$seguimiento) {
            throw new NotFoundHttpException('No estás siguiendo esta oferta.');
        }

        // Cargar la oferta asociada
        $oferta = $seguimiento->oferta;

        return $this->render('view', [
            'model' => $oferta,
        ]);
    }
}
