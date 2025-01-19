<?php

namespace app\models;

use Yii;
use app\models\Ofertas;

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
 * @property Comentario $comentarioOrigen
 * @property Comentario[] $comentarios
 * @property Incidencia[] $incidencias
 * @property Oferta $oferta
 * @property Usuario $usuario
 */
class Comentario extends \yii\db\ActiveRecord
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
            [['comentario_origen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comentario::class, 'targetAttribute' => ['comentario_origen_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_id' => 'id']],
            // Filtro automático para palabras inapropiadas
            ['texto', 'filter', 'filter' => function ($value) {
                $palabrasProhibidas = Yii::$app->params['palabrasProhibidas'];
                foreach ($palabrasProhibidas as $palabra) {
                    $value = preg_replace('/' . preg_quote($palabra, '/') . '/iu', '****', $value);
                }
                return $value;
            }],
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
     * @return \yii\db\ActiveQuery
     */
    public function getComentarioOrigen()
    {
        return $this->hasOne(Comentario::class, ['id' => 'comentario_origen_id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['comentario_origen_id' => 'id']);
    }

    /**
     * Gets query for [[Incidencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIncidencias()
    {
        return $this->hasMany(Incidencia::class, ['comentario_id' => 'id']);
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
     * Método antes de guardar el registro
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Verificar límite de comentarios por usuario
            if ($this->isNewRecord) {
                $usuarioId = Yii::$app->user->id;
                $limite = Yii::$app->params['limiteComentarios'];
                $conteo = self::find()->where(['usuario_id' => $usuarioId])->count();

                if ($conteo >= $limite) {
                    $this->addError('texto', 'Has alcanzado el límite de comentarios permitidos.');
                    return false;
                }
            }

            // Actualizar fecha de modificación
            $this->fecha_modificacion = date('Y-m-d H:i:s');

            return true;
        }
        return false;
    }
}
