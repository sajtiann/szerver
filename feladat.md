### Adatmodellek

-   `Team` - egy csapat
    -   `id`
    -   `name` (string, egyedi)
    -   `shortname` (string, egyedi, max. 4 karakter)
    -   `image` (string, lehet null)
    -   `időbélyegek`
-   `Player` - egy játékos adatai
    -   `id`
    -   `name` (string)
    -   `number` (integer, a játékos mezszáma)
    -   `birthdate` (date)
    -   `időbélyegek`
-   `Game` - egy mérkőzés
    -   `id`
    -   `start` (datetime)
    -   `finished` (logikai, alapértelmezetten hamis)
    -   `időbélyegek`
-   `Event` - egy esemény egy mérkőzésen belül
    -   `id`
    -   `type` (enum - eseménytípusok: gól, öngól, sárga lap, piros lap)
    -   `minute` (integer, hanyadik percben történt az esemény)
    -   `időbélyegek`
-   `User` - ez már készen érkezik, csak egy mezővel kell kiegészíteni
    -   `is_admin` (logikai, alapértelmezetten hamis)

### Kapcsolatok

-   `Team` 1 : N `Player` kesz model
-   `Team` 1 : N `Game` (pl. `home_team_id` néven - a hazai oldalon játszó csapat azonosítója) kesz model?
-   `Team` 1 : N `Game` (pl. `away_team_id` néven - a vendég oldalon játszó csapat azonosítója) kesz model?
-   `Game` 1 : N `Event` kesz model
-   `Player` 1 : N `Event` kesz model
-   `User` N : N `Team`
