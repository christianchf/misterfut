<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jugador;

/**
 * JugadorSearch representa el modelo para el formulario de búsqueda de `app\models\Jugador`.
 */
class JugadorSearch extends Jugador
{
    /**
     * @var string Descripción textual de la posición del jugador.
     */
    public $nombrePosicion;

    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['id', 'id_equipo', 'id_posicion'], 'integer'],
            [['nombre', 'fecha_nac', 'nombrePosicion', 'partidos_jugados', 'goles_marcados', 'asistencias', 'goles_por_partido'], 'safe'],
            [['dorsal'], 'number'],
            [['fecha_nac'], 'date', 'format'=>'php:Y-m-d'],
            [['fecha_nac'], 'default', 'value' => null],
            [['esta_lesionado'], 'boolean'],
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
     * Crea una instancia de data provider con una consulta de búsqueda aplicada.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Jugador::find()->where(['id_equipo' => Yii::$app->request->get('id_equipo')]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => ['nombrePosicion' => SORT_ASC, 'nombre' => SORT_ASC],
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
                'asistencias',
                'goles_por_partido',
                'fecha_nac',
                'esta_lesionado',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_nac' => $this->fecha_nac,
            'dorsal' => $this->dorsal,
            'id_equipo' => $this->id_equipo,
            'id_posicion' => $this->id_posicion,
            'partidos_jugados' => $this->partidos_jugados,
            'goles_marcados' => $this->goles_marcados,
            'asistencias' => $this->asistencias,
            'goles_por_partido' =>$this->goles_por_partido,
            'esta_lesionado' => $this->esta_lesionado,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre]);

        $query->joinWith(['posicion' => function ($q) {
            $q->andFilterWhere(['ilike', 'posicion', $this->nombrePosicion]);
        }]);

        return $dataProvider;
    }
}
