<?php
// auteur: studentnaam
// functie: definitie class Artikel

namespace Bas\classes;

use Bas\classes\Database;
use Bas\classes\TableHelper;

class Artikel extends Database {
    public $artId;
    public $artOmschrijving;
    public $artInkoop;
    public $artVerkoop;
    public $artVoorraad;
    public $artMinVoorraad;
    public $artMaxVoorraad;
    public $artLocatie;

    private $table_name = "artikel";

    public function __construct() {
        parent::__construct();
    }

    public function crudArtikel() : void {
        $lijst = $this->getArtikelen();

        if (!empty($lijst)) {
            $this->showTable($lijst);
        } else {
            echo "Geen artikelen gevonden.";
        }
    }

    public function getArtikelen() : array {
        $sql = "SELECT artId, artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie
                FROM $this->table_name
                ORDER BY artId";

        $stmt = self::$conn->query($sql);
        return $stmt->fetchAll();
    }

    public function getArtikel(int $artId) : array {
        $sql = "SELECT artId, artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie
                FROM $this->table_name
                WHERE artId = :artId";

        $stmt = self::$conn->prepare($sql);
        $stmt->execute([':artId' => $artId]);

        $row = $stmt->fetch();
        return $row ? $row : [];
    }

    public function dropDownArtikel($row_selected = -1) : void {
        $lijst = $this->getArtikelen();

        echo "<label for='Artikel'>Choose an artikel:</label>";
        echo "<select name='artId'>";

        foreach ($lijst as $row) {
            if ($row_selected == $row["artId"]) {
                echo "<option value='{$row['artId']}' selected='selected'>{$row['artOmschrijving']}</option>\n";
            } else {
                echo "<option value='{$row['artId']}'>{$row['artOmschrijving']}</option>\n";
            }
        }

        echo "</select>";
    }

    public function showTable($lijst) : void {
        $txt = "<table>";
        $txt .= TableHelper::getTableHeader($lijst[0]);

        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . $row["artOmschrijving"] . "</td>";
            $txt .= "<td>" . $row["artInkoop"] . "</td>";
            $txt .= "<td>" . $row["artVerkoop"] . "</td>";
            $txt .= "<td>" . $row["artVoorraad"] . "</td>";
            $txt .= "<td>" . $row["artMinVoorraad"] . "</td>";
            $txt .= "<td>" . $row["artMaxVoorraad"] . "</td>";
            $txt .= "<td>" . $row["artLocatie"] . "</td>";

            $txt .= "<td>
                <form method='post' action='update.php?artId={$row['artId']}'>
                    <button name='update'>Wzg</button>
                </form>
            </td>";

            $txt .= "<td>
                <form method='post' action='delete.php?artId={$row['artId']}'>
                    <button name='verwijderen'>Verwijderen</button>
                </form>
            </td>";

            $txt .= "</tr>";
        }

        $txt .= "</table>";
        echo $txt;
    }

    public function deleteArtikel(int $artId) : bool {
        $sql = "DELETE FROM $this->table_name WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);

        return $stmt->execute([
            ':artId' => $artId
        ]);
    }

    public function updateArtikel($row) : bool {
        $sql = "UPDATE $this->table_name
                SET artOmschrijving = :artOmschrijving,
                    artInkoop = :artInkoop,
                    artVerkoop = :artVerkoop,
                    artVoorraad = :artVoorraad,
                    artMinVoorraad = :artMinVoorraad,
                    artMaxVoorraad = :artMaxVoorraad,
                    artLocatie = :artLocatie
                WHERE artId = :artId";

        $stmt = self::$conn->prepare($sql);

        return $stmt->execute([
            ':artId' => $row['artId'],
            ':artOmschrijving' => $row['artOmschrijving'],
            ':artInkoop' => $row['artInkoop'],
            ':artVerkoop' => $row['artVerkoop'],
            ':artVoorraad' => $row['artVoorraad'],
            ':artMinVoorraad' => $row['artMinVoorraad'],
            ':artMaxVoorraad' => $row['artMaxVoorraad'],
            ':artLocatie' => $row['artLocatie']
        ]);
    }

    private function BepMaxArtikelId() : int {
        $sql = "SELECT MAX(artId) + 1 FROM $this->table_name";
        $maxId = self::$conn->query($sql)->fetchColumn();

        if ($maxId === null) {
            return 1;
        }

        return (int)$maxId;
    }

    public function insertArtikel($row) : bool {
        $artId = $this->BepMaxArtikelId();

        $sql = "INSERT INTO $this->table_name
                (artId, artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
                VALUES (:artId, :artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";

        $stmt = self::$conn->prepare($sql);

        return $stmt->execute([
            ':artId' => $artId,
            ':artOmschrijving' => $row['artOmschrijving'],
            ':artInkoop' => $row['artInkoop'],
            ':artVerkoop' => $row['artVerkoop'],
            ':artVoorraad' => $row['artVoorraad'],
            ':artMinVoorraad' => $row['artMinVoorraad'],
            ':artMaxVoorraad' => $row['artMaxVoorraad'],
            ':artLocatie' => $row['artLocatie']
        ]);
    }
}
?>