<?php 	


//user auth
if (!(isset( $_SESSION['username']) &&  $_SESSION['username'] != '')) {
	header ("Location: ../index.php");
}



if($link === true){
    echo "Tietokantayhteys OK<br>";
}
if($link === false){
    die("ERROR: config.php: tietokantayhteys vituillaan." . mysqli_connect_error());
}
//$lasketaan errorit muuttujaan...
$err = 0;

//kellonaika poistettu käytöstä timezone ongelman takia...
//muuttujat lomakkeesta
$date =  $_POST["event_date"]; 
$time =  $_POST["event_time"]; 
$name =  $_POST["event_name"]; 
$td_id =  $_POST["event_td_id"]; 
$venue_id =  $_POST["event_venue_id"]; 




echo "
<div class='code-show'>

<h3>Annetut tiedot</h3>
<table class='table_leaderboard table-condensed table table-bordered'>
	<tr>
		<th>
		Kilpailun nimi
		</th>
		<th>
		 VVVV-KK-PP HH:MM
		</th>
	</tr>
	<tr>
		<td>
		$name
		</td>

		<td>
		 $date $time
		</td>
	</tr>
</table>	
</div>";

//timezone korjaus: kello tunnin väärässä ilman tätä:

$fixedtime = strtotime($time) - 2*60*60;

$fix_time = date('H:i', $fixedtime);

echo "timezone fixed-time: $fix_time , näkyy kisakoneessa +2h";



$datetime = "$date $fix_time"; 



echo "


<button class='btn btn-primary btn-xs btn-block'>Näytä/piilota yksityiskohtaiset tiedot</button>


<div class=code>
<h3>Lisätään tietoja kisakoneen kantaan:</h3>
";


$dt= strtotime($datetime);
    echo "Unixtimestamp dt: $dt <br>";



		//lisätään kilpailu kantaan
		$addevent = "INSERT INTO kisakone_Event(Venue, Level, Name, Date, Duration,Activationdate, PlayerLimit)
                            VALUES('$venue_id', 2, '$name', FROM_UNIXTIME($dt), '1' , CURRENT_TIMESTAMP, '200' )";
		if(mysqli_query($link, $addevent)) {
					    $event_id = $link->insert_id;
				
					echo "kilpailu tehty onnistuneesti, kilpailun ID: $event_id 
							<ul>
								<li>Nimi: $name</li>
								<li>Aika: $datetime (fixed Kisakoneessa +2h)</li>
<br>";
				} else {
					$err = $err + 1;
					echo "ERROR: Could not able to execute $addevent. <br>" . mysqli_error($link);
				}

		//lisätään kilpailulle TD
		$addtd = "INSERT INTO kisakone_EventManagement(User,Event,Role)
                            VALUES('$td_id', $event_id, 'td')";
		if(mysqli_query($link, $addtd)) {
					    $em_id = $link->insert_id;
				
					echo "eventmanagement tehty onnistuneesti, eventmanagement ID: $em_id 
							<ul>
								<li>event: $event_id</li>
								<li>TD_ID: $td_id</li>
<br>";
				} else {
					$err = $err + 1;
					echo "ERROR: Could not able to execute $addtd. <br>" . mysqli_error($link);
				}


		//lisätään kilpailulle rundi
		$addtd = "INSERT INTO kisakone_Round(Event,StartType,StartTime, `Interval`, `ValidResults`)
                            VALUES($event_id, 'simultaneous', FROM_UNIXTIME($dt), '10', '1' )";
		if(mysqli_query($link, $addtd)) {
					    $r_id = $link->insert_id;
						
					echo "rundi tehty onnistuneesti, round ID: $r_id 
							<ul>
								<li>event: $event_id</li>
</ul>
</ul>
</ul>
<br>
	
		</div> ";

							
				} else {
					$err = $err + 1;
					echo "ERROR: Could not able to execute $addtd. <br>" . mysqli_error($link);
				}

				
if ($err == 0){
echo "
<br><br>
<div class='well'>
<span class='ok_score'>KILPAILU LISÄTTY ONNISTUNEESTI</SPAN>
							<h2>
						<div class='leaderboards'>
							<div>
								<img src='../images/peukku.png' style='width: 100px;'>
							</div>
							<div>
								Kilpailu Tehty:<br> 
								
								<a href='../pages/scores.php'> Valmiina tulosten syöttöön.</a>
								<br>
								<br>
								<a href = '../../kisakone/kilpailu/$event_id' target='_new'>
								Katso kilpailu kisakoneessa</a>
							</div>
						</div>
					</h2>
</div>					
";
}
if ($err > 0){
	echo "vituiks men, kahto yksityiskohtaiset tiedot";
}


					
mysqli_close($link);
							?>