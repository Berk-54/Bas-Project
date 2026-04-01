# Definition of Done (DoD) – Bas Brengt Boodschappen

Een user story / usecase is **pas ‘Done’** als aan **alle** punten hieronder is voldaan.

## Functionaliteit
- Acceptance criteria van de user story zijn aantoonbaar gerealiseerd.
- Alle schermen/flows die bij de story horen werken end-to-end.

## Codekwaliteit
- Code staat in `src/` en volgt een consistente structuur (MVC zoals in de startcode).
- Database-toegang gebeurt via **PDO** (geen `mysqli`).
- Input is gevalideerd (server-side) en foutmeldingen zijn duidelijk.
- Geen hardcoded testdata in productieroutes; configuratie staat centraal.

## Tests
- Relevante unit tests staan in `tests/` en draaien groen met PHPUnit.
- Nieuwe functionaliteit heeft (waar zinvol) tests of is aantoonbaar handmatig getest en vastgelegd.

## Data / Database
- Tabellen en relaties kloppen met de ERD.
- CRUD-acties werken zonder SQL-fouten; prepared statements worden gebruikt.

## Git / Samenwerking
- Alles staat in Git in de afgesproken mappenstructuur.
- `vendor/` staat **niet** in de repository (staat in `.gitignore`).
- Commit message is duidelijk (bij Sprint 0: **start**).

## Review / Oplevering
- Opdrachtgever/docent kan de user story demonstreren.
- Documentatie (wireframe/ERD/classdiagram waar van toepassing) is bijgewerkt.
