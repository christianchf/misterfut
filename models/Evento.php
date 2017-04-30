<?php

namespace app\models;

/**
 * This is the model class for table "eventos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $fecha
 * @property integer $id_equipo
 *
 * @property Equipos $idEquipo
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eventos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha', 'id_equipo'], 'required'],
            [['descripcion'], 'string'],
            [['fecha'], 'safe'],
            [['id_equipo'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['id_equipo' => 'id']],
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
            'descripcion' => 'Descripcion',
            'fecha' => 'Fecha',
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
