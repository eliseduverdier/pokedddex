<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListPokemonsTest extends WebTestCase
{
    use ApiTestCaseTrait;

    public function testListingAllPokemons(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/pokemons');

        $this->assertResponseIsSuccessful();
    }
}
