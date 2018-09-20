<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends DuskTestCase
{
    use RefreshDatabase;
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Varius')
                    ->clickLink('Signup')
                    ->assertSee('Register')
                    ->type('name', 'Robert Smith')
                    ->type('email', 'bob@hotmail.com')
                    ->type('password', 'Password1!')
                    ->type('password_confirmation', 'Password1!')
                    ->press('Register')
                    ->assertPathIs('/dashboard')
                    ->pause(1000)
                    ->click('#profile_pic')
                    ->click('#logout')
                     ->assertPathIs('/')
                    ->clickLink('Login')
                    ->assertSee('Login')
                    ->type('email', 'bob@hotmail.com')
                    ->type('password', 'Password1!')
                    ->press('Login')
                    ->assertPathIs('/dashboard')
                    ->assertSee('Balance: 0 VoX')
                    ->clickLink('Ready to play? Load some VoX now')
                    ->assertPathIs('/deposit');  
        });
    }
}
