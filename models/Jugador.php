<?php

namespace app\models;

use DateTime;

/**
 * Este el el modelo para la tabla "jugadores".
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
 * @property boolean $esta_lesionado
 * @property string $fecha_alta
 * @property boolean $esta_sancionado
 *
 * @property Equipos $idEquipo
 * @property Posiciones $idPosicion
 */
class Jugador extends \yii\db\ActiveRecord
{
    /**
     * Declara el nombre de la tabla de la base de datos asociada con esta clase.
     * @return string El nombre de la tabla.
     */
    public static function tableName()
    {
        return 'jugadores';
    }

    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha_nac', 'dorsal', 'id_equipo', 'id_posicion'], 'required'],
            [['fecha_nac','fecha_alta'], 'safe'],
            [['dorsal', 'partidos_jugados', 'goles_marcados', 'goles_encajados', 'asistencias', 'goles_por_partido'], 'number'],
            [['id_equipo', 'id_posicion'], 'integer'],
            [['esta_lesionado', 'esta_sancionado'], 'boolean'],
            [['nombre'], 'string', 'max' => 100],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['id_equipo' => 'id']],
            [['id_posicion'], 'exist', 'skipOnError' => true, 'targetClass' => Posicion::className(), 'targetAttribute' => ['id_posicion' => 'id']],
            [['fecha_nac'], 'date', 'format'=>'php:Y-m-d'],
            [['fecha_alta'], 'date', 'format'=>'php:Y-m-d'],
            [['fecha_alta'], 'required', 'when' => function () {
                return $this->esta_lesionado;
            }, 'whenClient' => 'function (attribute, value) {
                return $(".field-jugador-fecha_alta").is(":visible");
            }'],
            [['fecha_nac'], 'fechaValida'],

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
            'esta_lesionado' => 'Lesionado',
            'fecha_alta' => 'Fecha prevista de alta médica',
            'esta_sancionado' => 'Sancionado',
            'edad' => 'Edad',
            'diasLesion' => 'Dias restantes de lesión',
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

    /**
     * Devuelve la edad del jugador.
     * @return int La edad del jugador
     */
    public function getEdad()
    {
        $fechaActual = new DateTime();
        $fechaNac = new DateTime($this->fecha_nac);
        $edad = $fechaActual->diff($fechaNac)->y;

        return $edad;
    }

    /**
     * Devuelve el numero de dias de lesión que le quedan al jugador.
     * @return int El número de dias de lesión.
     */
    public function getDiasLesion()
    {
        $fechaActual = new DateTime(date('Y-m-d'));
        $fechaAlta = new DateTime($this->fecha_alta);
        $dias = $fechaAlta->diff($fechaActual)->days;

        return $dias;
    }

    /**
     * Comprueba si la fecha de nacimiento del jugador es válida.
     * @param  mixed $attribute
     * @param  mixed $params
     */
    public function fechaValida($attribute, $params)
    {
        $fechaNac = new DateTime($this->fecha_nac);
        $fechaActual = new DateTime(date('Y-m-d'));

        if ($fechaNac >= $fechaActual) {
            $this->addError($attribute, 'La fecha de nacimiento debe ser anterior o igual a la fecha actual.');
        }
    }
}
