<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ofertas".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descripcion
 * @property string|null $url_externa
 * @property string|null $fecha_inicio
 * @property string|null $fecha_fin
 * @property float|null $precio_actual
 * @property float|null $precio_original
 * @property float|null $descuento
 * @property int|null $zona_id
 * @property int|null $categoria_id
 * @property int|null $proveedor_id
 * @property int|null $anuncio_destacado
 * @property string $estado
 * @property int|null $denuncias
 * @property string|null $fecha_primer_denuncia
 * @property string|null $motivo_denuncia
 * @property string|null $fecha_bloqueo
 * @property string|null $motivo_bloqueo
 * @property int|null $cerrado_comentar
 * @property int|null $usuario_creador_id
 * @property string|null $fecha_creacion
 * @property int|null $usuario_modificador_id
 * @property string|null $fecha_modificacion
 * 
 *
 * @property Anuncios[] $anuncios
 * @property Categorias $categoria
 * @property Comentarios[] $comentarios
 * @property Incidencias[] $incidencias
 * @property OfertasEnlaces[] $ofertasEnlaces
 * @property OfertasEtiquetas[] $ofertasEtiquetas
 * @property OfertasImagenes[] $ofertasImagenes
 * @property OfertasValoraciones[] $ofertasValoraciones
 * @property Proveedores $proveedor
 * @property Seguimientos[] $seguimientos
 * @property Usuarios $usuarioCreador
 * @property Usuarios $usuarioModificador
 * @property Zonas $zona
 */
class Ofertas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ofertas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion'], 'required'],
            [['descripcion', 'motivo_denuncia', 'motivo_bloqueo'], 'string'],
            [['fecha_inicio', 'fecha_fin', 'fecha_primer_denuncia', 'fecha_bloqueo', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['precio_actual', 'precio_original', 'descuento'], 'number'],
            [['zona_id', 'categoria_id', 'proveedor_id', 'anuncio_destacado', 'denuncias', 'cerrado_comentar', 'usuario_creador_id', 'usuario_modificador_id'], 'integer'],
            [['titulo', 'url_externa'], 'string', 'max' => 255],
            [['estado'], 'string', 'max' => 20],
            [['zona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zonas::class, 'targetAttribute' => ['zona_id' => 'id']],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::class, 'targetAttribute' => ['categoria_id' => 'id']],
            [['proveedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedores::class, 'targetAttribute' => ['proveedor_id' => 'id']],
            [['usuario_creador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_creador_id' => 'id']],
            [['usuario_modificador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['usuario_modificador_id' => 'id']],
            [['patrocinador_id'], 'integer'],
            [['patrocinador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['patrocinador_id' => 'id']],
        
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'url_externa' => 'Url Externa',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'precio_actual' => 'Precio Actual',
            'precio_original' => 'Precio Original',
            'descuento' => 'Descuento',
            'zona_id' => 'Zona ID',
            'categoria_id' => 'Categoria ID',
            'proveedor_id' => 'Proveedor ID',
            'anuncio_destacado' => 'Anuncio Destacado',
            'estado' => 'Estado',
            'denuncias' => 'Denuncias',
            'fecha_primer_denuncia' => 'Fecha Primer Denuncia',
            'motivo_denuncia' => 'Motivo Denuncia',
            'fecha_bloqueo' => 'Fecha Bloqueo',
            'motivo_bloqueo' => 'Motivo Bloqueo',
            'cerrado_comentar' => 'Cerrado Comentar',
            'usuario_creador_id' => 'Usuario Creador ID',
            'fecha_creacion' => 'Fecha Creacion',
            'usuario_modificador_id' => 'Usuario Modificador ID',
            'fecha_modificacion' => 'Fecha Modificacion',
            
        ];
    }

    /**
     * Gets query for [[Anuncios]].
     *
     * @return \yii\db\ActiveQuery|AnunciosQuery
     */
    public function getAnuncios()
    {
        return $this->hasMany(Anuncios::class, ['oferta_id' => 'id']);
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::class, ['id' => 'categoria_id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['oferta_id' => 'id']);
    }

    /**
     * Gets query for [[Incidencias]].
     *
     * @return \yii\db\ActiveQuery|IncidenciasQuery
     */
    public function getIncidencias()
    {
        return $this->hasMany(Incidencias::class, ['oferta_id' => 'id']);
    }

    /**
     * Gets query for [[OfertasEnlaces]].
     *
     * @return \yii\db\ActiveQuery|OfertasEnlacesQuery
     */
    public function getOfertasEnlaces()
    {
        return $this->hasMany(OfertasEnlaces::class, ['oferta_id' => 'id']);
    }

    /**
     * Gets query for [[OfertasEtiquetas]].
     *
     * @return \yii\db\ActiveQuery|OfertasEtiquetasQuery
     */
    public function getOfertasEtiquetas()
    {
        return $this->hasMany(OfertasEtiquetas::class, ['oferta_id' => 'id']);
    }

    /**
     * Gets query for [[OfertasImagenes]].
     *
     * @return \yii\db\ActiveQuery|OfertasImagenesQuery
     */
    public function getOfertasImagenes()
    {
        return $this->hasMany(OfertasImagenes::class, ['oferta_id' => 'id']);
    }

    /**
     * Gets query for [[OfertasValoraciones]].
     *
     * @return \yii\db\ActiveQuery|OfertasValoracionesQuery
     */
    public function getOfertasValoraciones()
    {
        return $this->hasMany(OfertasValoraciones::class, ['oferta_id' => 'id']);
    }

    /**
     * Gets query for [[Proveedor]].
     *
     * @return \yii\db\ActiveQuery|ProveedoresQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedores::class, ['id' => 'proveedor_id']);
    }

    /**
     * Gets query for [[Seguimientos]].
     *
     * @return \yii\db\ActiveQuery|SeguimientosQuery
     */
    public function getSeguimientos()
    {
        return $this->hasMany(Seguimientos::class, ['oferta_id' => 'id']);
    }

    /**
     * Gets query for [[UsuarioCreador]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUsuarioCreador()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_creador_id']);
    }

    /**
     * Gets query for [[UsuarioModificador]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUsuarioModificador()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'usuario_modificador_id']);
    }

    public static function listaEstadosTerminacion()
    {
        return [
            'finalizada' => 'Finalizada',
            'cancelada' => 'Cancelada',
            'en_curso' => 'En curso',
        ];
    }
    
    public static function listaClasesBloqueo()
    {
        return [
            'fraude' => 'Fraude',
            'contenido_inapropiado' => 'Contenido inapropiado',
            'otros' => 'Otros',
        ];
    }
    

    /**
     * Gets query for [[Zona]].
     *
     * @return \yii\db\ActiveQuery|ZonasQuery
     */
    public function getZona()
    {
        return $this->hasOne(Zonas::class, ['id' => 'zona_id']);
    }


    public function getSeguidores()
{
    return $this->hasMany(Seguimientos::class, ['oferta_id' => 'id']);
}
    /**
     * {@inheritdoc}
     * @return OfertasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OfertasQuery(get_called_class());
    }

    public function getPatrocinador()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'patrocinador_id']);
    }

    // Método para asignar un patrocinador
    public function asignarPatrocinador($usuarioId)
    {
        $this->patrocinador_id = $usuarioId;
        return $this->save();
    }

}
