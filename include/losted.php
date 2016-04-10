<div class="lostandfound_div">
<?php
// Check connection
if($link == true){
    echo "<span class='ok_score'>Tietokantayhteys OK.</span><br>";
}
?>

<form class="form" role="form" action="../pages/add_losted.php" method="post">
	<table id="lostandfound_table">
		<thead style="background: #9D9D9D;">
			<tr >
				<th class="table_header text-center" style="
    min-width: 33px;
">Rivi</th>
				<th class="table_header text-center">Nimi</th>
							<th class="table_header text-center lost_empty"></th>
				<th class="table_header text-center">numero</th>
							<th class="table_header text-center lost_empty"></th>
				<th class="table_header text-center">muovi</th>
							<th class="table_header text-center lost_empty"></th>
				<th class="table_header text-center">kiekko</th>
							<th class="table_header text-center lost_empty"></th>
			</tr>
		</thead>
		
		<?php 
for ($x = 1; $x <= 10; $x++) {
?>



		<tr>
		
			<td id="lost_field_id">	
				<?php echo $x; ?>
			</td>
			
			
			<td>	
				<input type="text" name='nimi_<?php echo $x; ?>' id='lost_field'>
			</td>

			
<td></td>
						
						
			<td>	
				<input type="number" class="lost_field" name='num_<?php echo $x; ?>' id='lost_field2' >
			</td>

			
<td></td>
			
			
			<td>	
				<input type="text"  class="lost_field" name='muovi_<?php echo $x; ?>' id='lost_field3'>
			</td>
			
<td></td>			

			<td>	
				<input type="text" class="lost_field"  name='kiekko_<?php echo $x; ?>' id='lost_field3'>
			</td>
		
<td></td>		

			
			<input type="hidden" class="lost_field" name='row[<?php echo $x ?>]' id='lost_field' value='<?php echo $x; ?>'>
		</tr>	
		
						<?php
 }    //end of for loop

?>
<tr id="emptyrow">
<td>    </td>
</tr>

	</table>
					  
					  
					  <button type="submit" class="btn btn-success btn-lg btn-block">Lisää löytökiekot</button>	
				</form>
</div>