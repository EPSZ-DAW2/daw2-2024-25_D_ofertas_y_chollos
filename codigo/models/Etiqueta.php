<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "etiquetas".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 *
 * @property OfertasEtiquetas[] $ofertasEtiquetas
 * @property UsuariosEtiquetas[] $usuariosEtiquetas
 */
class Etiqueta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'etiquetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    /**
     * Gets query for [[OfertasEtiquetas]].
     *
     * @return \yii\db\ActiveQuery|OfertasEtiquetasQuery
     */
    public function getOfertasEtiquetas()
    {
        return $this->hasMany(OfertaEtiqueta::class, ['etiqueta_id' => 'id']);
    }

    /**
     * Gets query for [[UsuariosEtiquetas]].
     *
     * @return \yii\db\ActiveQuery|UsuariosEtiquetasQuery
     */
    /*
    public function getUsuariosEtiquetas()
    {
        return $this->hasMany(UsuariosEtiquetas::class, ['etiqueta_id' => 'id']);
    }
        */

    /**
     * {@inheritdoc}
     * @return EtiquetasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EtiquetasQuery(get_called_class());
    }
}
