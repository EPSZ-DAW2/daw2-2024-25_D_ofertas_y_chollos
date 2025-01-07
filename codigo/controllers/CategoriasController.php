<?php

namespace app\controllers;

use Yii;
use app\models\Categorias;
use yii\data\ActiveDataProvider;

class CategoriasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->view->title = 'Ofertas y Chollos - Categorías';

        // Mostramos todas las categorías
        $query = Categorias::find();
        $categorias = $query->all();

        return $this->render('index', [
            'categorias'->$categorias;
        ]);
    }
}
?>