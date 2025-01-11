<?

namespace app\models;

use Yii;

/**
 * This is the model class for table "ofertas".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descripcion
 * @property float $precio_actual
 * @property float $precio_original
 * @property int $estado
 * @property int $categoria_id
 */
class Ofertas extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'ofertas';
    }

    public function rules()
    {
        return [
            [['titulo', 'descripcion', 'precio_actual', 'precio_original', 'estado', 'categoria_id'], 'required'],
            [['precioActual', 'precioOriginal'], 'number'],
            [['estado', 'categoria_id'], 'integer'],
            [['titulo', 'descripcion'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Título',
            'descripcion' => 'Descripción',
            'precio_actual' => 'Precio Actual',
            'precio_original' => 'Precio Original',
            'estado' => 'Estado',
            'categoria_id' => 'Categoría',
        ];
    }

    /**
     * Relación con Categorías.
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::class, ['id' => 'categoria_id']);
    }
}
