<div class="well">

<h2>Ohjeet</h2>

<ul>
<li>Jotta tuloksia voidaan syöttää tulee kilpailu olla tehtynä kisakoneeseen, Nopeiten tämä onnistuu valitsemalla valikosta Lisää kilpailu. </li>
<li>Tulostensyöttö lisää kaiken kilpailuun liittyvän automaattisesti joten TD:n tehtäväksi jää ainoastaan uuden kilpailun tekeminen ja tämän lomakkeen täyttäminen.<br></li>


<li>Lyhyesti: Riittää kun valitset<br>
	<ul>
		<li>Pelattavat luokat,</li>
		<li>Kilpailun(=kierros),</li>
		<Li>Pelattava rata ja </li>
		<li>scoret pelaajille jotka ovat kilpailussa mukana. </li>
	</ul>
</li>
<br>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal">Lue Lisää</button>

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
