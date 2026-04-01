<?php
// auteur: studentnaam
// functie: definitie class Klant

namespace Bas\classes;

use Bas\classes\Database;
use Bas\classes\TableHelper;

class Klant extends Database {
    public $klantId;
    public $klantemail = null;
    public $klantnaam;
    public $klantwoonplaats;
    private $table_name = "klant";

    public function __construct() {
        parent::__construct();
    }

    public function crudKlant() : void {
        $lijst = $this->getKlanten();

        if (!empty($lijst)) {
            $this->showTable($lijst);
        } else {
            echo "Geen klanten gevonden.";
        }
    }

    public function getKlanten() : array {
        $sql = "SELECT klantId, klantNaam, klantEmail, klantWoonplaats 
                FROM $this->table_name
                ORDER BY klantId";

        $stmt = self::$conn->query($sql);
        return $stmt->fetchAll();
    }

    public function getKlant(int $klantId) : array {
        $sql = "SELECT klantId, klantNaam, klantEmail, klantWoonplaats
                FROM $this->table_name
                WHERE klantId = :klantId";

        $stmt = self::$conn->prepare($sql);
        $stmt->execute([':klantId' => $klantId]);

        $row = $stmt->fetch();
        return $row ? $row : [];
    }

    public function dropDownKlant($row_selected = -1) {
        $lijst = $this->getKlanten();

        echo "<label for='Klant'>Choose a klant:</label>";
        echo "<select name='klantId'>";
        foreach ($lijst as $row) {
            if ($row_selected == $row["klantId"]) {
                echo "<option value='$row[klantId]' selected='selected'>$row[klantNaam] $row[klantEmail]</option>\n";
            } else {
                echo "<option value='$row[klantId]'>$row[klantNaam] $row[klantEmail]</option>\n";
            }
        }
        echo "</select>";
    }

    public function showTable($lijst) : void {
        $txt = "<table>";
        $txt .= TableHelper::getTableHeader($lijst[0]);

        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . $row["klantId"] . "</td>";
            $txt .= "<td>" . $row["klantNaam"] . "</td>";
            $txt .= "<td>" . $row["klantEmail"] . "</td>";
            $txt .= "<td>" . $row["klantWoonplaats"] . "</td>";

            $txt .= "<td>
                <form method='post' action='update.php?klantId={$row['klantId']}'>
                    <button name='update'>Wzg</button>
                </form>
            </td>";

            $txt .= "<td>
                <form method='post' action='delete.php?klantId={$row['klantId']}'>
                    <button name='verwijderen'>Verwijderen</button>
                </form>
            </td>";

            $txt .= "</tr>";
        }

        $txt .= "</table>";
        echo $txt;
    }

    public function deleteKlant(int $klantId) : bool {
        $sql = "DELETE FROM $this->table_name WHERE klantId = :klantId";
        $stmt = self::$conn->prepare($sql);

        return $stmt->execute([
            ':klantId' => $klantId
        ]);
    }

    public function updateKlant($row) : bool {
        $sql = "UPDATE $this->table_name
                SET klantNaam = :klantNaam,
                    klantEmail = :klantEmail
                WHERE klantId = :klantId";

        $stmt = self::$conn->prepare($sql);

        return $stmt->execute([
            ':klantId' => $row['klantId'],
            ':klantNaam' => $row['klantnaam'],
            ':klantEmail' => $row['klantemail']
        ]);
    }

    private function BepMaxKlantId() : int {
        $sql = "SELECT MAX(klantId) + 1 FROM $this->table_name";
        $maxId = self::$conn->query($sql)->fetchColumn();

        if ($maxId === null) {
            return 1;
        }

        return (int)$maxId;
    }

    public function insertKlant($row) : bool {
        $klantId = $this->BepMaxKlantId();

        $sql = "INSERT INTO $this->table_name
                (klantId, klantNaam, klantEmail, klantWoonplaats)
                VALUES (:klantId, :klantNaam, :klantEmail, :klantWoonplaats)";

        $stmt = self::$conn->prepare($sql);

        return $stmt->execute([
            ':klantId' => $klantId,
            ':klantNaam' => $row['klantnaam'],
            ':klantEmail' => $row['klantemail'],
            ':klantWoonplaats' => $row['klantwoonplaats'] ?? ''
        ]);
    }
}
?>