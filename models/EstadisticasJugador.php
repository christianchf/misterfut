<?php

namespace app\models;

/**
 * This is the model class for table "estadisticas_jugador".
 *
 * @property integer $id_temporada
 * @property integer $id_jugador
 * @property integer $id_equipo
 * @property string $partidos_jugados
 * @property string $goles_marcados
 * @property string $goles_encajados
 * @property string $asistencias
 * @property string $goles_por_partido
 *
 * @property Equipos $idEquipo
 * @property Jugadores $idJugador
 * @property Temporadas $idTemporada
 */
class EstadisticasJugador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estadisticas_jugador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_temporada', 'id_jugador', 'id_equipo'], 'required'],
            [['id_temporada', 'id_jugador', 'id_equipo'], 'integer'],
            [['partidos_jugados', 'goles_marcados', 'goles_encajados', 'asistencias', 'goles_por_partido'], 'number'],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['id_equipo' => 'id']],
            [['id_jugador'], 'exist', 'skipOnError' => true, 'targetClass' => Jugador::className(), 'targetAttribute' => ['id_jugador' => 'id']],
            [['id_temporada'], 'exist', 'skipOnError' => true, 'targetClass' => Temporada::className(), 'targetAttribute' => ['id_temporada' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_temporada' => 'Id Temporada',
            'id_jugador' => 'Id Jugador',
            'id_equipo' => 'Id Equipo',
            'partidos_jugados' => 'Partidos Jugados',
            'goles_marcados' => 'Goles Marcados',
            'goles_encajados' => 'Goles Encajados',
            'asistencias' => 'Asistencias',
            'goles_por_partido' => 'Goles Por Partido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEquipo()
    {
        return $this->hasOne(Equipo::className(), ['id' => 'id_equipo'])->inverseOf('estadisticasJugadors');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJugador()
    {
        return $this->hasOne(Jugador::className(), ['id' => 'id_jugador'])->inverseOf('estadisticasJugadors');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTemporada()
    {
        return $this->hasOne(Temporada::className(), ['id' => 'id_temporada'])->inverseOf('estadisticasJugadors');
    }
}
