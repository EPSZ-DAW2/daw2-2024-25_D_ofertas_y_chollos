<?php

namespace app\controllers;

use Yii;
use app\models\Etiqueta;
use app\models\UsuariosEtiquetas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EtiquetasController implements the CRUD actions for Etiqueta model.
 */
class SeguimientoEtiquetasController extends Controller
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
                    'class' => \yii\filters\AccessControl::class,
                    'rules' => [

                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'seguir',
                                'dejar-de-seguir',
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
     * Muestra las etiquetas que sigue el usuario y las que puede seguir.
     *
     * @return string
     */
    public function actionIndex()
    {
        $usuarioId = Yii::$app->user->id;


        //consulta de las etiquetas seguidas
        $etiquetasSeguidas = UsuariosEtiquetas::find()
            ->where(['usuario_id' => $usuarioId])
            ->with('etiqueta')
            ->all();


        //consulta de las que no sigue
        $seguidasIds = UsuariosEtiquetas::find()
            ->select('etiqueta_id')
            ->where(['usuario_id' => $usuarioId])
            ->column();

        // Etiquetas disponibles
        $etiquetasDisponibles = Etiqueta::find()
            ->where(['not in', 'id', $seguidasIds])
            ->all();

        //Renderizamos la vista con las consultas realizadas
        return $this->render('index', [
            'etiquetasSeguidas' => $etiquetasSeguidas,
            'etiquetasDisponibles' => $etiquetasDisponibles
        ]);
    }

    /**
     * Accion para seguir una nueva etiqueta por un usuario
     * 
     */
    public function actionSeguir($id)
    {
        $usuarioId = Yii::$app->user->id;

        // Verificar si la etiqueta existe
        $etiqueta = Etiqueta::findOne($id);
        if (!$etiqueta) {
            throw new NotFoundHttpException('La etiqueta no existe.');
        }


        //Verificar si el usuario sigue la etiqueta
        $existe = UsuariosEtiquetas::find()
            ->where(['usuario_id' => $usuarioId, 'etiqueta_id' => $id])
            ->exists();


        if (!$existe) {
            //creamos la relacion
            $modelo = new UsuariosEtiquetas([
                'usuario_id' => $usuarioId,
                'etiqueta_id' => $id,
            ]);

            if ($modelo->save()) {
                Yii::$app->session->setFlash('success', 'Has empezado a seguir esta etiqueta');
            } else {
                Yii::$app->session->setFlash('error', 'No se ha podido seguir a esta etiqueta');
            }
        } else {
            Yii::$app->session->setFlash('info', 'Ya estas siguiendo esta etiqueta.');
        }
        return $this->redirect(['index']);
    }

    /**
     * Accion que hace que un usuario deje de seguir una etiqueta
     */
    public function actionDejarDeSeguir($id)
    {
        $usuarioId = Yii::$app->user->id;

        // Buscar la relación entre el usuario y la etiqueta que quiere dejar de seguir
        $modelo = UsuariosEtiquetas::findOne([
            'usuario_id' => $usuarioId,
            'etiqueta_id' => $id,
        ]);


        //Mostramos mensajes si se ha dejado de seguir correctamente o no
        if ($modelo && $modelo->delete()) {
            Yii::$app->session->setFlash('success', 'Ya no sigues esta etiqueta.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo dejar de seguir la etiqueta.');
        }

        return $this->redirect(['index']);
    }
}
