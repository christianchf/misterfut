<?php

namespace app\models;

/**
 * This is the model class for table "estadisticas_equipo".
 *
 * @property integer $id_temporada
 * @property integer $id_equipo
 * @property string $partidos_jugados
 * @property string $partidos_ganados
 * @property string $partidos_empatados
 * @property string $partidos_perdidos
 * @property string $goles_a_favor
 * @property string $goles_en_contra
 *
 * @property Equipos $idEquipo
 * @property Temporadas $idTemporada
 */
class EstadisticasEquipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estadisticas_equipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_temporada', 'id_equipo'], 'required'],
            [['id_temporada', 'id_equipo'], 'integer'],
            [['partidos_jugados', 'partidos_ganados', 'partidos_empatados', 'partidos_perdidos', 'goles_a_favor', 'goles_en_contra'], 'number'],
            [['id_equipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['id_equipo' => 'id']],
            [['id_temporada'], 'exist', 'skipOnError' => true, 'targetClass' => Temporada::className(), 'targetAttribute' => ['id_temporada' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_temporada' => 'Id Temporada',
            'id_equipo' => 'Id Equipo',
            'partidos_jugados' => 'Partidos Jugados',
            'partidos_ganados' => 'Partidos Ganados',
            'partidos_empatados' => 'Partidos Empatados',
            'partidos_perdidos' => 'Partidos Perdidos',
            'goles_a_favor' => 'Goles A Favor',
            'goles_en_contra' => 'Goles En Contra',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEquipo()
    {
        return $this->hasOne(Equipo::className(), ['id' => 'id_equipo'])->inverseOf('estadisticasEquipos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTemporada()
    {
        return $this->hasOne(Temporada::className(), ['id' => 'id_temporada'])->inverseOf('estadisticasEquipos');
    }
}
