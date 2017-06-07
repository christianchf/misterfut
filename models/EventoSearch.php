<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Evento;

/**
 * EventoSearch representa el modelo para el formulario de búsqueda sobre `app\models\Evento`.
 */
class EventoSearch extends Evento
{
    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['id', 'id_equipo'], 'integer'],
            [['tipo', 'nombre', 'descripcion', 'fecha_inicio', 'fecha_fin'], 'safe'],
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
     * Crea una instancia de data provider con la consulta de búsqueda aplicada.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Evento::find()->where(['id_equipo' => Yii::$app->request->get('idEquipo')]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => ['fecha_inicio' => SORT_ASC],
            'attributes' => [
                'tipo',
                'nombre',
                'fecha_inicio',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_inicio,
            'id_equipo' => $this->id_equipo,
        ]);

        $query->andFilterWhere(['ilike', 'tipo', $this->tipo])
            ->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
