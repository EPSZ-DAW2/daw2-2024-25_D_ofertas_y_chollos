<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ofertas;

/**
 * OfertasSearch represents the model behind the search form of `app\models\Ofertas`.
 */
class OfertasSearch extends Ofertas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'zona_id', 'categoria_id', 'proveedor_id', 'anuncio_destacado', 'denuncias', 'cerrado_comentar', 'usuario_creador_id', 'usuario_modificador_id'], 'integer'],
            [['titulo', 'descripcion', 'url_externa', 'fecha_inicio', 'fecha_fin', 'estado', 'fecha_primer_denuncia', 'motivo_denuncia', 'fecha_bloqueo', 'motivo_bloqueo', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['precio_actual', 'precio_original', 'descuento'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ofertas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'precio_actual' => $this->precio_actual,
            'precio_original' => $this->precio_original,
            'descuento' => $this->descuento,
            'zona_id' => $this->zona_id,
            'categoria_id' => $this->categoria_id,
            'proveedor_id' => $this->proveedor_id,
            'anuncio_destacado' => $this->anuncio_destacado,
            'denuncias' => $this->denuncias,
            'fecha_primer_denuncia' => $this->fecha_primer_denuncia,
            'fecha_bloqueo' => $this->fecha_bloqueo,
            'cerrado_comentar' => $this->cerrado_comentar,
            'usuario_creador_id' => $this->usuario_creador_id,
            'fecha_creacion' => $this->fecha_creacion,
            'usuario_modificador_id' => $this->usuario_modificador_id,
            'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'url_externa', $this->url_externa])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'motivo_denuncia', $this->motivo_denuncia])
            ->andFilterWhere(['like', 'motivo_bloqueo', $this->motivo_bloqueo]);

        return $dataProvider;
    }
}
