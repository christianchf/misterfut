<?php

use app\models\Usuario;

class VistaEquipoCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(Usuario::findOne(1));
        $I->amOnRoute('eventos/index', ['idEquipo' => 1]);
    }
    public function abrirCalendario(FunctionalTester $I)
    {
        $I->see('Calendario Real Madrid (2016/2017)', 'h1');
        $I->seeElement('div', ['id' => 'calendar']);
        $I->see('Añadir Evento', 'a');
    }
}
