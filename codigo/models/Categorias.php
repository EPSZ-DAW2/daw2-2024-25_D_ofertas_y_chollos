<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partidos".
 *
 * @property int $id Identificador interno de la categoría
 * @property string $nombre Nombre de la categoría
 * @property string $descripcion Descripción de la categoría
 * @property int $revisado Comprobación de que la categoría esta activa
 * @property int $categoria_padre_id Identificador de la categoría padre
 * 
 * Aquí van las funciones
 **/

 class Categorias extends \yii\db\ActiveRecord
 {
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorias';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'],'required', 'message' => 'Este campo es obligatorio.'],
            [['nombre','descripcion'], 'string', 'max' => 255],
            [['revisado'], 'integer'],
            [['revisado'],'default','value'=>0],
            [['categoria_padre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['categoria_padre_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'revisado' => 'Revisado',
            'categoria_padre_id' => 'ID Categoria Padre',
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaPadre()
    {
        return $this->hasOne(Categorias::class, ['id' => 'categoria_padre_id']);
    }
 }
?>