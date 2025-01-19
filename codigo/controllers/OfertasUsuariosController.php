<?php

namespace app\controllers;

use Yii;
use app\models\Ofertas;
use app\models\Seguimientos;
use app\models\OfertasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;



class OfertasUsuariosController extends Controller
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
                                'create',
                                'update',
                                'delete',
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

    public function actionIndex()
    {
        $searchModel = new OfertasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['usuario_creador_id' => Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        // Verificar si el usuario actual está siguiendo la oferta
        $esSeguidor = false;
        if (!Yii::$app->user->isGuest) {
            $usuarioId = Yii::$app->user->id;
            $esSeguidor = $model->getSeguidores()
                ->where(['usuario_id' => $usuarioId])
                ->exists();
        }

        return $this->render('view', [
            'model' => $model,
            'esSeguidor' => $esSeguidor,
        ]);
    }


    public function actionCreate()
    {
        $model = new Ofertas();
        $model->usuario_creador_id = Yii::$app->user->id; //Asignar usuario logueado como creador
        $model->scenario = 'usuario';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Oferta creada correctamente');
            return $this->redirect(['index']);
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->usuario_creador_id !== Yii::$app->user->id) { //si el logueado no es el creador
            throw new NotFoundHttpException('No tienes permiso para modificar esta oferta.');
        }



        $model->scenario = 'usuario';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('sucess', 'Oferta actualizada correctamente');
            return $this->redirect(['index']);
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);



        if ($model->usuario_creador_id !== Yii::$app->user->id) { //si el logueado no es el creador
            throw new NotFoundHttpException('No tienes permiso para modificar esta oferta.');
        }


        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Oferta eliminada correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo eliminar la oferta.');
        }

        return $this->redirect(['index']);
    }



    protected function findModel($id)
    {
        if (($model = Ofertas::findOne(['id' => $id, 'usuario_creador_id' => Yii::$app->user->id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



    /*
    public function actionBloquear($id)
    {
        $model = $this->findModel($id);
        $model->estado = 'bloqueada';
        $model->fecha_bloqueo = date('Y-m-d H:i:s');
        $model->save();
        return $this->redirect(['view', 'id' => $model->id]);
    }
*/

    /*
    public function actionDesbloquear($id)
    {
        $model = $this->findModel($id);
        $model->estado = 'activa';
        $model->fecha_bloqueo = null;
        $model->save();
        return $this->redirect(['view', 'id' => $model->id]);
    }

    */
    /*
    public function actionSeguir($id)
    {
        $usuarioId = Yii::$app->user->id;

        if (!$usuarioId) {
            return $this->redirect(['site/login']); // Redirigir a login si no está autenticado
        }

        if (Seguimientos::seguir($usuarioId, $id)) {
            Yii::$app->session->setFlash('success', 'Ahora sigues esta oferta.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo seguir la oferta.');
        }

        return $this->redirect(['ofertas/view', 'id' => $id]);
    }

    */
    /*    public function actionDejarDeSeguir($id)
    {
        $usuarioId = Yii::$app->user->id;

        if (!$usuarioId) {
            return $this->redirect(['site/login']); // Redirigir a login si no está autenticado
        }

        if (Seguimientos::dejarDeSeguir($usuarioId, $id)) {
            Yii::$app->session->setFlash('success', 'Has dejado de seguir esta oferta.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo dejar de seguir la oferta.');
        }

        return $this->redirect(['ofertas/view', 'id' => $id]);
    }
*/

    /*
    public function actionVisor()
    {
        // Recientes: Todas las ofertas activas ordenadas por fecha de creación
        $queryRecientes = Ofertas::find()
            ->where(['estado' => 'visible'])
            ->orderBy(['fecha_creacion' => SORT_DESC]);
    
        // Destacados: Ofertas marcadas como destacadas
        $queryDestacados = Ofertas::find()
            ->where(['estado' => 'visible', 'destacada' => 1])
            ->orderBy(['fecha_inicio' => SORT_DESC]);
    
        // Patrocinadas: Ofertas marcadas como patrocinadas
        $queryPatrocinados = Ofertas::find()
            ->where(['estado' => 'visible', 'patrocinada' => 1])
            ->orderBy(['fecha_inicio' => SORT_DESC]);
    
        // Personalizadas: Lógica de recomendación para el usuario
        $usuarioCategoriaPreferida = 1; // Ejemplo: Una categoría específica para el usuario
        $queryPersonalizados = Ofertas::find()
            ->where(['estado' => 'visible', 'categoria_id' => $usuarioCategoriaPreferida])
            ->orderBy(['fecha_inicio' => SORT_DESC]);
    
        // Paginación
        $paginationRecientes = new \yii\data\Pagination(['totalCount' => $queryRecientes->count(), 'defaultPageSize' => 10]);
        $paginationDestacados = new \yii\data\Pagination(['totalCount' => $queryDestacados->count(), 'defaultPageSize' => 10]);
        $paginationPatrocinados = new \yii\data\Pagination(['totalCount' => $queryPatrocinados->count(), 'defaultPageSize' => 10]);
        $paginationPersonalizados = new \yii\data\Pagination(['totalCount' => $queryPersonalizados->count(), 'defaultPageSize' => 10]);
    
        // Obtención de datos
        $recientes = $queryRecientes->offset($paginationRecientes->offset)->limit($paginationRecientes->limit)->all();
        $destacados = $queryDestacados->offset($paginationDestacados->offset)->limit($paginationDestacados->limit)->all();
        $patrocinados = $queryPatrocinados->offset($paginationPatrocinados->offset)->limit($paginationPatrocinados->limit)->all();
        $personalizados = $queryPersonalizados->offset($paginationPersonalizados->offset)->limit($paginationPersonalizados->limit)->all();
    
        return $this->render('visor', [
            'recientes' => $recientes,
            'destacados' => $destacados,
            'patrocinados' => $patrocinados,
            'personalizados' => $personalizados,
            'paginationRecientes' => $paginationRecientes,
            'paginationDestacados' => $paginationDestacados,
            'paginationPatrocinados' => $paginationPatrocinados,
            'paginationPersonalizados' => $paginationPersonalizados,
        ]);
    }
    

    public function actionSearch($keyword = null)
    {
        $query = Ofertas::find()
            ->where(['like', 'titulo', $keyword])
            ->orWhere(['like', 'descripcion', $keyword])
            ->andWhere(['estado' => 'activa']);

        $models = $query->all();

        return $this->render('search', [
            'models' => $models,
            'keyword' => $keyword,
        ]);
    }

    public function actionAdvancedSearch($titulo = null, $categoria = null, $precio_max = null)
    {
        $query = Ofertas::find()
            ->andFilterWhere(['like', 'titulo', $titulo])
            ->andFilterWhere(['like', 'categoria_id', $categoria])
            ->andFilterWhere(['<=', 'precio_actual', $precio_max])
            ->andWhere(['estado' => 'activa']);

        $models = $query->all();

        return $this->render('advanced-search', [
            'models' => $models,
            'titulo' => $titulo,
            'categoria' => $categoria,
            'precio_max' => $precio_max,
        ]);
    }*/
}
