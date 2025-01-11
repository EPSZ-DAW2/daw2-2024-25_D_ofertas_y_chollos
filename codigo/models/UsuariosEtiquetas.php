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
 */
class UsuariosEtiquetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios_etiquetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'etiqueta_id'], 'required'],
            [['usuario_id', 'etiqueta_id'], 'integer'],
            [['usuario_id', 'etiqueta_id'], 'unique', 'targetAttribute' => ['usuario_id', 'etiqueta_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'usuario_id' => Yii::t('app', 'Usuario'),
            'etiqueta_id' => Yii::t('app', 'Etiqueta'),
        ];
    }

    /**
     * 
     * Relacion con modelo usuarios
     * 
     */
    public function getUsuarios()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_id']);
    }

    /**
     * Relacion con modelo etiquetas
     *
     * 
     * */

    public function getEtiqueta()
    {
        return $this->hasOne(Etiqueta::class, ['id' => 'etiqueta_id']);
    }
}
