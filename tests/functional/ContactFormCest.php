<?php

class ContactFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/contact']);
    }

    public function openContactPage(\FunctionalTester $I)
    {
        $I->see('Contacto', 'h1');
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#contact-form', []);
        $I->expectTo('see validations errors');
        $I->see('Contacto', 'h1');
        $I->see('Nombre no puede estar vacío.');
        $I->see('Email no puede estar vacío.');
        $I->see('Asunto no puede estar vacío.');
        $I->see('Cuerpo no puede estar vacío.');
        $I->see('El código de verificación es incorrecto.');
    }

    public function submitFormWithIncorrectEmail(\FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester.email',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->expectTo('Email no es una dirección de correo válida.');
        $I->dontSee('Nombre no puede estar vacío.', '.help-inline');
        $I->see('Email no es una dirección de correo válida.');
        $I->dontSee('Asunto no puede estar vacío.', '.help-inline');
        $I->dontSee('Cuerpo no puede estar vacío.', '.help-inline');
        $I->dontSee('El código de verificación es incorrecto.', '.help-inline');
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->seeEmailIsSent();
        $I->dontSeeElement('#contact-form');
        $I->see('Gracias por contactar con nosotros. Le responderemos con la mayor brevedad posible.');
    }
}
