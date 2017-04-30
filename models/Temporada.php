<?php

namespace app\models;

/**
 * This is the model class for table "temporadas".
 *
 * @property integer $id
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property integer $id_usuario
 *
 * @property EstadisticasEquipo[] $estadisticasEquipos
 * @property Equipos[] $idEquipos
 * @property EstadisticasJugador[] $estadisticasJugadors
 * @property Usuarios $idUsuario
 */
class Temporada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'temporadas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
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
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'id_usuario' => 'Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadisticasEquipos()
    {
        return $this->hasMany(EstadisticasEquipo::className(), ['id_temporada' => 'id'])->inverseOf('idTemporada');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEquipos()
    {
        return $this->hasMany(Equipo::className(), ['id' => 'id_equipo'])->viaTable('estadisticas_equipo', ['id_temporada' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadisticasJugadors()
    {
        return $this->hasMany(EstadisticasJugador::className(), ['id_temporada' => 'id'])->inverseOf('idTemporada');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario'])->inverseOf('temporadas');
    }
}
