<?php

namespace App\Tests\Unitaires;

use App\Entity\Category;
use App\Entity\Wish;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testSomething(): void
    {
        $categorie = (new Category())
        ->setName("Sports");

        $this->assertEquals("Sports", $categorie->getName());
        $this->assertNotEquals("Couture", $categorie->getName());

        $this->assertNull($categorie->getId());
    }

    public function testWishes(): void
    {
        $categorie = (new Category())
            ->setName("Voyages");
        $this->assertCount(0, $categorie->getWishes());
        $categorie->addWish(new Wish());
        $this->assertCount(1, $categorie->getWishes());

    }
}
