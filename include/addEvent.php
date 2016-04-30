<form class="form-horizontal" action="../pages/add_event.php" id="lisaaviikkis" method="post">

<?php
// Check connection
if($link == true){
    echo "<span class='ok_score'>Tietokantayhteys OK.</span><br>";
}
include '../include/addScore_eventinfo.php'; 
$logged_in_username = $_SESSION['username'];

?>
			
<div class="form">
   <div class="row">
            <div class="form-group col-xs-6">
                <label for='event_date' class="control-label"> Kilpailun pvm:</label>
				<input type='date' name='event_date' id='event_date' min='2012-01-01' value='<?php echo date('Y-m-d'); ?>' required/>
            </div>

            <div class="form-group col-xs-6">
               <label for='event_time' class="control-label">   Aloitus kellonaika:</label>
				<input type='time' name='event_time' id='event_time' value='18:30'  required/>
            </div>
</div>
  
  <div class="form-group">
	  <label for='event_name' class="col-sm-3 control-label">Kilpailun nimi:</label>
			<input type='text' name="event_name" id="event_name" style="width: 300px;" value="Viikkokisa -  <?php echo date('d.m'); ?> - Viikko <?php echo date('W');?>" />
  </div>
  
  <div class="form-group">
	<label for='event_level'class="col-sm-3 control-label">Level:</label>
		<input type="text" value="2 - Viikkokisa" disabled /> 
  </div>
  <div class="form-group">
	<label for='event_td_id'class="col-sm-3 control-label">Kilpailun TD:</label>
		<select name="event_td_id" id="event_td_id">
<?php	  // start td while-loop

			while($row = $tds->fetch_assoc()){
				$selected = '"> ';
				if ($row["Username"] == $logged_in_username){
					$selected = '" selected> ';
				}
?>
		
				<option  value="<?php echo $row["id"]; echo $selected;  echo $row["Username"]; ?>  </option>
<?php
			 } // end td loop while-loop
?>	
		</select>	
	</div>
	
	
	<div class="form-group">
	<label for='event_venue_id'class="col-sm-3 control-label">Paikka:</label>
		<select name="event_venue_id" id="event_venue_id">
<?php	  // start venue while-loop

			while($row = $venue_result->fetch_assoc()){

?>
		
				<option  value="<?php echo $row["id"]; ?>"><?php  echo $row["Name"]; ?>  </option>
<?php
			 } // end venue loop while-loop
?>	
		</select>	
	</div>
	
	
	
	
<button type="submit" class="btn btn-success btn-lg btn-block">Lisää kilpailu kisakoneeseen</button>
</div>

</form>