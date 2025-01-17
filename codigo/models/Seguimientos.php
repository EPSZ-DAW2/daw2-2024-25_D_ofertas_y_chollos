<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seguimientos".
 *
 * @property int $id
 * @property int|null $usuario_id
 * @property int|null $oferta_id
 * @property string|null $fecha_creacion
 *
 * @property Ofertas $oferta
 * @property Usuarios $usuario
 */
class Seguimientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seguimientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'oferta_id'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['usuario_id', 'oferta_id'], 'required'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'id']],
            [['oferta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ofertas::class, 'targetAttribute' => ['oferta_id' => 'id']],
            //Aseguramos que un usuario no pueda seguir una oferta que ya esta siguiendo
            [['usuario_id', 'oferta_id'], 'unique', 'targetAttribute' => ['usuario_id', 'oferta_id'], 'message' => 'Ya sigues a esta oferta'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario',
            'oferta_id' => 'Oferta',
            'fecha_creacion' => 'Fecha de Creación',
        ];
    }

    /**
     * Gets query for [[Oferta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOferta()
    {
        return $this->hasOne(Ofertas::class, ['id' => 'oferta_id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_id']);
    }

    /**
     * Guarda un nuevo seguimiento.
     *
     * @param int $usuarioId
     * @param int $ofertaId
     * @return bool
     */
    public static function seguir($usuarioId, $ofertaId)
    {
        $seguimiento = new self();
        $seguimiento->usuario_id = $usuarioId;
        $seguimiento->oferta_id = $ofertaId;
        /* $seguimiento->fecha_creacion = date('Y-m-d H:i:s');*/
        return $seguimiento->save();
    }

    /**
     * Elimina un seguimiento existente.
     *
     * @param int $usuarioId
     * @param int $ofertaId
     * @return int
     */
    public static function dejarDeSeguir($usuarioId, $ofertaId)
    {
        return self::deleteAll(['usuario_id' => $usuarioId, 'oferta_id' => $ofertaId]);
    }

    /**
     * Verifica si un usuario ya sigue una oferta.
     *
     * @param int $usuarioId
     * @param int $ofertaId
     * @return bool
     */
    public static function esSeguidor($usuarioId, $ofertaId)
    {
        return self::find()->where(['usuario_id' => $usuarioId, 'oferta_id' => $ofertaId])->exists();
    }

    /**
     * {@inheritdoc}
     * @return SeguimientosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SeguimientosQuery(get_called_class());
    }


    /**
     * Obtener las funciones que sigue un usuario
     */
    public static function obtenerOfertasSeguidas($usuarioId)
    {
        return Ofertas::find()
            ->joinWith('seguidores')
            ->where(['seguimientos.usuario_id' => $usuarioId])
            ->all();
    }
}
