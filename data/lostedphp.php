<?php	

require_once '../data/config.php'; 


// Check connection
if($link === false){
    die("ERROR: config.php: error connectiong to database." . mysqli_connect_error());
}
if($link === true){
	echo "<br>	<span class='ok_score'>tietokantayhteys rolffarit.comin löytökiekko-tauluun OK.</span><br><br><br>";
}

$today = date("d.m.Y"); 

?>


<div class="code-show">
	<table class="table_leaderboard table-condensed table table-bordered" >
	

 
	<thead>
			<tr id="lost_table_header">
				<th class="table_header">Nimi</th>
				<th class="table_header">numero</th>
				<th class="table_header">muovi</th>
				<th class="table_header">kiekko</th>
				<th class="table_header">kantaan</th>				
			</tr>
		</thead>
	
		

			
<?php

mysqli_query($link, "SET NAMES utf8");


	foreach($_POST['row'] as $row_id){			
					$nimi = mysqli_real_escape_string($link,  $_POST["nimi_$row_id"]);     
					$num = mysqli_real_escape_string($link,  $_POST["num_$row_id"]);
					$muovi =  mysqli_real_escape_string($link,  $_POST["muovi_$row_id"]);      
					$kiekko =  mysqli_real_escape_string($link,  $_POST["kiekko_$row_id"]);      
					
					$num = substr($num,0,7);


				


			if($nimi == null && $num == null && $kiekko == null){
				continue;
			}
			
		if(strlen($num) > 6 ) {
	
		//if($num != null){
		$num = "$num***";
	}

					
		echo "
				<tr>
					<td>$nimi</td>
					<td>$num</td>
					<td>$muovi</td>
					<td>$kiekko</td>
				";
//lisätään tietoa kantaan:


		$insert = "INSERT INTO loytoboxi(date, nimi, puhelin, muovi, kiekko)
                            VALUES('$today', '$nimi' , '$num' , '$muovi' , '$kiekko' )";
		if(mysqli_query($link, $insert)) {			
					echo "<td><span class='ok_score'>Ok</span></td>";
				} else {
					
					echo "<td><ei mennyt../td>";
				}		
					
				echo "</tr>";	


	}

mysqli_close($link);

?>
	
	</table>


		
</div>
</div>

 <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Side Widget Well -->
					<div class='well'>
						<div class='leaderboards'>
							<div>
								<img src='../images/peukku.png' style='width: 100px;'>
							</div>
							<div>
	
	
								<a href='http://rolffarit.com/index.php/loytokiekot'> Löytökiekot lisätty <br> Siirry löytökiekkoihin</a>

							</div>
						</div>
					
				</div>
				
				
				