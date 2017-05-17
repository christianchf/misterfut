<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Equipo;

/**
 * EquipoSearch representa el modelo para el formulario de búsqueda sobre `app\models\Equipo`.
 */
class EquipoSearch extends Equipo
{
    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario'], 'integer'],
            [['nombre', 'temporada', 'partidos_jugados', 'partidos_ganados', 'partidos_empatados', 'partidos_perdidos', 'goles_a_favor', 'goles_en_contra'], 'safe'],
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
     * Crea una instancia de dataprovider con la consulta de búsqueda aplicada.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Equipo::find()->where(['id_usuario' => Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => ['temporada' => SORT_DESC],
            'attributes' => [
                'nombre',
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

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'temporada', $this->temporada]);

        return $dataProvider;
    }
}
