<!-- ADD SCORES STAGE2 -->



<script type="text/javascript">
    $(window).load(function(){
        $('#locked_modal').modal('show');
    });
</script>

<?php 




include '../include/addScore_eventinfo.php';

// Check connection
if ($_POST['round_select_stage1'] ==  "no_round" or !isset($_POST['round_select_stage1'])) {
			die("<h1>ERROR: Vituiks meni, et valinnut kierrosta! pysäytetty</h1> Palaa takaisin <a href ='../pages/scores.php'> kilpailun valinta-sivulle</a>");
			} else


if($link == true){
    echo "<span class='ok_score'>Tietokantayhteys OK.</span><br>";
}
?>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../js/jquery.filtertable.min.js"></script>

<script>
function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('p.search.filter-table').addClass('stick');
        $('#sticky-anchor').height($('p.search.filter-table').outerHeight());
    } else {
        $('p.search.filter-table').removeClass('stick');
        $('#sticky-anchor').height(0);
    }
}

$(function() {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});

var dir = 1;
var MIN_TOP = 200;
var MAX_TOP = 350;

function autoscroll() {
    var window_top = $(window).scrollTop() + dir;
    if (window_top >= MAX_TOP) {
        window_top = MAX_TOP;
        dir = -1;
    } else if (window_top <= MIN_TOP) {
        window_top = MIN_TOP;
        dir = 1;
    }
    $(window).scrollTop(window_top);
    window.setTimeout(autoscroll, 100);
}


</script>

<form class="form-horizontal" action="../pages/add_scores.php" method="post" onsubmit="return confirm('Onko kaikki scoret laitettu? kaikki lisättävät scoret pitää olla laitettu nyt.');">

  <div class="form">
	<label for='round' class="col-sm-3 control-label">   Valittu kilpailu:</label>
	  <div class="form-group">
			<select class="input-sm" id="dropdown_round" name="round"> 
					
<?php
$r_id = $_POST['round_select_stage1'];

	$query=  "SELECT kisakone_Event.id,
  kisakone_Event.Name,
  kisakone_Event.ResultsLocked,
  kisakone_Round.id,
  kisakone_Round.StartTime
  FROM
  kisakone_Event,
  kisakone_Round
  WHERE
  kisakone_Round.id = $r_id
  AND
  kisakone_Event.id = kisakone_Round.Event
  
  "; // Run your query  
  $get_selected_round = $link->query($query);
						
						while($row = $get_selected_round->fetch_assoc()){
							$fixedtime = strtotime($row['StartTime']) + 2*60*60;
							$row['FixedStartTime'] = date('d.m.y   H:i', $fixedtime);
							if( $row['ResultsLocked'] == NULL ){
								$result_lock = "";
								$result_locked = 0;
							}
							else{
								$result_lock = "!***";
								$result_locked = 1;
							}
							if($row['id'] == $_POST['round_select_stage1']){
						
								echo '
								<option value="'.$row['id'].'"> '.$result_lock.' '. $row['Name'] .' -------   ' . $row['FixedStartTime'].'</option>';
								break;
							}
						};
				echo "</select>";
				if($result_locked == 1){
						echo ' <br><span style="color: red; font-size: small;"> <b>Varoitus:</b> 
						Valittuun kilpailuun on jo syötetty tuloksia, luokka-tiedot pitää antaa uudelleen!
						</span>
						
						
  <!-- Modal -->
  <div class="modal fade" id="locked_modal" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ohjeet</h4>
        </div>
        <div class="modal-body">
			<h2> <i class="fa fa-exclamation-triangle fa-4x" aria-hidden="true" style="color:red;"></i><br>
			Valitsit kierroksen jolta löytyy jo tuloksia</h2>
			
			Nyt voit muuttaa pelattavaa rataa, pelattavia luokkia, lisätä/poistaa pelaajien tuloksia tai muokata pelaajan tulosta.
			<br>
			<ul>
				<li><u>Pelattavat luokat täytyy syöttää uudelleen vaikka ne on alun perin asetettukin</u></li>
				<li>Jos kilpailussa pelattua rataa tai pelattavia luokkia pitää muokata niin valitsemasi valinnat päivittää kilpailun tiedot</li>
				<br>
				<ul><b>Pelaajat ja scoret:</b>
				<li>Pelaajien aikaisemmat tulokset kierrokselta ovat pelaajalistassa valmiina, lista on järjestetty suurimmasta numerosta alaspäin.</li>
				<li> poista pelaajan tulos niin silloin hän tippuu pois kisasta</li>
				<li>lisää pelaajalle tulos niin hänet lisätään kilpailuun</li>
				<li>muokkaa tulosta niin tulos muokataan</li>
				
			</ul>	
		  
		  
		  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Sulje</button>
        </div>
      </div>
      
    </div>
  </div>

';
				}

				

  $selected_course = array_values(mysqli_fetch_array($link->query("
  SELECT
  kisakone_Round.Course
  FROM
  kisakone_Round
  WHERE
  kisakone_Round.id = $r_id limit 1" )))[0];


				
?>

					
  </div>
	<label for='course' class="col-sm-3 control-label">Kierroksella käytettävä rata:</label>
	    <div class="form-group">
		<select class="input-sm" id="dropdown_course" name="course">
			<option value='no_course'>VALITSE RATA Par xx (Rating/Slope)</option>
				<?php
					while($row = $radat_result->fetch_assoc()){
						
					$selected = '> ';
					if ($row["id"] == $selected_course){
						$selected = ' selected> ';
					}
					
					
						echo '<option value="'.$row['id']. '"' .$selected. ' '  . $row['Name']. ' Par ' .$row['par'].'  ---   (' .$row['rating'].'/' .$row['slope']. ')</option>';
					}
				?>
	</select>
  </div>
  	<label for='classes' class="col-sm-3 control-label">Pelattavat luokat</label>
	<div class="form-group">
		
		
		 <table class="classes_table">
		 <tr>
			<th class="classes_th">
			<div class="class_switch">MPO
				<div class="material-switch">
                    <input type="checkbox" id="class_mpo" name="class_mpo" value="1" checked disabled>
                    <label for="class_mpo" class="label-info"></label>
				</div>
				</div>
			</th>

			
						
			<th>
				<div class="class_switch">FPO
					<div class="material-switch">
						<input type="checkbox" id="class_fpo" name="class_fpo" value="1">
						<label for="class_fpo" class="label-danger"></label>
					</div>
				</div>
			</th>
			
		</tr>
		</table>
  
	</div>
	<br>
	<br>

	
	<?php
		$e_id = array_values(mysqli_fetch_array($link->query("SELECT kisakone_Event.id 
		FROM kisakone_Event , 
		kisakone_Round 
		WHERE kisakone_Round.Event = kisakone_Event.id 
		AND 
		kisakone_Round.id = $r_id")))[0];
	



	$pelaajat2 = "
  SELECT
  kisakone_Player.player_id,
  kisakone_Player.Lastname,
  kisakone_Player.Firstname,
  kisakone_User.Username,
  kisakone_Participation.OverallResult AS res
  FROM
    kisakone_User,
  kisakone_Player
  LEFT JOIN 
kisakone_Participation
  ON 
  kisakone_Player.player_id = kisakone_Participation.Player 
  AND
  kisakone_Participation.Event =  $e_id
  WHERE
  kisakone_Player.player_id = kisakone_User.Player
  AND
  kisakone_User.Username is not null
  and
  kisakone_Player.Firstname NOT LIKE 'pari'
  AND
  kisakone_Player.Lastname NOT LIKE 'pari'
  AND
  kisakone_Player.Lastname NOT LIKE 'Pari'
  AND 
  kisakone_Player.Lastname NOT LIKE 'Pari'
  AND
  kisakone_User.id != 709
  AND
  kisakone_User.id != 920
  AND
  kisakone_User.id != 1002
  ORDER BY 
  kisakone_Participation.OverallResult DESC, kisakone_Player.Lastname
  ";
  $players = $link->query($pelaajat2);
  $player_cnt = $players->num_rows;
  
  
  ?>

	<p align=center id=pelaajia>Pelaajia kisakoneessa: <?php echo $player_cnt ?> kpl.</p>
	
	<div id="sticky-anchor"></div>
	<!-- p.search.filter-table  = sticky -->
		<table class="table table-bordered players_table">
		  <thead>
			<tr >
			  <th class="table_header">Nimi</th>
			  <th class="table_header">Score</th>
			</tr>
		  </thead>	
		  
		  <tbody>
		  <?php	   // start players while-loop
			while($row = $players->fetch_assoc()){
          ?>
		  
			<tr>
				<td class="td_player">
					<abbr class="player_abbr"title="player_id: <?php echo $row["player_id"];?> Username: <?php echo $row["Username"];?>">  <?php echo $row["Firstname"];?>  <?php echo $row["Lastname"];?>
					</abbr>		
				</td>
				
				
				<td class="td_score">	
					<input type="tel"  name="score_<?php echo $row["player_id"]; ?>" id="scorefield" max="999" value="<?php echo $row["res"];?>">
				</td>
			</tr>		
			<input type="hidden" name="id[<?php echo $row["player_id"]; ?>]" id="id_[<?php echo $row["player_id"]; ?>]" value="<?php echo $row["player_id"]; ?>">

		  <?php
		  }  // end players while-loop
		  ?>
		  
		  </tbody>

		</table>		
  <button onclick="return validate_course()" type="submit" class="btn btn-success btn-lg btn-block">Lisää tulokset</button>		
  </div>

</form>

		  <script>
			$('table').filterTable(); //if this code appears after your tables; otherwise, include it in your document.ready() code.
		  </script>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});

$(document).ready(function(){

    $('.btn').popover();

    $('.btn').on('click', function (e) {
        $('.btn').not(this).popover('hide');
    });


});


function validate_course()
{
   if(document.getElementById("dropdown_course").value == "no_course")
   {
      alert("RATAA EI OLE VALITTU"); // prompt user
      document.getElementById("dropdown_course").focus(); //set focus back to control
      return false;
   }
}



</script>