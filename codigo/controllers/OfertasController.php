<?php

namespace app\controllers;

use Yii; 
use app\models\Ofertas;
use app\models\Seguimientos;
use app\models\OfertasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Zonas;

class OfertasController extends Controller
{
public function behaviors()
{
    return array_merge(
        parent::behaviors(),
        [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['index', 'create', 'update', 'delete', 'bloquear', 'desbloquear', 'busqueda'],
                'rules' => [
                    // Permitir solo a administradores las acciones de administración
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete', 'bloquear', 'desbloquear'],
                        'roles' => ['admin'],
                    ],
                    // Permitir a cualquier usuario autenticado acceder a "busqueda"
                    [
                        'allow' => true,
                        'actions' => ['busqueda'],
                        'roles' => ['@'],
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

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
    
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $estadoTerminacionId = Yii::$app->request->post('estado_terminacion_id'); // Recoger el estado de terminación enviado desde el formulario
            if ($estadoTerminacionId) {
                $model->estado_terminacion_id = $estadoTerminacionId; // Asignar el estado de terminación
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'La oferta ha sido actualizada.');
            } else {
                Yii::$app->session->setFlash('error', 'No se pudo actualizar la oferta.');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionBloquear($id)
    {
        $model = $this->findModel($id);
    
        if (Yii::$app->request->isPost) {
            $claseBloqueoId = Yii::$app->request->post('clase_bloqueo_id'); // Recoger la clase de bloqueo enviada desde el formulario
            if ($claseBloqueoId) {
                $model->estado = 'bloqueada';
                $model->clase_bloqueo_id = $claseBloqueoId; // Asignar la clase de bloqueo
                $model->fecha_bloqueo = date('Y-m-d H:i:s');
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'La oferta ha sido bloqueada.');
                } else {
                    Yii::$app->session->setFlash('error', 'No se pudo bloquear la oferta.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Debe seleccionar una razón de bloqueo.');
            }
        }
    
        return $this->redirect(['view', 'id' => $model->id]);
    }
    

    public function actionDesbloquear($id)
    {
        $model = $this->findModel($id);
        $model->estado = 'activa';
        $model->fecha_bloqueo = null;
        $model->save();
        return $this->redirect(['view', 'id' => $model->id]);
    }

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

    public function actionDejarDeSeguir($id)
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

    protected function findModel($id)
    {
        if (($model = Ofertas::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

 
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
            ->andWhere(['estado' => 'visible']);

        $models = $query->all();

        return $this->render('search', [
            'models' => $models,
            'keyword' => $keyword,
        ]);
    }
    public function actionAdvancedSearch($titulo = null, $zona = null, $precio_max = null, $fecha_inicio = null)
    {
        $query = Ofertas::find()
            ->joinWith('zona') // Relación con la tabla 'zonas'
            ->andFilterWhere(['like', 'titulo', $titulo])
            ->andFilterWhere(['like', 'zonas.nombre', $zona]) // Comparar con el nombre de la zona
            ->andFilterWhere(['<=', 'precio_actual', $precio_max])
            ->andFilterWhere(['>=', 'fecha_inicio', $fecha_inicio]) // Filtro por fecha de inicio
            ->andWhere(['estado' => 'visible']);
    
        // Validación de filtros vacíos
        if (empty($titulo) && empty($zona) && empty($precio_max) && empty($fecha_inicio)) {
            $mensaje = 'Por favor, aplique al menos un filtro para realizar la búsqueda.';
            return $this->render('advanced-search', [
                'models' => [],
                'titulo' => $titulo,
                'zona' => $zona,
                'precio_max' => $precio_max,
                'fecha_inicio' => $fecha_inicio,
                'mensaje' => $mensaje,
            ]);
        }
    
        $models = $query->all();
    
        return $this->render('advanced-search', [
            'models' => $models,
            'titulo' => $titulo,
            'zona' => $zona,
            'precio_max' => $precio_max,
            'fecha_inicio' => $fecha_inicio,
            'mensaje' => null,
        ]);
    }
    
    
    public function actionPatrocinar($id)
    {
        $model = $this->findModel($id);
    
        if (!$model) {
            throw new NotFoundHttpException('La oferta no existe.');
        }
    
        // Verificar si ya está patrocinada
        if ($model->patrocinador_id !== null) {
            Yii::$app->session->setFlash('error', 'Esta oferta ya está patrocinada.');
            return $this->redirect(['view', 'id' => $id]);
        }
    
        // Asignar el usuario actual como patrocinador
        $model->patrocinador_id = Yii::$app->user->id;
        $model->patrocinada = 1; // Marcar como patrocinada
    
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Has patrocinado esta oferta exitosamente.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo patrocinar esta oferta.');
        }
    
        return $this->redirect(['view', 'id' => $id]);
    }
    
    
    
    public function actionPatrocinadas()
    {
        $ofertasPatrocinadas = Ofertas::find()
            ->where(['patrocinada' => 1]) // Solo ofertas marcadas como patrocinadas
            ->with('patrocinador') // Cargar la relación con el patrocinador
            ->all();
    
        return $this->render('patrocinadas', [
            'ofertasPatrocinadas' => $ofertasPatrocinadas,
        ]);
    }

    public function actionDestacar($id)
{
    $usuarioId = Yii::$app->user->id;

    if (!$usuarioId) {
        return $this->redirect(['site/login']); // Redirigir a login si no está autenticado
    }

    $model = $this->findModel($id);
    $model->destacada = 1; // Cambiar la columna 'destacada' a 1
    $model->save();

    Yii::$app->session->setFlash('success', 'La oferta ha sido destacada exitosamente.');
    return $this->redirect(['ofertas/view', 'id' => $id]);
}

    


}