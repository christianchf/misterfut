<?php

namespace app\models;

/**
 * Este es el modelo para la tabla "ejercicios".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property string $nombre
 * @property string $tipo
 * @property string $descripcion
 * @property string $num_jugadores
 * @property string $material
 * @property string $dimensiones
 *
 * @property Usuarios $idUsuario
 */
class Ejercicio extends \yii\db\ActiveRecord
{
    /**
     * Declara el nombre de la tabla de la base de datos asociada con esta clase.
     * @return string El nombre de la tabla.
     */
    public static function tableName()
    {
        return 'ejercicios';
    }

    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'integer'],
            [['nombre', 'tipo', 'descripcion'], 'required'],
            [['descripcion', 'material'], 'string'],
            [['nombre', 'tipo', 'dimensiones', 'num_jugadores'], 'string', 'max' => 100],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
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
            'id_usuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'tipo' => 'Tipo',
            'descripcion' => 'Descripción',
            'num_jugadores' => 'Número de jugadores (opcional)',
            'material' => 'Material necesario (opcional)',
            'dimensiones' => 'Dimensiones del campo (opcional)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario'])->inverseOf('ejercicios');
    }
}
