<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetPokemonTest extends WebTestCase
{
    use ApiTestCaseTrait;

    public function testGettingAPokemon(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/pokemon/pikachu');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHasHeader('Content-Type', 'application/json');
    }
}
