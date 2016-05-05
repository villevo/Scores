
<h2> Ohjeet</h2>
<p>
Tämän web-sovelluksen tarkoitus on nopeuttaa viikkokisojen tulosten syöttöä.

<br>
<br>

<h4> Uuden kilpailun tekeminen:</h4>

Jotta tuloksia voidaan syöttää tulee kilpailu olla tehtynä kisakoneeseen, Nopeiten tämä onnistuu valitsemalla valikosta Lisää kilpailu.

Kilpailun lisäämis lomakkeen esiasetetut tiedot:
<ul>
<li>PVM: Tänään</li>
<li>Kellon aika: 18.30</li>
<li>Kilpailun nimi: "Viikkokisa - PVM - Viikkonro"</li>
<li>taso: lukittu</li>
<li>TD: Scoresiin kirjautunut käyttäjä</li>
<li>Paikka: Toramo</li>
</ul>
Muokkaa tiedot oikeiksi ja paina lisää kilpailu. Tämän jälkeen kilpailu on tehty kisakoneeseen ja valmiina tulosten syöttöön.

<h4> Tulosten syöttö</h4>

Tulostensyöttö lisää kaiken kilpailuun liittyvän automaattisesti joten kaikki ilmoittautumiset,maksut,kierrosten valinnat,lohkot,kilpailun lukitsemiset ymsyms. välivaiheet jää pois.<br>

Lyhyesti:
<ul>
	<li><b>1.sivulta valitaan kilpailu.</b></li>
	<li>Paina jatka</li>
</ul>	
<ul>
<li><b>2.sivulta valitaan</b></li>
	<li>Pelattavat luokat,</li>
	<Li>Pelattava rata ja </li>
	<li>scoret pelaajille jotka ovat kilpailussa mukana. </li>
	<li>Paina Lisää tulokset</li>
</ul>
Tulosten muokkaus/pelaajan poistaminen tai lisääminen kilpailuun onnistuu valitsemalla lisää kilpailu-lomakkeen 
1.sivulta kilpailu jossa on jo tuloksia, merkitty <i>!****</i>-etuliitteellä, tällöin kilpailussa jo olevat tulokset listataan
 ensimmäiseksi suurimmasta pienimpään, rata on valmiiksi sama kuin kilpailussa käytetty rata. 
 <u>BUGI/OMINAISUUS: FPO-luokka pitää manuaalisesti valita päälle/pois tuloksia muokattaessa.</u>
 
<h4> yleisiä asioita Scoresissa</h4>
<br>
<ul>
<li><b>Luokat:</b> MPO-luokka pelataan aina, Naisten tulokset ohjataan FPO-luokkaan jos FPO-luokka kytketään päälle. 
<br> Tasoitukset on käytössä kaikissa viikkokilpailuissa(Kisakone näyttää tasoitus-tulokset vain Level 2-tason kilpailuille eli viikkokisat)</li>
<br>
<li><b>Kilpailut:</b> <u>Tulokset lisätään koko kisan kokonaistuloksena.</u> eli jos on esim. kahden kierroksen kisa niin kisakoneessa tulee olla tehtynä rata kahdelle kierrokselle
 esim "Oukku x2 par 60". Viikkokisa radoille suositellaan että väylien lukumääräksi laitetaan 1 ja väylän nimeksi "YHT". 
 Kilpailun tulokset tarkastellaan kisakoneessa Leaderboard sivulla.</li>
<br>
<li><b>Rata:</b> Listassa näkyy kaikki radat mitä kisakoneeseen on laitettu. radan perässä on suluissa tasoituksiin liittyvät tiedot Rating ja Slope esim. (54/80).
<u>Kierrokselta tulevat tasoitukset lasketaan kierrokselta VAIN jos radalle on asetettu rating ja slope-arvot, Ohjeistus on että tasoitetut radat nimetään HCP-alkuisiksi kisakoneessa. </u> lisää tietoa tasoituksista alempana. </li>
<br>
<li><b>Kilpailijat:</b>Listassa näkyy kaikki pelaajat jotka ovat rekisteröityneet kisakoneeseen. Lisää score pelaajan sarakkeeseen. pelaajan etsinnässä on hyvä käyttää apuna listauksen yläpuolella olevaa hakukenttää: syötä pelaajan etu tai sukunimen alkuosa niin listaus näyttää vain pelaajat jotka sopivat hakuun.
Läpäriä käytettäessä on helppo siirtyä sarakkeiden välillä pikanäppäimillä TAB ja SHIFT+TAB.</li>


<br>
<li><b> lisää tulokset-nappi</b> nappi on sivun alalaidassa, saat sen helpoiten esille kun kirjotat muutaman sekalaisen kirjaimen pelaaja-hakukenttään.
Varmista että kaikki tarvittava tieto on annettu eli: Kilpailu,rata ja kaikki tulokset on lisätty. in painat nappia niin lomake tarkistaa vielä että kilpailu ja rata on valittu, lisäksi näppäily virheiden varalta tarkistetaan että kaikki annetut tulokset on hyväksyttävissä rajoissa eli score on 20-200.
Tämän jälkeen kaikki kilpailua ja pelaajia koskevat tiedot lisätään sekä kilpailu suljetaan kisakoneessa. <b>Thats it, scoret löytyy nyt kisakoneesta.</b><br>
Myös tasoitustulokset ja uudet kierrostasoitukset on laskettu uusiksi jos radalle on asetettu Rating-slope-arvot. 
<br><br><br>
</ul>
</p>
<p>

<h2> Tasoitukset</h2>

<h4>Pelaajan Tasoituksen määrittyminen</h4>
  <b> kaava: </b><code>($sum_hcp/$rtu * 0.96)<br></code>

<br>
<br>
<ul>
 <li>Kisakone laskee tasoitukset pelaajan tasoituskierroksista, parhaiden tulosten keskiarvo x 0,96 = pelaajan tasoitus(kahden desimaalin tarkkuudella).<br><br> tasoitusten logiigan kannalta on erittäin tärkeää että kilpailujen/kierrosten päivämäärät ja kilpailun sulkemiset on tehty oikein. tulostensyöttö-sovellus sulkee kilpailun automaattisesti(<code>roundtime + 3h</code>-arvolla) joten TD:n ei tarvi käytännössä huolehtia kuin kierroksen päivämäärä ja kellonaika oikeaksi, helpoiten tämä varmistuu tekemällä kisa kisakoneeseen vasta silloin kun aletaan tuloksia syöttämään.</li>
<li>

Alussa kun kierroksia on vähän niin pelaajan tasoitus on paras kierrostasoitus x 0,96, 4 pelatun kierroksen jälkeen lasketaan keskiarvo kahdesta parhaasta kierroksesta... jnejne ...kun kierroksia on koneessa 20 niin lasketaan 10 parhaan kierroksen keskiarvo. </li>
<li>Maxhcp on asetettu arvoon 26, eli pelaajan maximi tasoitus on 26, tätä isompia pelaaja-tasoituksia kisakone ei anna.
</li>
<br>

<li>Pelaajan tasoitus miinustetaan kilpailun kokonais tuloksesta jolloin saadaan kilpailijan tasoitettu tulos. kisakone listaa leaderboard-sivulle ensin luokkakohtaiset raaka-tulokset jonka jälkeen tasoitus-kisan tulokset. tasatulokset järjestetään tasoituksen mukaan, Suurin tasoitus ylimmäiseksi ja pienin tasoitus alimmaiseksi. Stanging-tieto jää tasatulokseksi, palkintojenjaon kannalta siis Tasatuloksissa ylimmäisenä olijalla on suurin tasoitus ja on 1.palkittavana. <b>Tasatulosten ratkaisu kisakoneen normaali-tulostensyötön kautta ei ole mahdollista vaan tulokset menevät sekaisin</b></li>




<h4>Pelaajan Kierroksilta tulevan tasoituksen määräytyminen</h4>

<li>Kierrokselta tulevan tasoituksen kaava:<br> <code>(Score - Rating) * (80 / Slope)</code> = kierrokselta tuleva tasoitus</li>
<br>
<li><b>Tasoitukset:</b> Kisakoneessa on tasoitukset: Radalle annetaan Rating ja Slope arvot joiden avulla tasoitukset lasketaan. Koska radoille voi asettaa omat rating ja slope arvot niin <u>pelaajien tasoitukset on käytettävissä kaikilla radoilla, Kisakoneessa näkyy tasoitus-kisa aina kun radan tasona on Viikkokisa.</u>

<br>

<li><b>Rating-arvo</b>tarkastellaan ensin kaavan rating arvoa mitä se kuvastaa ja miten se vaikuttaa tasoituksiin.<br>
<br>Rating arvo kuvastaa radan vaikeutta suhteessa radan par lukuun. Toramon radan osalta tämä arvo on 67 eli sama kuin radan par. Eli heität parin niin kierrokselta tulevaksi pelaajan kierrostasoitukseksi tulee 0.<br>
<br>

Helpolla radalla esim. patokoski x2 rating arvo on asetettu arvoon 48(eli par on 54 ja tasoituskiekan 0 tasoituksella saa 48heitolla) <br><br>
Heitätä patokoski x2:lla par 54, joka on  Joka on muuten saakelin paska tulos patikselta. kierrokselta tuleva kierrostasoitus on (54-48) = +6.</li>
<br>

<h4>Lisätään soppaan Slope arvo:</h4>
<li><b>Slope-arvo</b> Kuvastaa radan vaikeutta eli antaa kerrointa lisää/vähemmän kaavaan. jos rata on erittäin helppo = bogia ei tule helposti, joten bogista pitää rangaista pelaajaa tasoituksen muodossa! <br> Patikselta ei tule niin helpolla plussaa kuin toramolta joten tämä asia hoituu asettamalla patokosken radan slope-arvoksi 60 jolloin kaava antaakin edellisen esimerkin mukaisesti seuraavaa (54-48) * (80/60) = +8 </li>
<br>

<li>Ratojen Rating ja Slope arvojen määrittäminen on jokseenkin vaikeaa ja Niiden oikein asettaminen on tärkeää että kierrostulokset on vertailukelpoisia keskenään; edellisten esimerkkien valossa <i>Toramolla heitetty par vs Patokoski x2:lla heitetty +6 joka antoi kierrostasoituksen +8</i> <u>onko nämä vertilukelpoisia tuloksia?</u></li>
</ul>
</p>
