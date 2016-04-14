##############
Scores

Tulostensyöttö viikkokisoja varten kisakoneeseen.
##############

Ensimmäiset kenttä testit suoritettu viikkokisoissa ja todettu toimivaksi ja helpoksi tavaksi lisätä viikkokisa tulokset
Toimii nätisti  viikkokisojen tulostensyöttämiseen, toimii myös kisakoneen tasoituksellisen branchin kanssa ( https://github.com/mipoikon/kisakone ) 
Myös tasoitukset lasketaan kierroksista jotka on lisätty tämän kautta

Koodi sisältää pientä purkkaa ja tulee antamaan erroria ainakin seuraavista: LevelID-arvo ja TD:n User.id ei löydy 
tietokannasta, Osaava löytää ja muokkaa omakseen.

Tietokannan PREFIXin muuttamista ei ole koodattu vaan kaikki tietokanta kyselyt ja insertit on kisakone_-prefixille tehty.

##############

1. User-auth rakennettu index.php-tiedoston sisään ja siitä redirectit /pages-kansioon. Käytössä kisakoneen
	käyttäjä-tiedot ja data/config.php-tiedostossa asetetaan pelaajat joilla on viikkokisa oikeudet. Kiitokset tästä Jvuennolle.

2. tulosten syötön nopeuttamiseksi systeemi on rakennettu niin että vain kilpailun kokonais-tulos syötetään pelaajille,
    meillä viikkokisat pidetään metsä radalla ja ajatus on ollut että systeemi ois mahdollisimman helppo TD:lle
    ja tulosten lisääminen onnistuu suoraan puhelimella responsiivisen templaten ansiosta.

3. Kilpailun lisääminen onnistuu nopeasti lomakkeen kautta. vain päivämäärä,aika ja kilpailun nimi lisätään. 
    muut tiedot automaattisesti.

4. Lisää tulokset-lomake listaan kaikki UserPlayerit jotka ovat kisakoneessa(ei TD:n luomia irrallisia Playereitä
   eikä UserPlayereistä parikisa-tunnuksia joissa esiintyy sana "pari" ja meidän käyttöön pari tupla tunnaria poistettu listauksesta suoraan qyeryssä.)
   
   Tulosten lisäämisen jälkeen formi lähettämällä poimitaan pelaajat joilla on scoret välillä 20-200 ja heidän
   ilmoittautumiset,maksut,lohkot,tulokset ymsyms. lisätään automaattisesti, lopuksi kilpailu suljetaan ja 
   tasoitukset lisätään jos radalla on Rating ja slope arvot. Tämän jälkeen scoret on kisakoneessa selattavissa, TD:n hommaan menee varmaan 10-15min.
   
   
##############

   TODO:
  
- Eventin lisäys lomakkeen kehitys niin että voidaan:
            -valita Venue eli paikka
            -Kilpailun TD:n valinta dropdownista ja esivalinta Kirjautuneelle käyttäjälle.
            
- Kenttä testeissä toivottiin että ensin näytettäisiin annetut tulokset ja sitten vasta toteutus,
  kehitetään näin tai sitten rakennetaan tulosten-korjaus-sivu.             
  
