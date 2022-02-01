<?php

namespace App\Tests\Integrations;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainTest extends WebTestCase
{
    public function testMain(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/home');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Tu');
    }
}
