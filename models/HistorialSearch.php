<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Equipo;

/**
 * HistorialSearch representa el modelo para el formulario de búsqueda sobre
 * `app\models\Equipo` en la vista histórica de cada equipo.
 */
class HistorialSearch extends Equipo
{
    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario'], 'integer'],
            [['temporada', 'partidos_jugados', 'partidos_ganados', 'partidos_empatados', 'partidos_perdidos', 'goles_a_favor', 'goles_en_contra'], 'safe'],
        ];
    }

    /**
     * Devuelve una lista de escenarios y los atributos activos correspondientes.
     * @return mixed
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Crea una instancia de data provider con una consulta del búsqueda aplicada.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Equipo::find()->where(['and', ['id_usuario' => Yii::$app->user->id], ['nombre' => $params['nombre']]]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => ['temporada' => SORT_DESC],
            'attributes' => [
                'partidos_jugados',
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
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'partidos_jugados' => $this->partidos_jugados,
            'partidos_ganados' => $this->partidos_ganados,
            'partidos_empatados' => $this->partidos_empatados,
            'partidos_perdidos' => $this->partidos_perdidos,
            'goles_a_favor' => $this->goles_a_favor,
            'goles_en_contra' => $this->goles_en_contra,
        ]);

        $query->andFilterWhere(['ilike', 'temporada', $this->temporada]);

        return $dataProvider;
    }
}
