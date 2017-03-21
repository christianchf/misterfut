<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $partidos_ganados
 * @property string $partidos_empatados
 * @property string $partidos_perdidos
 * @property string $goles_a_favor
 * @property string $goles_en_contra
 * @property integer $id_usuario
 *
 * @property Usuarios $idUsuario
 * @property Jugadores[] $jugadores
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
            [['partidos_ganados', 'partidos_empatados', 'partidos_perdidos', 'goles_a_favor', 'goles_en_contra'], 'number'],
            [['id_usuario'], 'integer'],
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
            'nombre' => 'Equipo',
            'partidosJugados' => 'PJ',
            'partidos_ganados' => 'PG',
            'partidos_empatados' => 'PE',
            'partidos_perdidos' => 'PP',
            'goles_a_favor' => 'GF',
            'goles_en_contra' => 'GC',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario'])->inverseOf('equipos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlantilla()
    {
        return $this->hasMany(Jugador::className(), ['id_equipo' => 'id'])->inverseOf('equipo');
    }

    public function getPartidosJugados()
    {
        return $this->partidos_ganados + $this->partidos_empatados + $this->partidos_perdidos;
    }
}
