<?php include '../include/addScore_eventinfo.php';?>

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

<?php
// Check connection
if($link == true){
    echo "<span class='ok_score'>Tietokantayhteys OK.</span><br>";
}
?>

  
  

  
<form class="form-horizontal" action="../pages/add_scores.php" method="post" onsubmit="return confirm('Onko kaikki scoret laitettu? kaikki lisättävät scoret pitää olla laitettu nyt.');">

  <div class="form">
 
                       

				
				
				
  
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


	<label for='round' class="col-sm-3 control-label">   Kilpailu</label>
	  <div class="form-group">
			<select class="input-sm" id="dropdown_round" name="round"> 
				<option value='no_round'>VALITSE KIERROS vvvv-kk-pp hh:mm</option>
					<?php
						while($row = $kisat_result->fetch_assoc()){
							$fixedtime = strtotime($row['StartTime']) + 2*60*60;
							$row['FixedStartTime'] = date('d.m.y   H:i', $fixedtime);
							

							echo '<option value="'.$row['id'].'">'. $row['Name'] .' -------   ' . $row['FixedStartTime'].'</option>';
						};
					?>
	</select>
  </div>
  

	<label for='course' class="col-sm-3 control-label">Kierroksella käytettävä rata:</label>
	    <div class="form-group">
		<select class="input-sm" id="dropdown_course" name="course">
			<option value='no_course'>VALITSE RATA Par xx (Rating/Slope)</option>
				<?php
					while($row = $radat_result->fetch_assoc()){
						echo '<option value="'.$row['id'].'">'  . $row['Name']. ' Par ' .$row['par'].'  ---   (' .$row['rating'].'/' .$row['slope']. ')</option>';
					}
				?>
	</select>
  </div>
  


	<p align=center id=pelaajia>Pelaajia kisakoneessa: <?php echo $row_cnt ?> kpl.</p>
	
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
		  <?php	  // start players while-loop
			while($row = $result->fetch_assoc()){
          ?>
		  
			<tr>
				<td class="td_player">
					<abbr class="player_abbr"title="player_id: <?php echo $row["player_id"];?> Username: <?php echo $row["Username"];?>">  <?php echo $row["Firstname"];?>  <?php echo $row["Lastname"];?>
					</abbr>		
				</td>
				
				
				<td class="td_score">	
					<input type="tel"  name="score_<?php echo $row["player_id"]; ?>" id="scorefield" max="999" value="">
				</td>
			</tr>		
			<input type="hidden" name="id[<?php echo $row["player_id"]; ?>]" id="id_[<?php echo $row["player_id"]; ?>]" value="<?php echo $row["player_id"]; ?>">

		  <?php
		  }  // end players while-loop
		  ?>
		  
		  </tbody>

		</table>		
  <button type="submit" class="btn btn-success btn-lg btn-block">Lisää tulokset</button>		
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



</script>