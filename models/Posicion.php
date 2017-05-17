<?php

namespace app\models;

/**
 * Este es el modelo para la tabla "posiciones".
 *
 * @property integer $id
 * @property string $posicion
 *
 * @property Jugadores[] $jugadores
 */
class Posicion extends \yii\db\ActiveRecord
{
    /**
     * Declara el nombre de la tabla de la base de datos asociada con esta clase.
     * @return string El nombre de la tabla.
     */
    public static function tableName()
    {
        return 'posiciones';
    }

    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['posicion'], 'required'],
            [['posicion'], 'string', 'max' => 100],
        ];
    }

    /**
     * Devuelve las etiquetas de los atributos.
     * @return array Las etiquetas de los atributos
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'posicion' => 'Posicion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJugadores()
    {
        return $this->hasMany(Jugador::className(), ['id_posicion' => 'id'])->inverseOf('posicion');
    }
}
