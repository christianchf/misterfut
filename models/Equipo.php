<?php

namespace app\models;

/**
 * This is the model class for table "equipos".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $id_usuario
 * @property string $created_at
 *
 * @property Usuarios $idUsuario
 * @property EstadisticasEquipo[] $estadisticasEquipos
 * @property Temporadas[] $idTemporadas
 * @property EstadisticasJugador[] $estadisticasJugadors
 * @property Eventos[] $eventos
 */
class Equipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['nombre'], 'unique'],
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
            'nombre' => 'Nombre',
            'id_usuario' => 'Usuario',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario'])->inverseOf('equipos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadisticasEquipos()
    {
        return $this->hasMany(EstadisticasEquipo::className(), ['id_equipo' => 'id'])->inverseOf('idEquipo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTemporadas()
    {
        return $this->hasMany(Temporada::className(), ['id' => 'id_temporada'])->viaTable('estadisticas_equipo', ['id_equipo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadisticasJugadors()
    {
        return $this->hasMany(EstadisticasJugador::className(), ['id_equipo' => 'id'])->inverseOf('idEquipo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['id_equipo' => 'id'])->inverseOf('idEquipo');
    }
}
