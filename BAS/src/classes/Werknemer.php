<?php
// auteur: studentnaam
// functie: definitie class Werknemer

namespace Bas\classes;

class Werknemer
{
    private array $werknemers = [
        'magazijn' => [
            'wachtwoord' => '1234',
            'rol' => 'magazijn'
        ],
        'bezorger' => [
            'wachtwoord' => '1234',
            'rol' => 'bezorger'
        ],
        'verkoper' => [
            'wachtwoord' => '1234',
            'rol' => 'verkoper'
        ],
        'inkoper' => [
            'wachtwoord' => '1234',
            'rol' => 'inkoper'
        ]
    ];

    public function login(string $gebruikersnaam, string $wachtwoord): bool
    {
        if (!isset($this->werknemers[$gebruikersnaam])) {
            return false;
        }

        if ($this->werknemers[$gebruikersnaam]['wachtwoord'] !== $wachtwoord) {
            return false;
        }

        $_SESSION['gebruiker'] = $gebruikersnaam;
        $_SESSION['rol'] = $this->werknemers[$gebruikersnaam]['rol'];

        return true;
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
    }

    public function isIngelogd(): bool
    {
        return isset($_SESSION['gebruiker']) && isset($_SESSION['rol']);
    }

    public function getGebruiker(): string
    {
        return $_SESSION['gebruiker'] ?? '';
    }

    public function getRol(): string
    {
        return $_SESSION['rol'] ?? '';
    }

    public function heeftRol(string $rol): bool
    {
        return $this->getRol() === $rol;
    }

    public function magNaarPagina(string $pagina): bool
    {
        $rol = $this->getRol();

        $rechten = [
            'magazijn' => [
                'klanten',
                'artikelen',
                'verkooporders',
                'orderstatus'
            ],
            'bezorger' => [
                'verkooporders',
                'orderstatus'
            ],
            'verkoper' => [
                'klanten',
                'verkooporders'
            ],
            'inkoper' => [
                'artikelen'
            ]
        ];

        return in_array($pagina, $rechten[$rol] ?? []);
    }
}
?>