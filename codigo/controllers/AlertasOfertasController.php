<?php

namespace app\controllers;

use Yii;
use app\models\Ofertas;
use app\models\UsuariosEtiquetas;
use app\models\UsuariosCategorias;
use app\models\OfertaEtiqueta;
use app\models\UsuariosZonas;
use app\models\Zonas;
use yii\web\Controller;
use yii\filters\AccessControl;


/**
 * Controlador de alertas de nuevas ofertas al usuario
 */
class AlertasOfertasController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [

                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [

                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'view',

                            ],
                            'roles' => ['permisosBasicos'], // Para usuarios con permisos
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
     * Muestra las ofertas nuevas según sus preferencias.
     *
     * @return string
     */
    public function actionIndex()
    {
        $usuarioId = Yii::$app->user->id;
        //Almacenar ultimo acceso del usuario
        $fechaUltimoAccesoAnterior = Yii::$app->session->get('fechaUltimoAccesoAnterior', '2000-01-01 00:00:00');


        //consultar las ofertas creadas despues del ultimo acceso que coincidan con preferencias del usuario
        $ofertas = Ofertas::find()
            ->where(['>', 'fecha_creacion', $fechaUltimoAccesoAnterior])
            ->andWhere(['estado' => 'visible'])
            ->andFilterWhere(['in', 'categoria_id', UsuariosCategorias::find()->select('categoria_id')->where(['usuario_id' => $usuarioId])])
            ->andFilterWhere(['in', 'zona_id', UsuariosZonas::find()->select('zona_id')->where(['usuario_id' => $usuarioId])])
            ->andFilterWhere(['in', 'id', OfertaEtiqueta::find()->select('oferta_id')->where([
                'etiqueta_id' => UsuariosEtiquetas::find()->select('etiqueta_id')->where(['usuario_id' => $usuarioId])
            ])])->orderBy(['fecha_creacion' => SORT_DESC])
            ->all();


        //renderizar con el resltado de la consulta
        return $this->render('index', [
            'ofertas' => $ofertas,
        ]);
    }


    /**
     * Accion de view al ver mas en una oferta
     */

    public function actionView($id)
    {
        $model = Ofertas::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('La oferta solicitada no existe.');
        }

        //Renderizar la vista con la oferta con el id 
        return $this->render('view', [
            'model' => $model,
        ]);
    }


    /**
     * Accion para añadir una nueva preferencia
     * 
     *//*
    public function actionAnadir($tipo, $id)
    {
        $usuarioId = Yii::$app->user->id;

        switch ($tipo) {
            case 'categoria':
                $modelo = new UsuariosCategorias(['usuario_id' => $usuarioId, 'categoria_id' => $id]);
                break;
            case 'etiqueta':
                $modelo = new UsuariosEtiquetas(['usuario_id' => $usuarioId, 'etiqueta_id' => $id]);
                break;
            case 'zona':
                $modelo = new UsuariosZonas(['usuario_id' => $usuarioId, 'zona_id' => $id]);
                break;
            default:
                throw new NotFoundHttpException('Tipo de preferencia no válido.');
        }



        if ($modelo->save()) {
            Yii::$app->session->setFlash('success', 'Preferencia añadida correcatmente');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido añadir esta preferencia');
        }

        return $this->redirect(['index']);
    }




    /**
     * Eliminar una preferencia 
     *//*
    public function actionEliminar($tipo, $id)
    {

        $usuarioId = Yii::$app->user->id;
        //Elegimos que tipo de preferencia es
        switch ($tipo) {
            case 'categoria':
                $modelo = UsuariosCategorias::findOne(['usuario_id' => $usuarioId, 'categoria_id' => $id]);
                break;
            case 'etiqueta':
                $modelo = UsuariosEtiquetas::findOne(['usuario_id' => $usuarioId, 'etiqueta_id' => $id]);
                break;
            case 'zona':
                $modelo = UsuariosZonas::findOne(['usuario_id' => $usuarioId, 'zona_id' => $id]);
                break;
            default:
                throw new NotFoundHttpException('Preferencia no válida.');
        }

        if ($modelo && $modelo->delete()) {
            Yii::$app->session->setFlash('success', 'Preferencia eliminada.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo eliminar la preferencia.');
        }

        return $this->redirect(['index']);
    }*/
}
