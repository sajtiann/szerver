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

### Modellek és seeder (4 pont)

Minden modellből kerüljön tárolásra észszerű mennyiségben (pl. 10-15 csapat), valamint a köztük lévő kapcsolatokból is generálj!
A seeder fedjen le minél több esetet, tehát legyenek pl. már lejátszott, folyamatban lévő és jövőbeli meccsek is, valamint változatos események az egyes meccseken belül!
Minden szükséges seedelés egyetlen parancs kiadására történjen meg: php artisan db:seed vagy php artisan migrate:fresh --seed
Az egyszerű felhasználók csak userX@szerveroldali.hu (ahol X eleme természetes számok) e-mail címmel és password jelszóval jöjjenek létre az egyszerűség kedvéért!
Egyetlen admin jogosultságú felhasználó legyen, akinek a bejelentkezési adatai fixen: admin@szerveroldali.hu - adminpwd

### Főoldal (1 pont)

Az alkalmazás gyökér útvonalán jelenjen meg egy statikus oldal, amelyen tájékoztatást kapunk arról, hogy milyen webhelyre érkeztünk, és a következő menüpontok közül választhatunk:
mérkőzések
csapatok
tabella
kedvenceim

### Mérkőzések oldal (4 pont)

Ezt az oldalt bárki (vendég, bejelentkezett, admin) megtekintheti.
Az oldalon megjelenik az összes mérkőzés: a mérkőzésben részt vevő két csapat neve (vagy rövidítése), logója (ha van feltöltve, különben placeholder kép) és a meccs kezdési időpontja.
A mérkőzések alapvetően időrendi sorrendben jelennek meg, de külön szekcióba ki kell emelni az éppen folyamatban lévő meccseket (amelyek kezdési időpontja elmúlt, de nincsenek még befejezettként jelölve).
A folyamatban lévő és befejezett mérkőzéseknél az aktuális eredmény is legyen látható! Ezt az adott meccshez tartozó gól és öngól típusú események alapján kell valós időben kiszámolni, tehát nem szabad külön fix adatként eltárolni az eredményt! (Figyelem: az öngólt értelemszerűen az ellenfél javára kell számolni, nem pedig a gólszerző játékos csapatának!)
Lapozással biztosítsd, hogy csak bizonyos (pl. 10, 15, 20, stb.) számú mérkőzés jelenjen meg egyidejűleg az oldalon, utána lapozni kelljen! Ez alól kivételt képezhet a folyamatban lévő meccsek szekciója, amelyekről feltételezhetjük, hogy egyszerre viszonylag kevés van, és akár minden lapozott oldal tetején is szerepelhet.
Egy adott mérkőzésre kattintva annak részletező oldalára jutunk.
