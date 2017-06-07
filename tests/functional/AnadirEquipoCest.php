<?php

use app\models\Usuario;

class AnadirEquipoCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(Usuario::findOne(1));
        $I->amOnPage(['equipos/create']);
    }

    public function abrirCrearEquipo(FunctionalTester $I)
    {
        $I->see('Añadir Equipo', 'h1');
    }
}
