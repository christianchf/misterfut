<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jugador;

/**
 * JugadorSearch represents the model behind the search form about `app\models\Jugador`.
 */
class JugadorSearch extends Jugador
{
    /**
     * Descripción textual de la posición del jugador.
     * @var string
     */
    public $nombrePosicion;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_equipo', 'id_posicion'], 'integer'],
            [['nombre', 'fecha_nac', 'nombrePosicion'], 'safe'],
            [['dorsal'], 'number'],
            [['fecha_nac'], 'date', 'format'=>'php:Y-m-d'],
            [['fecha_nac'], 'default', 'value' => null],
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
        $query = Jugador::find()->where(['id_equipo' => Yii::$app->request->get('id_equipo')])
            ->orderBy(['id_posicion' => SORT_ASC, 'nombre' => SORT_ASC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'nombrePosicion' => [
                    'asc' => ['id_posicion' => SORT_ASC],
                    'desc' => ['id_posicion' => SORT_DESC],
                    'label' => 'Posición',
                    'default' => SORT_ASC
                ],
                'nombre',
                'dorsal',
                'partidos_jugados',
                'goles_marcados',
                'goles_encajados',
                'asistencias',
                // 'golesPorPartido' => [
                //     'asc' => ['golesPorPartido' => SORT_ASC],
                //     'desc' => ['golesPorPartido' => SORT_DESC],
                //     'label' => 'Goles por partido',
                //     'default' => SORT_ASC,
                // ],
                'fecha_nac',
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
            'fecha_nac' => $this->fecha_nac,
            'dorsal' => $this->dorsal,
            'id_equipo' => $this->id_equipo,
            'id_posicion' => $this->id_posicion,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre]);

        $query->joinWith(['posicion' => function ($q) {
            $q->andFilterWhere(['ilike', 'posicion', $this->nombrePosicion]);
        }]);

        return $dataProvider;
    }
}
