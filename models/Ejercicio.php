<?php

namespace app\models;

/**
 * This is the model class for table "ejercicios".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property string $nombre
 * @property string $tipo
 * @property string $descripcion
 * @property integer $num_jugadores
 * @property string $material
 * @property string $dimensiones
 *
 * @property Usuarios $idUsuario
 */
class Ejercicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ejercicios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'num_jugadores'], 'integer'],
            [['nombre', 'tipo', 'descripcion'], 'required'],
            [['descripcion', 'material'], 'string'],
            [['nombre', 'tipo', 'dimensiones'], 'string', 'max' => 100],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'tipo' => 'Tipo',
            'descripcion' => 'Descripción',
            'num_jugadores' => 'Número de jugadores',
            'material' => 'Material necesario',
            'dimensiones' => 'Dimensiones del campo',
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
