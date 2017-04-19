<?php

namespace app\models;

/**
 * This is the model class for table "posiciones".
 *
 * @property integer $id
 * @property string $posicion
 *
 * @property Jugadores[] $jugadores
 */
class Posicion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posiciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['posicion'], 'required'],
            [['posicion'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
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
