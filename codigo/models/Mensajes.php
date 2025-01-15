<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mensajes".
 *
 * @property int $id
 * @property string|null $fecha_hora
 * @property string $texto
 * @property int|null $usuario_origen_id
 * @property int|null $usuario_destino_id
 *
 * @property Usuarios $usuarioDestino
 * @property Usuarios $usuarioOrigen
 */
class Mensajes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mensajes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_hora'], 'safe'],
            [['texto'], 'required'],
            [['texto'], 'string'],
            [['usuario_origen_id', 'usuario_destino_id'], 'integer'],
            [['usuario_origen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_origen_id' => 'id']],
            [['usuario_destino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_destino_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_hora' => Yii::t('app', 'Fecha Hora'),
            'texto' => Yii::t('app', 'Texto'),
            'usuario_origen_id' => Yii::t('app', 'Usuario Origen ID'),
            'usuario_destino_id' => Yii::t('app', 'Usuario Destino ID'),
        ];
    }

    /**
     * Gets query for [[UsuarioDestino]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioDestino()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_destino_id']);
    }

    /**
     * Gets query for [[UsuarioOrigen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioOrigen()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_origen_id']);
    }



    /**
     * Obtiene el nombre del usuario de origen
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNombreUsuarioOrigen()
    {
        return $this->usuarioOrigen ? $this->usuarioOrigen->nombre : 'Desconocido';
    }



    /**
     * Obtiene el nombre del usuario de destino
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNombreUsuarioDestino()
    {
        return $this->usuarioDestino ? $this->usuarioDestino->nombre : 'Desconocido';
    }
}
