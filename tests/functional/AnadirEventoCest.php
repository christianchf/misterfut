<?php

use app\models\Usuario;

class ModificarEventoCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(Usuario::findOne(1));
        $I->amOnRoute('eventos/update', ['id' => 3]);
    }
    public function abrirCrearEvento(FunctionalTester $I)
    {
        $I->see('Modificar Evento: Entrenamiento: Entrenamiento físico', 'h1');
    }
    public function enviarFormularioIncorrecto(\FunctionalTester $I)
    {
        $I->submitForm('#anadirEvento', [
            'Evento[tipo]' => 'Entrenamiento',
            'Evento[titulo]' => '',
            'Evento[fecha_inicio]' => '2017-06-03',
            'Evento[hora_inicio]' => '09:00',
            'Evento[fecha_fin]' => '2017-06-03',
            'Evento[hora_fin]' => '10:00',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Título no puede estar vacío.');
    }
    public function enviarFormularioCorrecto(\FunctionalTester $I)
    {
        $I->submitForm('#anadirEvento', [
            'Evento[tipo]' => 'Entrenamiento',
            'Evento[titulo]' => 'Entrenamiento físico',
            'Evento[fecha_inicio]' => '2017-06-03',
            'Evento[hora_inicio]' => '09:00',
            'Evento[fecha_fin]' => '2017-06-03',
            'Evento[hora_fin]' => '11:00',
        ]);
        $I->dontSeeElement('#anadirEvento');
        $I->see('Calendario Real Madrid (2016/2017)', 'h1');
    }
}
