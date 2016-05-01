<?php include '../include/addScore_eventinfo.php';?>


<?php
// Check connection
if($link == true){
    echo "<span class='ok_score'>Tietokantayhteys OK.</span><br>";
}
?>


  

  
<form class="form-horizontal" action="../pages/scores_stage2.php" method="post">


  
  <div class="form">
  
    <div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:33%">
      Tulosten lisääminen kohta 1/3
    </div>
  </div>
  Kilpailut listassa näkyy kaikki kilpailut jotka eivät ole <i>suljettu</i> JA <i>suljeista</i> kilpailuista kilpailut joiden päivämäärä on alle 2 viikkoa.
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

  <button type="submit" class="btn btn-success btn-lg btn-block">Jatka <i class="fa fa-arrow-right" aria-hidden="true"></i></button>		
  </div>

</form>
</script>