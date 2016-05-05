

<p><strong>Kilpailun lisääminen, ohjeet:</strong>
</p>




Tasoituksien kannalta on tärkeää että päivämäärä ja kellonaika tulee oikein.<br>
<br>
esiasetetut tiedot:
<ul>
<li>PVM: tänään</li>
<li>Kellon aika: 18.30</li>
<li>Kilpailun nimi: "Viikkokisa - PVM - Viikkonro"</li>
<li>taso: lukittu</li>
<li>TD: Scoresiin kirjautunut käyttäjä</li>
<li>Paikka: Toramo</li>
</ul>

Muokkaa tiedot oikeiksi ja paina lisää kilpailu
<br>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal">Lue koko ohjeet</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ohjeet</h4>
        </div>
        <div class="modal-body">
				<?php include '../include/addScore_helplong.php';?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Sulje</button>
        </div>
      </div>
      
    </div>
  </div>