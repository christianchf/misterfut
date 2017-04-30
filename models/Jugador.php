<?php

namespace app\models;

/**
 * This is the model class for table "jugadores".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $fecha_nac
 * @property string $dorsal
 * @property integer $id_posicion
 *
 * @property EstadisticasJugador[] $estadisticasJugadors
 * @property Posiciones $idPosicion
 */
class Jugador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jugadores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha_nac', 'dorsal', 'id_posicion'], 'required'],
            [['fecha_nac'], 'safe'],
            [['dorsal'], 'number'],
            [['id_posicion'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['id_posicion'], 'exist', 'skipOnError' => true, 'targetClass' => Posicion::className(), 'targetAttribute' => ['id_posicion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'fecha_nac' => 'Fecha Nac',
            'dorsal' => 'Dorsal',
            'id_posicion' => 'Id Posicion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadisticasJugadors()
    {
        return $this->hasMany(EstadisticasJugador::className(), ['id_jugador' => 'id'])->inverseOf('idJugador');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPosicion()
    {
        return $this->hasOne(Posicion::className(), ['id' => 'id_posicion'])->inverseOf('jugadors');
    }
}
