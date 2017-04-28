<?php

namespace app\models;

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
 * @property string $goles_por_partido
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
            [['dorsal', 'partidos_jugados', 'goles_marcados', 'goles_encajados', 'asistencias', 'goles_por_partido'], 'number'],
            [['id_equipo', 'id_posicion'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['id_equipo' => 'id']],
            [['id_posicion'], 'exist', 'skipOnError' => true, 'targetClass' => Posicion::className(), 'targetAttribute' => ['id_posicion' => 'id']],
            [['fecha_nac'], 'date', 'format'=>'php:Y-m-d'],
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
            'fecha_nac' => 'Fecha nacimiento',
            'dorsal' => 'Dorsal',
            'partidos_jugados' => 'Partidos jugados',
            'goles_marcados' => 'Goles marcados',
            'goles_encajados' => 'Goles encajados',
            'asistencias' => 'Asistencias',
            'id_equipo' => 'Equipo',
            'id_posicion' => 'Posición',
            'goles_por_partido' => 'Goles por partido',
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

    /**
     * Calcula y devuelve el número de goles por partido de un jugador.
     * @return int El número de goles por partido.
     */
    public function getGolesPorPartido()
    {
        if ($this->partidos_jugados == '0') {
            $this->goles_por_partido = 0;
        } else {
            $this->goles_por_partido = ($this->goles_marcados / $this->partidos_jugados);
        }
        $this->save();
        $this->refresh();

        return $this->goles_por_partido;
    }

    /**
     * Devuelve el nombre de la posición del jugador.
     * @return string El nombre de la posición
     */
    public function getNombrePosicion()
    {
        return $this->posicion->posicion;
    }
}
