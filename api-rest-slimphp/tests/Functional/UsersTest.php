<?php

namespace Tests\Functional;

require __DIR__.'/../../src/users.php';

class UsersTest extends BaseTestCase
{
    public function testApiHelp()
    {
        $response = $this->runApp('GET', '/');

        //print_r((string) $response->getBody());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('help', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }

    public function testGetUsers()
    {
        $response = $this->runApp('GET', '/users');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('name', (string) $response->getBody());
        $this->assertContains('Juan', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testGetUser()
    {
        $response = $this->runApp('GET', '/users/1');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('name', (string) $response->getBody());
        $this->assertContains('Juan', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testSearchUsers()
    {
        $response = $this->runApp('GET', '/users/search/j');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('name', (string) $response->getBody());
        $this->assertContains('juan', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testCreateUser()
    {
        $response = $this->runApp('POST', '/users', array('name' => 'Esteban'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('name', (string) $response->getBody());
        $this->assertContains('Esteban', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testUpdateUser()
    {
        $response = $this->runApp('PUT', '/users/4', array('name' => 'Tommy'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('name', (string) $response->getBody());
        $this->assertContains('Tommy', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testDeleteUser()
    {
        $response = $this->runApp('DELETE', '/users/3');

//        print_r((string) $response->getBody());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('success', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }
}