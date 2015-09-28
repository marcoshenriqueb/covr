<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function pode_registrar_mas_tem_que_confirmar()
    {
        $this->visit('cadastro')
             ->type('John', 'nome');
             ->type('Doe', 'sobrenome');
             ->type('john@example.com', 'email');
             ->type('password', 'password');
             ->type('password', 'password_confirmation');
             ->press('Cadastrar');

        $this->see()
    }
}
