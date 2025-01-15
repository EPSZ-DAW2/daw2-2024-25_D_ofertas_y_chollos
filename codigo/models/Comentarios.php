<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property int|null $oferta_id
 * @property string $texto
 * @property int|null $comentario_origen_id
 * @property int|null $cerrado
 * @property int|null $denuncias
 * @property string|null $fecha_primer_denuncia
 * @property string|null $motivo_denuncia
 * @property int|null $bloqueado
 * @property string|null $fecha_bloqueo
 * @property string|null $motivo_bloqueo
 * @property int|null $usuario_id
 * @property string|null $fecha_creacion
 * @property string|null $fecha_modificacion
 *
 * @property Comentarios $comentarioOrigen
 * @property Comentarios[] $comentarios
 * @property Incidencias[] $incidencias
 * @property Ofertas $oferta
 * @property Usuarios $usuario
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oferta_id', 'comentario_origen_id', 'cerrado', 'denuncias', 'bloqueado', 'usuario_id'], 'integer'],
            [['texto'], 'required'],
            [['texto', 'motivo_denuncia', 'motivo_bloqueo'], 'string'],
            [['fecha_primer_denuncia', 'fecha_bloqueo', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['oferta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ofertas::class, 'targetAttribute' => ['oferta_id' => 'id']],
            [['comentario_origen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comentarios::class, 'targetAttribute' => ['comentario_origen_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'oferta_id' => 'Oferta ID',
            'texto' => 'Texto',
            'comentario_origen_id' => 'Comentario Origen ID',
            'cerrado' => 'Cerrado',
            'denuncias' => 'Denuncias',
            'fecha_primer_denuncia' => 'Fecha Primer Denuncia',
            'motivo_denuncia' => 'Motivo Denuncia',
            'bloqueado' => 'Bloqueado',
            'fecha_bloqueo' => 'Fecha Bloqueo',
            'motivo_bloqueo' => 'Motivo Bloqueo',
            'usuario_id' => 'Usuario ID',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * Gets query for [[ComentarioOrigen]].
     *
     * @return \yii\db\ActiveQuery|ComentariosQuery
     */
    public function getComentarioOrigen()
    {
        return $this->hasOne(Comentarios::class, ['id' => 'comentario_origen_id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery|ComentariosQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::class, ['comentario_origen_id' => 'id']);
    }

    /**
     * Gets query for [[Incidencias]].
     *
     * @return \yii\db\ActiveQuery|IncidenciasQuery
     */
    public function getIncidencias()
    {
        return $this->hasMany(Incidencias::class, ['comentario_id' => 'id']);
    }

    /**
     * Gets query for [[Oferta]].
     *
     * @return \yii\db\ActiveQuery|OfertasQuery
     */
    public function getOferta()
    {
        return $this->hasOne(Ofertas::class, ['id' => 'oferta_id']);
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
     * @return ComentariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ComentariosQuery(get_called_class());
    }
}
