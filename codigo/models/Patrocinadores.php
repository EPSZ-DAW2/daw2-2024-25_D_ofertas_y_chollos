<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patrocinadores".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string $nombre
 * @property int|null $aprobado
 * @property string $creado_en
 * @property string $actualizado_en
 *
 * @property Usuarios $usuario
 */
class Patrocinadores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patrocinadores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'nombre'], 'required'],
            [['usuario_id', 'aprobado'], 'integer'],
            [['creado_en', 'actualizado_en'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'id']],
            [['aprobado'], 'integer'], // Validación como número entero
            [['aprobado'], 'default', 'value' => 0], // Por defecto, pendiente
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'aprobado' => Yii::t('app', 'Aprobado'),
            'creado_en' => Yii::t('app', 'Creado En'),
            'actualizado_en' => Yii::t('app', 'Actualizado En'),
            'aprobado' => 'Estado de Aprobación',
        ];
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_id']);
    }

    /**
     * {@inheritdoc}
     * @return PatrocinadoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PatrocinadoresQuery(get_called_class());
    }
}
