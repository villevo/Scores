##############
Rovaniemen Rolffarit ry
Ville Ollonqvist
Scores

Tulostensyöttö viikkokisoja varten kisakoneeseen.
##############

Ensimmäiset kenttä testit suoritettu viikkokisoissa ja todettu toimivaksi ja helpoksi tavaksi lisätä viikkokisa tulokset
Toimii nätisti  viikkokisojen tulostensyöttämiseen, toimii myös kisakoneen tasoituksellisen branchin kanssa ( https://github.com/mipoikon/kisakone ) 
Myös tasoitukset lasketaan kierroksista jotka on lisätty tämän kautta

Koodi sisältää pientä purkkaa ja tulee antamaan erroria ainakin seuraavista: LevelID-arvo ja venue on kovakoodattu, Osaava löytää ja muokkaa omakseen.

Tietokannan PREFIXin muuttamista ei ole koodattu vaan kaikki tietokanta kyselyt ja insertit on kisakone_-prefixille tehty.

##############

1. User-auth rakennettu index.php-tiedoston sisään ja siitä redirectit /pages-kansioon. Käytössä kisakoneen
	käyttäjät ja sallittujen käyttäjien valikointi config.php:ssä. Kiitokset tästä Jvuennolle.

2. tulosten syötön nopeuttamiseksi systeemi on rakennettu niin että vain kilpailun kokonais-tulos syötetään pelaajille,
    meillä viikkokisat pidetään metsä radalla ja ajatus on ollut että systeemi ois mahdollisimman helppo TD:lle
    ja tulosten lisääminen onnistuu suoraan puhelimella responsiivisen templaten ansiosta.

3. Kilpailun lisääminen onnistuu nopeasti lomakkeen kautta. vain päivämäärä,aika ja kilpailun nimi lisätään. 
    - TD:n valinta dropdownista, oletuksena pelaaja joka on kirjautunut sisään
	- Venuen valinta dropdownista, oletuksena Toramo

4.0 Lisää tulokset-lomake "Stage1": listaa ensin kaikki level 2-kisat(viikkokisat) jotka on auki ja kiinni olevista kisoista viikkokisat joiden päivämäärä on alle 2viikkoa vanha siltä varalta että tuloksissa on virheitä ja niitä pitää muokata.

4.1 Lisää tulokset-lomake "stage2": kilpailuna valittu kisa, radan valinta ja luokkien valinta. listaa kaikki UserPlayerit jotka ovat kisakoneessa(ei TD:n luomia irrallisia Playereitä
   eikä UserPlayereistä parikisa-tunnuksia joissa esiintyy sana "pari" ja meidän käyttöön pari tupla tunnaria poistettu listauksesta suoraan qyeryssä.)
   
   Tulosten lisäämisen jälkeen formi lähettämällä poimitaan pelaajat joilla on scoret välillä 20-200 ja heidän
   ilmoittautumiset,maksut,lohkot,tulokset ymsyms. lisätään automaattisesti, lopuksi kilpailu suljetaan ja 
   tasoitukset lisätään jos radalla on Rating ja slope arvot. Tämän jälkeen scoret on kisakoneessa selattavissa, hommaan toimii jouhevasti sillä tulosten syöttöön menee 60hengen ryhmällä noin 10minuuttia.
   
   tulosten muokkaus tapahtuu valitsemalla stage1-lomakkeessa suljettu kilpailu(merkattu dropdownin sisällä "!****"-etuliitteellä),
   Stage2-lomake kierroksella mukana olleiden pelaajien tulokset ylimmäiseksi. Käyttäjä muokkaa tulokset tarpeen mukaan, kun tulokset lähetetään niin kaikki vanha tieto poistetaan kisakoneen kannasta jonka jälkeen lomakkeen tiedot laitetaan kantaan.
   
   
##############

   TODO:
  
	-addscores-stage2: Luokan esivalinta suljetuille kilpailuille, nyt FPO-luokka pitää vääntää päälle manuaalisesti.
	-MPM-luokan lisäys järjestelmään josain vaiheessa, 
	-siistimistä,siistimistä
            

