<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Equipo;

/**
 * EquipoSearch represents the model behind the search form about `app\models\Equipo`.
 */
class EquipoSearch extends Equipo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario'], 'integer'],
            [['nombre', 'temporada'], 'safe'],
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
        $query = Equipo::find()->where(['id_usuario' => Yii::$app->user->id])->orderBy('temporada desc');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'nombre',
                // 'partidosJugados' => [
                //     'asc' => ['partidos_ganados' => SORT_ASC, 'partidos_empatados' => SORT_ASC, 'partidos_perdidos' => SORT_ASC],
                //     'desc' => ['partidos_ganados' => SORT_DESC, 'partidos_empatados' => SORT_DESC, 'partidos_perdidos' => SORT_DESC],
                //     'label' => 'PJ',
                //     'default' => SORT_ASC,
                // ],
                'partidos_ganados',
                'partidos_empatados',
                'partidos_perdidos',
                'goles_a_favor',
                'goles_en_contra',
                'temporada',
            ]
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
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'temporada', $this->temporada]);

        return $dataProvider;
    }
}
