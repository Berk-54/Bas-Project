<?php

use PHPUnit\Framework\TestCase;
use Bas\classes\Artikel;

require_once __DIR__ . '/../vendor/autoload.php';

class ArtikelTest extends TestCase
{
    public function testInsertArtikel()
    {
        $artikel = new Artikel();

        $result = $artikel->insertArtikel([
            'artOmschrijving' => 'TestArtikel',
            'artInkoop' => 1.50,
            'artVerkoop' => 2.50,
            'artVoorraad' => 10,
            'artMinVoorraad' => 2,
            'artMaxVoorraad' => 20,
            'artLocatie' => 'A1'
        ]);

        $this->assertTrue($result);
    }
}