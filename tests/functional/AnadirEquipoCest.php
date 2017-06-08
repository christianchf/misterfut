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
    public function enviarFormularioVacio(\FunctionalTester $I)
    {
        $I->submitForm('#anadirEquipo', []);
        $I->expectTo('see validations errors');
        $I->see('Añadir Equipo', 'h1');
        $I->see('Equipo no puede estar vacío.');
        $I->see('Temporada no puede estar vacío.');
    }
    public function enviarFormularioIncorrecto(\FunctionalTester $I)
    {
        $I->submitForm('#anadirEquipo', [
            'Equipo[nombre]' => 'tester',
            'Equipo[temporada]' => 'tester',
        ]);
        $I->expectTo('see validations errors');
        $I->dontSee('Equipo no puede estar vacío.', '.help-inline');
        $I->see('Temporada no cumple el formato yyyy/yyyy.');
    }
    public function enviarFormularioValoresRepetidos(\FunctionalTester $I)
    {
        $I->submitForm('#anadirEquipo', [
            'Equipo[nombre]' => 'Real Madrid',
            'Equipo[temporada]' => '2016/2017',
        ]);
        $I->expectTo('see validations errors');
        $I->dontSee('Equipo no puede estar vacío.', '.help-inline');
        $I->dontSee('Temporada no puede estar vacío.', '.help-inline');
        $I->see('La combinación de nombre y temporada ya ha sido utilizada por usted.');
    }
    public function enviarFormularioCorrecto(\FunctionalTester $I)
    {
        $I->submitForm('#anadirEquipo', [
            'Equipo[nombre]' => 'tester',
            'Equipo[temporada]' => '2016/2017',
        ]);
        $I->dontSeeElement('#anadirEquipo');
    }
}
