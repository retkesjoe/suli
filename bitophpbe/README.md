#[HU]C# kérés küldése webszervernek

##[HU]Szükséges csomagok fájlok
* _WEB_
  * [Virtual box](https://www.virtualbox.org/wiki/Downloads)
  * [Vagrant](https://www.vagrantup.com/downloads.html)
    * Vagrant is a tool for building and managing virtual machine environments in a single workflow.
  * [Homestead](https://laravel.com/docs/5.6/homestead)
    * Ez egy egy előre csomagolt vagrant box amely tartalmaz egy csomó nyalánkságot, köztük MySQL és Apache szervert
    * A linken megtalálható minden utasítás amit ki kell adni a használatához
  * [Composer](https://getcomposer.org/download/)
    * Az oldal tetején Windows Installer alatti részen ajánlom a Composer-Setup.exe letöltését és azzal való telepítését
    * Ez egy csomagkezelő, webes projektekhez tudsz különböző csomagokat lehúzni.
  * [MySQL Workbench](https://dev.mysql.com/downloads/workbench/)
    * Oldal aljára tekerve letölthető, ingyenes, adatbázis menedzselő program
  * [Visual Studio Code IDE](https://code.visualstudio.com/)
    * Ingyenes szövegszerkesztő szoftver kismillió extensionnel, elegáns kinézettel.

* _C#_
  * [Visual Studio Community Edition](https://www.visualstudio.com/)
  
* _TEST_
  * [Postman](https://www.getpostman.com/apps)
    * Kéréseket tudsz küldeni a webszerver felé ezzel tesztelve, hogy megfelelő adatokra megfelelő válasz érkezik-e
    illetve, hogy az adatbázisműveleteket végrehajtja-e a backend.
  
**Leírás**
    
  * Miután feltelepítetted a Virtual boxot, Vagrantot, Vagranthoz hozzáadtad a homestead boxot (leírás a fentebb említett
    Homestead linken) majd leklónoztad a homestead-et és telepítetted a Composert, az első feladat, hogy
    hozzáadjuk a rendszer változókhoz a composer elérési útját.
  * Nálam ez az AppData rejtett mappában van C:\Users\Username\AppData\Roaming\Composer\vendor\bin
  * Telepítsd utána a többi programot is és indítsd újra a gépet, hogy a változtatások életbe lépjenek.
  * A projektet clone-ozd le githubról.
  * Javaslom csinálj egy ilyet hogy suli\webroot\teszt és ide clone-ozd a projektet.
  * Keresd meg a Homestead mappát, nálam ez az alábbi útvonalon található. C:\Users\Username\Homestead
  * Ebben a mappában van egy Homestead.yaml nevű fájl, ezt kell szerkesztened.
  * A folders és majd a sites részt kell átírnod
    
    
    folders:
        - map: c:/suli/webroot
          to: /var/www/webroot
     
    sites:
        - map: teszt.test
          to: /var/www/webroot/suli/teszt
          
  * Keresed lépj be a C:\Windows\System32\drivers\etc mappába és szerkezd szövegszerkesztővel a hosts filet
  * Kizárólag adminisztrátori jogosultsággal tudod szerkeszteni. Az utolsó sor után ad hozzá ezt
  
    
    192.168.10.10 teszt.test
    
  * Nyiss egy terminált és keresd meg a Homestead mappát ahol a Homestead.yaml is van. cd parancsokkal tudsz lépegetni.
  Majd futtasd az alábbi parancsot. Ez felállítja utána a virtuális környezetet.
  
  
    vagrant up

  * Böngészőbe ha beírod hogy http://teszt.test/user/read/1 akkor vissza kell kapnod az 1-es ID-jú usert az
  adatbázisból, persze ha létezik, ami nálad még jelenleg nem fog létezni.
  * Nyisd meg a MySQL Workbench-et
  * Van egy olyan opció, hogy MySQL Connections, na ott fel kell venni egy új connection-t
      * Connection Name: {teljesenmindegymitírszoda} :)
      * Connection Method: Standard (TCP/IP)
      * Hostname: 127.0.0.1
      * Port: 33060
      * Username: homestead
      * Password: Store in Vault... -> **Password:** secret
  * Hozz létre egy új schema-t. Jelen program szerint nálam ez bitophpbe néven hoztam létre
  * Ezen belül hozz létre egy user táblát és a user táblán belül legyenek az alábbi mezők
    * id | INT(11) | Primary Key | Not Null | Auto Increment
    * username | VARCHAR(45) | Not Null | Unique Index
    * email | VARCHAR(120) | Not Null | Unique Index
    * password | VARCHAR(255) | Not Null
    * created_at | DATETIME | CURRENT_TIMESTAMP 
    
  