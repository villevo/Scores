<?php include '../include/addScore_eventinfo.php';?>


<?php
// Check connection
if($link == true){
    echo "<span class='ok_score'>Tietokantayhteys OK.</span><br>";
}
?>


  

  
<form class="form-horizontal" action="../pages/scores_stage2.php" method="GET">


  
  <div class="form">
  

 <i> Kilpailut</i>-listassa näkyy kaikki auki olevat viikkokisat JA alle 2viikkoa vanhat viikkokisat tulosten korjausta varten.
  <br>
  <br>
 	<label for='round' class="col-sm-3 control-label">Kilpailu:</label>
	  <div class="form-group">
			<select class="input-sm" id="dropdown_round" name="round_select_stage1"> 
				<option value='no_round'>KILPAILUN NIMI ------- KIERROS PVM+AIKA</option>
					<?php
					
						while($row = $ajankohtaiset_kisat_result->fetch_assoc()){
							$fixedtime = strtotime($row['StartTime']) + 2*60*60;
							$row['FixedStartTime'] = date('d.m.y   H:i', $fixedtime);
							if( $row['ResultsLocked'] == NULL ){
								$result_lock = "";
							}
							else{
								$result_lock = "!***";
							}
							
							echo '
							<option value="'.$row['id'].'"> '.$result_lock.' '. $row['Name'] .' -------   ' . $row['FixedStartTime'].'</option>';
						};
	?>
	</select>
	

  </div>

  <button onclick="return validate_round()" type="submit"  class="btn btn-success btn-lg btn-block">Jatka <i class="fa fa-arrow-right" aria-hidden="true"></i></button>		
  </div>

</form>

<script>

function validate_round()
{
   if(document.getElementById("dropdown_round").value == "no_round")
   {
      alert("KILPAILUA EI VALITTU."); // prompt user
      document.getElementById("dropdown_round").focus(); //set focus back to control
      return false;
   }
}


</script>