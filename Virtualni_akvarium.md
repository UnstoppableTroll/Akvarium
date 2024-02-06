## Datový Konceptuální Model (Aktualizovaný)

1.  **Entita: Uživatel**
    -   **Atributy:**
        -   UživatelID (primární klíč)
        -   Jméno
        -   Heslo
2.  **Entita: Ryba**
    -   **Atributy:**
        -   RybaID (primární klíč)
        -   UživatelID (cizí klíč, odkazuje na Uživatele)
        -   Jméno
        -   Barva

### Vztahy mezi Entitami

-   Uživatel může přidat maximálně jednu Rybu (1:1 vztah).

V aplikaci "Virtuální Akvárium" uživatel vytvoří nový účet a přihlásí se
pomocí jména a hesla, přičemž se klade důraz na základní bezpečnostní
ověření a šifrování hesel. Každý uživatel si bude moct přidat do
virtuálního akvária jednu rybu. Ryby budou mít libovolná jména a barvy.
Aplikace poté zobrazí virtuální akvárium, které obsahuje ryby všech
uživatelů a zároveň zajišťuje, že akvárium nebude obsahovat více než 10
ryb.

## Specifikace Uživatelských Rolí a Oprávnění

1.  **Běžný Uživatel**
    -   **Oprávnění a Přístup:**
        -   Registrace a Přihlášení: Může se zaregistrovat a přihlásit
            do aplikace.
        -   Přidání Ryby: Může přidat jednu rybu do akvária. Při
            přidávání určí jméno a barvu ryby.
        -   Prohlížení Akvária: Má přístup k zobrazení akvária a může
            vidět ryby přidané všemi uživateli.
2.  **Privilegovaný Uživatel**
    -   **Oprávnění a Přístup:**
        -   Všechna Oprávnění Běžného Uživatele: Privilegovaný uživatel
            má stejná oprávnění jako běžný uživatel.
        -   Odstranění Jedné Ryby: Má možnost odebrat jakoukoliv jednu
            rybu z akvária.
        -   Vymazání Celého Akvária: Může vymazat všechny ryby v akváriu
            najednou. Tato akce obnoví akvárium do původního stavu bez
            ryb.

To umožňuje běžným uživatelům plně využívat základní funkce aplikace,
zatímco privilegovaný uživatel má dodatečné možnosti pro správu obsahu
akvária.

## Technická Specifikace

### 1. Datový Logický Model

-   **Uživatel**
    -   Atributy: uživatelID (int, primární klíč), jméno (varchar),
        heslo (varchar).
-   **Ryba**
    -   Atributy: rybaID (int, primární klíč), uživatelID (int, cizí
        klíč), jméno (varchar), barva (varchar).


### Komponenty Architektury

-   **Model**
    -   **Funkce**: Zodpovídá za získávání dat, jejich zpracování a
        ukládání.
    -   **Technologie**: PHP pro logiku a MySQL pro databázi.
    -   **Třídy**:
        -   `User`: Správa uživatelských údajů (CRUD operace).
        -   `Fish`: Správa ryb v akváriu (CRUD operace).
-   **View**
    -   **Funkce**: Prezentuje data uživatelům a zajišťuje uživatelské
        rozhraní.
    -   **Technologie**: HTML, CSS pro strukturu a design, JavaScript
        pro interaktivitu.
    -   **Soubory/Šablony**: Oddělené soubory pro každou stránku nebo
        část aplikace, např. `login.php`, `register.php`,
        `aquarium.php`.
-   **Controller**
    -   **Funkce**: Zpracovává uživatelské požadavky, volá metody modelu
        a rozhoduje, který pohled zobrazit.
    -   **Technologie**: PHP.
    -   **Třídy**:
        -   `UserController`: Zpracování požadavků souvisejících s
            uživateli.
        -   `FishController`: Zpracování požadavků souvisejících s
            rybami.

### Technologie a Funkčnosti

-    **HTML/CSS**: Struktura a styl jednotlivých stránek. Responzivní
        design pro různé velikosti obrazovek.
    -   **JavaScript**: Klient-side logika, např. validace formulářů.
    -   **PHP**: Server-side skriptování, zpracování logiky aplikace,
        komunikace s databází.
    -   **MySQL**: Ukládání a správa dat aplikace.
-   **Bezpečnost**
    -   **Hashování hesel**: Ochrana uživatelských hesel.
    -   **Prepared Statements v MySQL**: Ochrana před SQL injekcí.

### Routing a URL Management

-   Použití htaccess a PHP pro čisté a přehledné URL, které mapují na
    konkrétní controllery a akce.

### Session Management

-   Správa uživatelských sezení pro identifikaci a udržování stavu
    uživatele v rámci aplikace.
