<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios_zonas".
 *
 * @property int $id
 * @property string $usuario_id
 * @property string|null $zona_id
 *
 */
class Usuarioszonas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios_zonas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'zona_id'], 'required'],
            [['usuario_id', 'zona_id'], 'integer'],
            [['usuario_id', 'zona_id'], 'unique', 'targetAttribute' => ['usuario_id', 'zona_id'], 'message' => 'Ya estas siguiendo esta zona'],
            //Comprobamos que el usuario y zona existan en nuestra bbdd
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'id']],
            [['zona_id'], 'exist', 'skipOnError' => true, 'targetClass' => zonas::class, 'targetAttribute' => ['zona_id' => 'id']],
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
            'zona_id' => Yii::t('app', 'Zona'),
        ];
    }

    /**
     * 
     * Relacion con modelo usuarios
     * 
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_id']);
    }

    /**
     * Relacion con modelo zonas
     *
     * 
     * */

    public function getZona()
    {
        return $this->hasOne(Zonas::class, ['id' => 'zona_id']);
    }
}
