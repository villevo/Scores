<div class="well">

<h2>Ohjeet</h2>

<ul>
<li>Jotta tuloksia voidaan syöttää tulee kilpailu olla tehtynä kisakoneeseen, Nopeiten tämä onnistuu valitsemalla valikosta Lisää kilpailu. </li>
<li>Tulostensyöttö lisää kaiken kilpailuun liittyvän automaattisesti joten TD:n tehtäväksi jää ainoastaan uuden kilpailun tekeminen ja tämän kaksisivuisen lomakkeen täyttäminen.<br></li>


<li>Lyhyesti:<br>
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
</div>
