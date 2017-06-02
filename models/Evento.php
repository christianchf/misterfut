<?php

namespace app\models;

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
            [['tipo', 'nombre', 'fecha_inicio', 'hora_inicio', 'fecha_fin', 'hora_fin', 'id_equipo'], 'required'],
            [['descripcion'], 'string'],
            [['hora_inicio', 'hora_fin'], 'match', 'pattern' => '/^(0[1-9]|1\d|2[0-3]):([0-5]\d)(:[0-5]\d)?$/'],
            [['id_equipo'], 'integer'],
            [['tipo', 'nombre'], 'string', 'max' => 100],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['id_equipo' => 'id']],
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
}
