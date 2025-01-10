<?php

namespace app\controllers;

use app\models\Etiqueta;
use app\models\EtiquetasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EtiquetasController implements the CRUD actions for Etiqueta model.
 */
class EtiquetasController extends Controller
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
     * Lists all Etiqueta models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EtiquetasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Etiqueta model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Etiqueta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Etiqueta();

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
     * Updates an existing Etiqueta model.
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
     * Deletes an existing Etiqueta model.
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

    /**
     * Finds the Etiqueta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Etiqueta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Etiqueta::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*
    public function actionVer($id)
    {
        // Busca la etiqueta por su ID
        $etiqueta = Etiqueta::findOne($id);
        if (!$etiqueta) {
            throw new NotFoundHttpException("La etiqueta no existe.");
        }

        // Obtén las ofertas asociadas con esta etiqueta
        $ofertas = Oferta::find()
            ->joinWith('etiquetas') // Relación entre ofertas y etiquetas
            ->where(['etiquetas.id' => $id])
            ->all();

        // Renderiza la vista y pasa los datos
        return $this->render('ver', [
            'etiqueta' => $etiqueta,
            'ofertas' => $ofertas,
        ]);
    }
        */

    
        /*    public function actionVer($id)
    {
        $etiqueta = Etiqueta::findOne($id);
        if (!$etiqueta) {
            throw new NotFoundHttpException("La etiqueta no existe.");
        }

        return $this->render('ver', [
            'etiqueta' => $etiqueta,
            ]);
    }
            */
            public function actionVer($id)
{
    // Buscar la etiqueta por ID
    $etiqueta = Etiqueta::findOne($id);
    if (!$etiqueta) {
        throw new NotFoundHttpException("La etiqueta no existe.");
    }

    // Datos de ejemplo para las ofertas
    $ofertas = [
        ['id' => 1, 'titulo' => 'Oferta 1', 'descripcion' => 'Descripción de la oferta 1'],
        ['id' => 2, 'titulo' => 'Oferta 2', 'descripcion' => 'Descripción de la oferta 2'],
        ['id' => 3, 'titulo' => 'Oferta 3', 'descripcion' => 'Descripción de la oferta 3'],
    ];

    // Renderizar la vista y pasar la etiqueta y las ofertas
    return $this->render('ver', [
        'etiqueta' => $etiqueta,
        'ofertas' => $ofertas,
    ]);
}

    /*
    public function actionVer($id)
    {
        // Busca la etiqueta por su ID
        $etiqueta = Etiqueta::findOne($id);
        if (!$etiqueta) {
            throw new NotFoundHttpException("La etiqueta no existe.");
        }

        // Ofertas simuladas
        $ofertasEjemplo = [
            ['titulo' => 'Oferta 1: Descuento en Smartphones', 'descripcion' => 'Hasta un 30% de descuento en modelos seleccionados.'],
            ['titulo' => 'Oferta 2: Rebajas de Invierno', 'descripcion' => 'Descuentos especiales en ropa de invierno.'],
            ['titulo' => 'Oferta 3: Promoción en Electrónica', 'descripcion' => 'Compra 1 y obtén otro al 50%.'],
        ];

        // Renderiza la vista
        return $this->render('ver', [
            'etiqueta' => $etiqueta,
            'ofertas' => $ofertasEjemplo,
        ]);
    }
        */
}
