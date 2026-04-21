<?php

use PHPUnit\Framework\TestCase;
use Bas\classes\Database;
use Bas\classes\Klant;

require_once __DIR__ . '/../src/classes/Database.php';
require_once __DIR__ . '/../src/classes/Klant.php';

class KlantTest extends TestCase
{
    public function testInsertKlant()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $klant = new Klant($conn);

        $result = $klant->insert(
            "Test klant",
            "test@test.nl",
            "Teststraat 1",
            "1234AB",
            "Amsterdam"
        );

        $this->assertTrue($result);
    }
}