





<form class="form-horizontal" action="../pages/add_event.php" id="lisaaviikkis" method="post">

<?php
// Check connection
if($link == true){
    echo "<span class='ok_score'>Tietokantayhteys OK.</span><br>";
}
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
	<label for='event_name'class="col-sm-3 control-label">Level:</label>
		<input type="text" value="2 - Viikkokisa" disabled /> 
  </div>
  
<button type="submit" class="btn btn-success btn-lg btn-block">Lisää kilpailu kisakoneeseen</button>
</div>
</form>