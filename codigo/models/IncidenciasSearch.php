<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Incidencia;

/**
 * IncidenciasSearch represents the model behind the search form of `app\models\Incidencia`.
 */
class IncidenciasSearch extends Incidencia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usuario_origen_id', 'oferta_id', 'comentario_id'], 'integer'],
            [['fecha_hora', 'clase', 'texto', 'fecha_lectura', 'fecha_aceptado'], 'safe'],
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
        $query = Incidencia::find();

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
            'fecha_hora' => $this->fecha_hora,
            'usuario_origen_id' => $this->usuario_origen_id,
            'oferta_id' => $this->oferta_id,
            'comentario_id' => $this->comentario_id,
            'fecha_lectura' => $this->fecha_lectura,
            'fecha_aceptado' => $this->fecha_aceptado,
        ]);

        $query->andFilterWhere(['like', 'clase', $this->clase])
            ->andFilterWhere(['like', 'texto', $this->texto]);

        return $dataProvider;
    }
}
