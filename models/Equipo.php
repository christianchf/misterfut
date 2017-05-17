<?php

namespace app\models;

/**
 * Este es el modelo para la tabla "equipos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $partidos_jugados
 * @property string $partidos_ganados
 * @property string $partidos_empatados
 * @property string $partidos_perdidos
 * @property string $goles_a_favor
 * @property string $goles_en_contra
 * @property string $temporada
 * @property integer $id_usuario
 *
 * @property Usuarios $idUsuario
 * @property Jugadores[] $jugadores
 * @property Eventos[] $eventos
 */
class Equipo extends \yii\db\ActiveRecord
{
    /**
     * Declara el nombre de la tabla de la base de datos asociada con esta clase.
     * @return string El nombre de la tabla.
     */
    public static function tableName()
    {
        return 'equipos';
    }

    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['nombre', 'temporada', 'id_usuario'], 'required'],
            [['partidos_jugados', 'partidos_ganados', 'partidos_empatados', 'partidos_perdidos', 'goles_a_favor', 'goles_en_contra'], 'number'],
            [['id_usuario'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['temporada'], 'string', 'max' => 10],
            [['nombre', 'temporada', 'id_usuario'], 'unique', 'targetAttribute' => ['nombre', 'temporada', 'id_usuario'], 'message' => 'La combinación de nombre y temporada ya ha sido utilizada por usted.'],
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
            'nombre' => 'Equipo',
            'partidos_jugados' => 'PJ',
            'partidos_ganados' => 'PG',
            'partidos_empatados' => 'PE',
            'partidos_perdidos' => 'PP',
            'goles_a_favor' => 'GF',
            'goles_en_contra' => 'GC',
            'temporada' => 'Temporada',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['id_equipo' => 'id'])->inverseOf('idEquipo');
    }

    /**
     * Calcula y devuelve el número de partidos jugados por el equipo.
     * @return int Número de partidos jugados
     */
    public function getPartidosJugados()
    {
        $this->partidos_jugados =  ($this->partidos_ganados + $this->partidos_empatados + $this->partidos_perdidos);
        $this->save();

        return $this->partidos_jugados;
    }
}
