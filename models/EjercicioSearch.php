<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ejercicio;

/**
 * EjercicioSearch representa el modelo para el formulario de búsqueda sobre `app\models\Ejercicio`.
 */
class EjercicioSearch extends Ejercicio
{
    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario', 'num_jugadores'], 'integer'],
            [['nombre', 'tipo', 'descripcion', 'material', 'dimensiones'], 'safe'],
        ];
    }

    /**
     * Devuelve una lista de escenarios y los atributos activos correspondientes.
     * @return mixed
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = Ejercicio::find()->where(['id_usuario' => Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'num_jugadores' => $this->num_jugadores,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'tipo', $this->tipo])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'material', $this->material])
            ->andFilterWhere(['ilike', 'dimensiones', $this->dimensiones]);

        return $dataProvider;
    }
}
