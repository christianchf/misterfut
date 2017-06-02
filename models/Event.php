<?php

namespace app\models;

use yii\base\Model;

/**
 * Este es el modelo para mostrar los eventos en el calendario.
 *
 * @property integer $id
 */
class Event extends Model
{
    /**
     * @var int El id del evento que se muestra.
     */
    public $id;
    /**
     * @var string El título del evento que se muestra.
     */
    public $title;
    /**
     * @var date/time El momento de inicio del evento que se muestra.
     */
    public $start;
    /**
     * @var date/time El momento de fin del evento que se muestra.
     */
    public $end;
    /**
     * @var string La url que se visitara cuando se pulse sobre el evento que se
     *  muestra.
     */
    public $url;
    /**
     * @var bool Indica si el evento que se muestra es editable.
     */
    public $editable;
    /**
     * @var bool Anula la opción eventStartEditable principal para este evento
     *  único.
     */
    public $startEditable;
    /**
     * @var string Establece el color de fondo y el borde del evento que se muestra.
     */
    public $color;
    /**
     * @var bool
     */
    public $durationEditable;

    /**
     * Devuelve las reglas de validación de los atributos.
     * @return array Las reglas de validación.
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'start', 'end', 'url', 'color'], 'safe'],
            [['editable', 'startEditable', 'durationEditable'], 'boolean'],
        ];
    }
}
