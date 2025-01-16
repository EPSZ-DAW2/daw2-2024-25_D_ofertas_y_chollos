<?php

namespace app\controllers;

use app\models\Ofertas;
use app\models\OfertasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OfertasController implements the CRUD actions for Ofertas model.
 */
class OfertasController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
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
    }

    /**
     * Lists all Ofertas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OfertasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ofertas model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ofertas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
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

    /**
     * Updates an existing Ofertas model.
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
     * Deletes an existing Ofertas model.
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

public function actionBloquear($id)
{
    $model = $this->findModel($id);
    $model->estado = 'bloqueada';
    $model->fecha_bloqueo = date('Y-m-d H:i:s');
    $model->save();
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

    /**
     * Finds the Ofertas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Ofertas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ofertas::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



    public function actionVisor()
    {
        // Recientes: Ofertas ordenadas por fecha de creación (las más nuevas primero)
        $queryRecientes = Ofertas::find()
            ->where(['estado' => 'activa'])
            ->orderBy(['fecha_creacion' => SORT_DESC]);
    
        $paginationRecientes = new \yii\data\Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $queryRecientes->count(),
        ]);
    
        $recientes = $queryRecientes->offset($paginationRecientes->offset)
            ->limit($paginationRecientes->limit)
            ->all();
    
        // Destacados: Ofertas marcadas como 'destacada'
        $queryDestacados = Ofertas::find()
            ->where(['estado' => 'activa', 'seccion' => 'destacada'])
            ->orderBy(['fecha_inicio' => SORT_DESC]);
    
        $paginationDestacados = new \yii\data\Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $queryDestacados->count(),
        ]);
    
        $destacados = $queryDestacados->offset($paginationDestacados->offset)
            ->limit($paginationDestacados->limit)
            ->all();
    
        // Patrocinados: Ofertas marcadas como 'patrocinada'
        $queryPatrocinados = Ofertas::find()
            ->where(['estado' => 'activa', 'seccion' => 'patrocinada'])
            ->orderBy(['fecha_inicio' => SORT_DESC]);
    
        $paginationPatrocinados = new \yii\data\Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $queryPatrocinados->count(),
        ]);
    
        $patrocinados = $queryPatrocinados->offset($paginationPatrocinados->offset)
            ->limit($paginationPatrocinados->limit)
            ->all();
    
        // Personalizados: Ofertas recomendadas por categoría (usuario ficticio)
        $usuarioCategoriaPreferida = 1; // Cambia este valor según la lógica de usuario.
        $queryPersonalizados = Ofertas::find()
            ->where(['estado' => 'activa', 'categoria_id' => $usuarioCategoriaPreferida])
            ->orderBy(['fecha_inicio' => SORT_DESC]);
    
        $paginationPersonalizados = new \yii\data\Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $queryPersonalizados->count(),
        ]);
    
        $personalizados = $queryPersonalizados->offset($paginationPersonalizados->offset)
            ->limit($paginationPersonalizados->limit)
            ->all();
    
        // Renderizamos la vista pasando los datos
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
    }
    

}
