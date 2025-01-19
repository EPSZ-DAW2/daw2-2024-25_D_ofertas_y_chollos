<?php

namespace app\controllers;

use Yii;
use app\models\Etiqueta;
use app\models\UsuariosEtiquetas;
use app\models\UsuariosCategorias;
use app\models\UsuariosZonas;
use app\models\Zonas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Categorias;

/**
 * Controlador de preferencias del usuario
 */
class PreferenciasController extends Controller
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
                                'anadir',
                                'eliminar',
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


        //consulta de las categorias preferidas
        $categoriasPreferidas = UsuariosCategorias::find()
            ->where(['usuario_id' => $usuarioId])
            ->with('categoria')
            ->all();


        //consulta de las estiquetas preferidas
        $etiquetasPreferidas = UsuariosEtiquetas::find()
            ->where(['usuario_id' => $usuarioId])
            ->with('etiqueta')
            ->all();



        //consulta de las zonas preferidas
        $zonasPreferidas = UsuariosZonas::find()
            ->where(['usuario_id' => $usuarioId])
            ->with('zona')
            ->all();


        //consulta de las opciones que hay

        $categoriasDisponibles = Categorias::find()
            ->where(['not in', 'id', UsuariosCategorias::find()->select('categoria_id')->where(['usuario_id' => $usuarioId])])
            ->all();

        $etiquetasDisponibles = Etiqueta::find()
            ->where(['not in', 'id', UsuariosEtiquetas::find()->select('etiqueta_id')->where(['usuario_id' => $usuarioId])])
            ->all();


        $zonasDisponibles = Zonas::find()
            ->where(['not in', 'id', UsuariosZonas::find()->select('zona_id')->where(['usuario_id' => $usuarioId])])
            ->all();

        //Renderizar la vista con las consultas
        return $this->render('index', [
            'categoriasPreferidas' => $categoriasPreferidas,
            'etiquetasPreferidas' => $etiquetasPreferidas,
            'zonasPreferidas' => $zonasPreferidas,
            'categoriasDisponibles' => $categoriasDisponibles,
            'etiquetasDisponibles' => $etiquetasDisponibles,
            'zonasDisponibles' => $zonasDisponibles,
        ]);
    }

    /**
     * Accion para añadir una nueva preferencia
     * 
     */
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
            Yii::$app->session->setFlash('success', 'Preferencia añadida correctamente');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido añadir esta preferencia');
        }

        return $this->redirect(['index']);
    }




    /**
     * Eliminar una preferencia 
     */
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
    }
}
