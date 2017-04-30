<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EstadisticasEquipo;

/**
 * EstadisticasEquipoSearch represents the model behind the search form about `app\models\EstadisticasEquipo`.
 */
class EstadisticasEquipoSearch extends EstadisticasEquipo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_temporada', 'id_equipo'], 'integer'],
            [['partidos_jugados', 'partidos_ganados', 'partidos_empatados', 'partidos_perdidos', 'goles_a_favor', 'goles_en_contra'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = EstadisticasEquipo::find();

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
            'id_temporada' => $this->id_temporada,
            'id_equipo' => $this->id_equipo,
            'partidos_jugados' => $this->partidos_jugados,
            'partidos_ganados' => $this->partidos_ganados,
            'partidos_empatados' => $this->partidos_empatados,
            'partidos_perdidos' => $this->partidos_perdidos,
            'goles_a_favor' => $this->goles_a_favor,
            'goles_en_contra' => $this->goles_en_contra,
        ]);

        return $dataProvider;
    }
}
