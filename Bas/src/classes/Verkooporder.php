<?php
// auteur: studentnaam
// functie: definitie class Verkooporder

namespace Bas\classes;

use Bas\classes\Database;

class Verkooporder extends Database {
    private $table_name = "verkooporder";

    public function __construct() {
        parent::__construct();
    }

    public function getVerkooporders() : array {
        $sql = "SELECT v.verkOrdId,
                       v.klantId,
                       v.artId,
                       k.klantNaam,
                       a.artOmschrijving,
                       v.verkOrdDatum,
                       v.verkOrdBestAantal,
                       v.verkOrdStatus
                FROM $this->table_name v
                JOIN klant k ON v.klantId = k.klantId
                JOIN artikel a ON v.artId = a.artId
                ORDER BY v.verkOrdId DESC";

        $stmt = self::$conn->query($sql);
        return $stmt->fetchAll();
    }

    public function getVerkooporder(int $verkOrdId) : array {
        $sql = "SELECT v.verkOrdId,
                       v.klantId,
                       v.artId,
                       k.klantNaam,
                       a.artOmschrijving,
                       v.verkOrdDatum,
                       v.verkOrdBestAantal,
                       v.verkOrdStatus
                FROM $this->table_name v
                JOIN klant k ON v.klantId = k.klantId
                JOIN artikel a ON v.artId = a.artId
                WHERE v.verkOrdId = :verkOrdId";

        $stmt = self::$conn->prepare($sql);
        $stmt->execute([
            ':verkOrdId' => $verkOrdId
        ]);

        $row = $stmt->fetch();
        return $row ? $row : [];
    }

    public function showTable($lijst) : void {
        if (empty($lijst)) {
            echo "<p>Geen verkooporders gevonden.</p>";
            return;
        }

        $txt = "<table>";
        $txt .= "<tr>
                    <th>Klant</th>
                    <th>Artikel</th>
                    <th>Datum</th>
                    <th>Aantal</th>
                    <th>Status</th>
                    <th>Acties</th>
                 </tr>";

        foreach ($lijst as $row) {
            $txt .= "<tr>";
            $txt .= "<td>" . htmlspecialchars($row["klantNaam"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["artOmschrijving"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["verkOrdDatum"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($row["verkOrdBestAantal"]) . "</td>";
            $txt .= "<td>" . htmlspecialchars($this->getStatusTekst((int)$row["verkOrdStatus"])) . "</td>";
            $txt .= "<td class='action-cell'>";

            $txt .= "<form class='inline-form' method='post' action='update.php?verkOrdId={$row['verkOrdId']}'>
                        <button name='update'>Wzg</button>
                     </form>";

            $txt .= "<form class='inline-form' method='post' action='delete.php?verkOrdId={$row['verkOrdId']}'>
                        <button name='verwijderen'>Verwijderen</button>
                     </form>";

            $txt .= "<form class='inline-form' method='get' action='status.php'>
                        <input type='hidden' name='verkOrdId' value='{$row['verkOrdId']}'>
                        <button name='status'>Status</button>
                     </form>";

            $txt .= "</td>";
            $txt .= "</tr>";
        }

        $txt .= "</table>";
        echo $txt;
    }

    public function insertVerkooporder($row) : bool {
        $sql = "INSERT INTO $this->table_name
                (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus)
                VALUES (:klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";

        $stmt = self::$conn->prepare($sql);

        return $stmt->execute([
            ':klantId' => $row['klantId'],
            ':artId' => $row['artId'],
            ':verkOrdDatum' => $row['verkOrdDatum'],
            ':verkOrdBestAantal' => $row['verkOrdBestAantal'],
            ':verkOrdStatus' => $row['verkOrdStatus']
        ]);
    }

    public function updateVerkooporder($row) : bool {
        $sql = "UPDATE $this->table_name
                SET klantId = :klantId,
                    artId = :artId,
                    verkOrdDatum = :verkOrdDatum,
                    verkOrdBestAantal = :verkOrdBestAantal,
                    verkOrdStatus = :verkOrdStatus
                WHERE verkOrdId = :verkOrdId";

        $stmt = self::$conn->prepare($sql);

        return $stmt->execute([
            ':verkOrdId' => $row['verkOrdId'],
            ':klantId' => $row['klantId'],
            ':artId' => $row['artId'],
            ':verkOrdDatum' => $row['verkOrdDatum'],
            ':verkOrdBestAantal' => $row['verkOrdBestAantal'],
            ':verkOrdStatus' => $row['verkOrdStatus']
        ]);
    }

    public function updateOrderStatus(int $verkOrdId, int $verkOrdStatus) : bool {
        $sql = "UPDATE $this->table_name
                SET verkOrdStatus = :verkOrdStatus
                WHERE verkOrdId = :verkOrdId";

        $stmt = self::$conn->prepare($sql);

        return $stmt->execute([
            ':verkOrdId' => $verkOrdId,
            ':verkOrdStatus' => $verkOrdStatus
        ]);
    }

    public function deleteVerkooporder(int $verkOrdId) : bool {
        $sql = "DELETE FROM $this->table_name
                WHERE verkOrdId = :verkOrdId";

        $stmt = self::$conn->prepare($sql);

        return $stmt->execute([
            ':verkOrdId' => $verkOrdId
        ]);
    }

    public function getKlantenVoorDropdown() : array {
        $sql = "SELECT klantId, klantNaam
                FROM klant
                ORDER BY klantNaam";

        $stmt = self::$conn->query($sql);
        return $stmt->fetchAll();
    }

    public function getArtikelenVoorDropdown() : array {
        $sql = "SELECT artId, artOmschrijving
                FROM artikel
                ORDER BY artOmschrijving";

        $stmt = self::$conn->query($sql);
        return $stmt->fetchAll();
    }

    public function getStatusTekst(int $status) : string {
        switch ($status) {
            case 1:
                return "Genoteerd";
            case 2:
                return "Wordt verzameld";
            case 3:
                return "Bij bezorger";
            case 4:
                return "Afgeleverd";
            default:
                return "Onbekend";
        }
    }
}
?>