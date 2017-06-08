<?php

use app\models\Usuario;

class VerEquipoCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(Usuario::findOne(1));
        $I->amOnRoute('equipos/view', ['id' => 1]);
    }
    public function abrirCrearEquipo(FunctionalTester $I)
    {
        $I->see('Real Madrid', 'h1');
        $I->seeElement('ul', ['id' => 'pestanias']);
        $I->seeElement('table', ['id' => 'detailEquipo']);
        $I->see('Estadísticas', 'h3');
        $I->seeElement('table', ['id' => 'statsEquipo']);
    }
}
