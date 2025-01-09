<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comentario;

/**
 * ComentarioSearch represents the model behind the search form of `app\models\Comentario`.
 */
class ComentarioSearch extends Comentario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'oferta_id', 'comentario_origen_id', 'cerrado', 'denuncias', 'bloqueado', 'usuario_id'], 'integer'],
            [['texto', 'fecha_primer_denuncia', 'motivo_denuncia', 'fecha_bloqueo', 'motivo_bloqueo', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
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
        $query = Comentario::find();

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
            'oferta_id' => $this->oferta_id,
            'comentario_origen_id' => $this->comentario_origen_id,
            'cerrado' => $this->cerrado,
            'denuncias' => $this->denuncias,
            'fecha_primer_denuncia' => $this->fecha_primer_denuncia,
            'bloqueado' => $this->bloqueado,
            'fecha_bloqueo' => $this->fecha_bloqueo,
            'usuario_id' => $this->usuario_id,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        $query->andFilterWhere(['like', 'texto', $this->texto])
            ->andFilterWhere(['like', 'motivo_denuncia', $this->motivo_denuncia])
            ->andFilterWhere(['like', 'motivo_bloqueo', $this->motivo_bloqueo]);

        return $dataProvider;
    }
}
