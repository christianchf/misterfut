<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jugadores".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $fecha_nac
 * @property string $dorsal
 * @property string $partidos_jugados
 * @property string $goles_marcados
 * @property string $goles_encajados
 * @property string $asistencias
 * @property integer $id_equipo
 * @property integer $id_posicion
 *
 * @property Equipos $idEquipo
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
            [['nombre', 'fecha_nac', 'dorsal', 'id_equipo', 'id_posicion'], 'required'],
            [['fecha_nac'], 'safe'],
            [['dorsal', 'partidos_jugados', 'goles_marcados', 'goles_encajados', 'asistencias'], 'number'],
            [['id_equipo', 'id_posicion'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['id_equipo' => 'id']],
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
            'fecha_nac' => 'Fecha Nacimiento',
            'dorsal' => 'Dorsal',
            'partidos_jugados' => 'PJ',
            'goles_marcados' => 'Goles Marcados',
            'goles_encajados' => 'Goles Encajados',
            'asistencias' => 'Asistencias',
            'id_equipo' => 'Equipo',
            'id_posicion' => 'Posición',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipo::className(), ['id' => 'id_equipo'])->inverseOf('plantilla');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosicion()
    {
        return $this->hasOne(Posicion::className(), ['id' => 'id_posicion'])->inverseOf('jugadores');
    }
}
