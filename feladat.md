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

### Modellek és seeder (4 pont) `KÉSZ`

_Minden modellből kerüljön tárolásra észszerű mennyiségben (pl. 10-15 csapat), valamint a köztük lévő kapcsolatokból is generálj!_
_A seeder fedjen le minél több esetet, tehát legyenek pl. már lejátszott, folyamatban lévő és jövőbeli meccsek is, valamint változatos események az egyes meccseken belül!_
_Minden szükséges seedelés egyetlen parancs kiadására történjen meg: php artisan db:seed vagy php artisan migrate:fresh --seed_
_Az egyszerű felhasználók csak userX@szerveroldali.hu (ahol X eleme természetes számok) e-mail címmel és password jelszóval jöjjenek létre az egyszerűség kedvéért!_
_Egyetlen admin jogosultságú felhasználó legyen, akinek a bejelentkezési adatai fixen: admin@szerveroldali.hu - adminpwd_

### Főoldal (1 pont) `KÉSZ`

_Az alkalmazás gyökér útvonalán jelenjen meg egy statikus oldal, amelyen tájékoztatást kapunk arról, hogy milyen webhelyre érkeztünk, és a következő menüpontok közül választhatunk:_
_mérkőzések_
_csapatok_
_tabella_
_kedvenceim_

### Mérkőzések oldal (4 pont)

_Ezt az oldalt bárki (vendég, bejelentkezett, admin) megtekintheti._
_Az oldalon megjelenik az összes mérkőzés: a mérkőzésben részt vevő két csapat neve (vagy rövidítése), logója (ha van feltöltve, különben placeholder kép) és a meccs kezdési időpontja._
_A mérkőzések alapvetően időrendi sorrendben jelennek meg, de külön szekcióba ki kell emelni az éppen folyamatban lévő meccseket (amelyek kezdési időpontja elmúlt, de nincsenek még befejezettként jelölve)._
_A folyamatban lévő és befejezett mérkőzéseknél az aktuális eredmény is legyen látható! Ezt az adott meccshez tartozó gól és öngól típusú események alapján kell valós időben kiszámolni, tehát nem szabad külön fix adatként eltárolni az eredményt! (Figyelem: az öngólt értelemszerűen az ellenfél javára kell számolni, nem pedig a gólszerző játékos csapatának!)_
_Lapozással biztosítsd, hogy csak bizonyos (pl. 10, 15, 20, stb.) számú mérkőzés jelenjen meg egyidejűleg az oldalon, utána lapozni kelljen! Ez alól kivételt képezhet a folyamatban lévő meccsek szekciója, amelyekről feltételezhetjük, hogy egyszerre viszonylag kevés van, és akár minden lapozott oldal tetején is szerepelhet._
_Egy adott mérkőzésre kattintva annak részletező oldalára jutunk._

### Mérkőzésrészletező oldal (2 pont) `KÉSZ`

_Ezen az oldalon is láthatók a paraméterként kapott meccs alapvető adatai, illetve folyamatban lévő vagy befejezett mérkőzés esetén az eredmény is._
_Időrendi sorrendben megjelenik az adott meccshez tartozó összes esemény. (pl. "7. perc, Unikornis FC, gól, Programo Zoltán")_

### Új esemény rögzítése (3 pont) `EVENTNEK ÁTADNI AZ ADOTT GAME ID-T`

_Az admin felhasználó számára a mérkőzésrészletező oldalról (pl. az alján elhelyezett űrlapon vagy innen elérhető külön oldalon) lehetőség van új esemény rögzítésére egy folyamatban lévő mérkőzéshez._
_Ehhez meg kell adnia a következőket: hányadik játékpercben (1 és 90 közötti egész), milyen típusú esemény (gól, öngól, sárga lap, piros lap) történt és ki az érintett játékos. Alapvetően nem szükséges külön kiválasztani (vagy tárolni) a csapatot, hiszen azt a játékos személye egyértelműen meghatározza._
_Az érintett játékost egy listából (pl. legördülő menü vagy rádiógombok) lehet kiválasztani, amely csapat és mezszám szerint rendezett._

### Esemény visszavonása (1 pont) `KÉSZ`

_Az admin felhasználó az egyes eseményeket vissza is vonhatja (törölheti), pl. téves rögzítés esetén._
_Visszavonni csak addig lehet eseményeket, amíg a meccs folyamatban van. Lezárt mérkőzés eseményeihez nem lehet hozzányúlni._

### Meccs lezárása (1 pont)

Az admin felhasználó számára a mérkőzésrészletező oldalról lehetőség van a meccs lezárására, tehát befejezetté nyilvánítására.
A lezárt meccshez további esemény nem rögzíthető, illetve a meccs ezután nem jelenik meg a folyamatban lévő mérkőzések szekciójában.

### Új mérkőzés létrehozása (3 pont) `KÉSZ`

_Az admin felhasználó új mérkőzéseket is kiírhat._
_Az egyes mezőkre jellemző alapvető validációs feltételek mellett ellenőrizni kell, hogy a kezdés időpontja jövőbeli, illetve a hazai és vendég csapat nem azonos._

### Meglévő mérkőzés módosítása (3 pont) `KÉSZ`

_Az admin felhasználó módosíthatja is a meglévő mérkőzéseket._

### Mérkőzés törlése (1 pont) `KÉSZ`

_Az admin felhasználó törölheti is a meglévő mérkőzéseket, amennyiben még nincs esemény rögzítve az adott meccshez!_

### Csapatok listája (2 pont) `KÉSZ`

_Ezt az oldalt bárki (vendég, bejelentkezett, admin) megtekintheti._
_Az oldalon megjelenik az összes csapat neve, rövidítése és logója (ha van feltöltve, különben placeholder kép)._
_A lista a csapatok neve szerint betűrendbe rendezve jelenik meg._
_Az egyes csapatokra kattintva továbblépünk az adott csapat részletező oldalára._

### Csapatrészletező oldal (2 pont) `KÉSZ`

_A csapatrészletező oldalon két fontos információ kell megjelenjen:_
_A csapat mérkőzései időrendi sorrendben. (Természetesen itt is fel kell tüntetni az eredményt a folyamatban lévő és befejezett meccsek esetében.)_
_A csapatban lévő összes játékos adatai: neve, születési dátuma, statisztikái (hány gólt, öngólt rúgott, illetve hány sárga és piros lapot kapott)._

### Új csapat hozzáadása (4 pont) `KÉSZ`

_Az admin tudjon új csapatot felvenni a bajnokságba. Ehhez meg kell adjon minden kötelező adatot, de logó feltöltése opcionális!_
_A logóhoz tartozó képfeltöltés ténylegesen legyen fájlfeltöltés, tehát nem elég csupán a kép nevét vagy egy külső URL-t eltárolni!_

### Meglévő csapat módosítása (4 pont) `KÉSZ`

_Az admin a csapat részletező oldaláról átlépve tudja módosítani is a felvett csapatok adatait és/vagy logóját._
_Ha már van feltöltött kép, és nem tölt fel fájlt, akkor maradjon meg az előző kép; különben értelemszerűen le kell cserélni._

### Új játékos felvétele (2 pont) `PLAYERNEK ÁTADNI AZ ADOTT TEAM ID-T`

_Az admin tudjon új játékost felvenni_ a csapatba annak részletező oldaláról indulva. _Ehhez meg kell adjon minden kötelező adatot, tehát a játékos mezszámát, nevét és születési dátumát._

### Meglévő játékos törlése (1 pont) `KÉSZ`

_Az admin tudjon törölni olyan játékosokat, akikhez nem tartozik még esemény egy meccsen sem. Tehát azokat a játékosokat, akik letettek már valamit az asztalra, nem töröljük a jegyzőkönyvekből!_

### Tabella oldal (4 pont)

A tabella oldalon megjelenik a bajnokságban résztvevő összes csapat az elért pontszámuk szerinti sorrendben.
Egy csapat pontszámát a befejezett mérkőzései alapján kell számítani a következő módon:
nyert mérkőzés: +3 pont
döntetlen: +1 pont
vesztes mérkőzés: +0 pont
Ha két csapat pontszáma a fentiek szerint azonos, akkor az kerüljön a sorrendben előrébb, akinek jobb a gólkülönbsége (szerzett gólokból kivonjuk a kapott gólok számát). Ha még mindig egyenlőség van, akkor a betűrendben előbb lévő csapat kerüljön feljebb a rangsorban.

### Kedvenceim oldal (4 pont)

Ez az oldal csak bejelentkezett felhasználók számára elérhető.
A nem bejelentkezett felhasználóknak ajánljuk fel a bejelentkezés vagy regisztráció lehetőségét, amely természetesen működjön is megfelelően!
A bejelentkezett felhasználók minden olyan helyen, ahol csapatnév vagy rövidítés szerepel (pl. meccsek, csapatok, tabella) kedvencnek tudják jelölni a csapatukat egy gombra vagy ikonra kattintva.
A már kedvencnek jelölt csapat ugyanígy el is távolítható a kedvencek közül.
A kedvenceim oldalon a bejelentkezett felhasználók csak azokat a mérkőzéseket látják, amelyben valamelyik kedvencnek jelölt csapatuk részt vesz.

### Védésre szerezhető pontszám (4 pont)

További 4 pont szerezhető a védés során mutatott általános jártasságra a témában.
Nem várjuk el senkitől, hogy másfél-két hónap alatt mesterévé váljon a Laravel lelki világának; viszont azt igen, hogy a saját projektjét alapvetően tudja navigálni és a gyakorlaton lefedett ismeretekkel kapcsolatos kiegészítő kérdésekre tudjon értékelhetően válaszolni. Normál esetben a védés 15-20 percnél tovább nem tart.
Amennyiben a hallgató a szóbeli védés során teljes tájékozatlanságot mutat, az egész beadandó feladat visszautasítható!
