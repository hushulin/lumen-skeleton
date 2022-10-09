<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function testDB()
    {
        $this->get('/test');
        $this->assertResponseOk();
    }

    public function testMakeOrder()
    {
        $this->get('/make-order');
        $this->assertResponseOk();
    }

    public function testUpdateOrder()
    {
        $this->get('/update-order');
        $this->assertResponseOk();
    }
}
