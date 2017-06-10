<?php

namespace app\models;

use DateTime;

/**
 * Este es el modelo para la tabla "eventos".
 *
 * @property integer $id
 * @property string $tipo
 * @property string $nombre
 * @property string $descripcion
 * @property string $fecha_inicio
 * @property string $hora_inicio
 * @property string $fecha_fin
 * @property string $hora_fin
 * @property integer $id_equipo
 *
 * @property Equipos $idEquipo
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * Declara el nombre de la tabla de la base de datos asociada con esta clase.
     * @return string El nombre de la tabla.
     */
    public static function tableName()
    {
        return 'eventos';
    }

    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['tipo', 'nombre', 'id_equipo'], 'required'],
            [['descripcion'], 'string'],
            [['id_equipo'], 'integer'],
            [['tipo', 'nombre'], 'string', 'max' => 100],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['id_equipo' => 'id']],
            [['fecha_inicio', 'fecha_fin'], 'validarFechas'],
            [['hora_inicio', 'hora_fin'], 'validarHoras'],
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
            'tipo' => 'Tipo',
            'nombre' => 'Título',
            'descripcion' => 'Descripción (opcional)',
            'fecha_inicio' => 'Fecha de inicio',
            'hora_inicio' => 'Hora de inicio',
            'fecha_fin' => 'Fecha de fin',
            'hora_fin' => 'Hora de fin',
            'id_equipo' => 'Id Equipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEquipo()
    {
        return $this->hasOne(Equipo::className(), ['id' => 'id_equipo'])->inverseOf('eventos');
    }

    /**
     * Comprueba que la fecha de inicio sea anterior o igual a la fecha de fin.
     * @param mixed $attribute
     * @param mixed $params
     */
    public function validarFechas($attribute, $params)
    {
        $fechaInicio = new DateTime($this->fecha_inicio);
        $fechaFin = new DateTime($this->fecha_fin);

        if ($fechaInicio > $fechaFin) {
            $this->addError($attribute, 'La fecha de inicio debe ser anterior o igual a la fecha de fin.');
        }
    }

    /**
     * Comprueba que la hora de inicio sea anterior o igual a la hora de fin, en
     * el caso de que la fecha de inicio y la fecha de fin sean iguales.
     * @param mixed $attribute
     * @param mixed $params
     */
    public function validarHoras($attribute, $params)
    {
        $fechaInicio = new DateTime($this->fecha_inicio);
        $fechaFin = new DateTime($this->fecha_fin);
        $horaInicio = new DateTime($this->hora_inicio);
        $horaFin = new DateTime($this->hora_fin);

        if ($fechaInicio == $fechaFin) {
            if ($horaInicio > $horaFin) {
                $this->addError($attribute, 'La hora de inicio debe ser anterior o igual a la hora de fin.');
            }
        }
    }
}
