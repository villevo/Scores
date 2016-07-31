<script type="text/javascript">
    $(window).load(function(){
        $('#OK_modal').modal('show');
    });
</script>		


<?php 
//user auth

if (!(isset( $_SESSION['username']) &&  $_SESSION['username'] != '')) {
	header ("Location: ../index.php");
}


//aika-laskuri
$time1 = microtime(true);


require_once '../data/config.php';

// $error-muuttujalla lasketaan tämän sivun suorittamisessa tapahtuneet virheet yhteen ja näytetään lopussa jos on tarpeen
$error = 0;

//varmistetaan että kierros ja rata on valittu.
echo "


<h3>Tarkastetaan annettuja kilpailu- ja rata-tiedot:<br></h3>";
    if ($_POST['round'] ==  "no_round") {	
		die("<h1>ERROR: Vituiks meni, et valinnut kierrosta! pysäytetty</h1> Paina selaimen takaisin nappia ja valitse kierros");
    } else {
        echo "<div class='code-show'>rundi ok, jatketaan...<br>";
    }
    if ($_POST['course'] ==  "no_course" or "") {
		die("<h1>ERROR: Vituiks meni, rata puuttuu.....pysäytetty</h1> Paina selaimen takaisin nappia ja valitse rata.");
    } else {
        echo "rata ok, jatketaan...<br>";
    }
//lasketaan ja tarkistetaan moneltako pelaajalta löytyy Hyväksytty ja hylätty score:
//jos hylätty score niin ERROR,DIE ja ohjeet palata tulosten syöttöön.
$count = 0;
$nocount = 0;
$dnf_count = 0;
	foreach($_POST['id'] as $pid){
					$score = $_POST["score_$pid"];
								if ($score < 1){
									continue;
								}
								
								
								if ($score >  "20" and $score < "200" OR $score == 999) {
									$count = $count +1;
									if ($score == 999){
										$dnf_count = $dnf_count +1;
									}
								}	
								else {
									$nocount = $nocount +1;
								}
									
	}
	
	echo "<b>Syötettyjen scorejen kappalemäärät:</b><br>
	      <span class='ok_score'>Hyväksytyt: $count kpl</span><span class='dnf_score'>Denffaajat: $dnf_count kpl</span>  <span class='no_score'>Hylätyt: $nocount kpl</span><br>  
		  ";
		  
	if ($nocount > "0"){
		    die(" <span class='err_score'> ERROR: Vituiks meni, Joku annettu score ei ole hyväksytyissä rajoissa... 20-200 scoret hyväksytään. <br>Paina selaimen takaisin nappia ja tarkista scoret</span> ");
			} 
			else {
				echo " <br><span class='ok_score'>ei hylättyjä scoreja, jatketaan....</span>";
			}
	if ($count == 0) {
		die("<span class='err_score'><br>ERROR: Vituiks män... ei hyväksyttyjä scoreja...</span>");
	}		

		  
echo "
<hr>
</div>
<div id='loading'>
 	<img src='../images/loadinganimation.gif' style='width: 50px;'> Tietoja käsitellään, odota rauhassa....
</div>
";

		
		// ----  tiedot lomakkeesta -----

		$round = mysqli_real_escape_string($link, $_POST['round']);
		$course_id = mysqli_real_escape_string($link, $_POST['course']);

		// FPO-luokka lomakkeesta:
		if (isset($_POST['class_fpo'])){
			$classes_fpo = 1;
			$echo_classe_enabled = "MPO,FPO";
		}else{
			$classes_fpo = 0;
			$echo_classe_enabled = "MPO";
		}

		//käsitellään lomakkeesta saatuja tietoja jotta saadaan muutama muuttujaa lisää
		//Radan rating ja slope arvot mukaan tulevaisuutta varten jos tasoitukset saadaan joskus lisättyä koneeseen.
	$course = array_values(mysqli_fetch_array($link->query("SELECT kisakone_Course.Name FROM kisakone_Course WHERE kisakone_Course.id = $course_id")))[0];
	$course_par = array_values(mysqli_fetch_array($link->query("SELECT Sum(kisakone_Hole.Par) AS par
FROM kisakone_Course
LEFT JOIN kisakone_Hole
ON kisakone_Course.id = kisakone_Hole.Course
WHERE
kisakone_Course.id = $course_id
GROUP BY
kisakone_Course.Name")))[0];	

	$course_hole1_id = array_values(mysqli_fetch_array($link->query("SELECT id FROM kisakone_Hole WHERE kisakone_Hole.Course = $course_id and HoleNumber = 1 limit 1" )))[0];
	$round_starttime = array_values(mysqli_fetch_array($link->query("SELECT kisakone_Round.StartTime FROM  kisakone_Round WHERE kisakone_Round.id = $round")))[0];
		$event_id = array_values(mysqli_fetch_array($link->query("SELECT kisakone_Event.id FROM kisakone_Event , kisakone_Round WHERE kisakone_Round.Event = kisakone_Event.id AND kisakone_Round.id = $round")))[0];
	$event_name = array_values(mysqli_fetch_array($link->query("SELECT kisakone_Event.name FROM kisakone_Event , kisakone_Round WHERE kisakone_Round.Event = kisakone_Event.id AND kisakone_Round.id = $round")))[0];
	$course_rating = array_values(mysqli_fetch_array($link->query("SELECT coalesce(kisakone_CourseRating.Rating, 0) AS rating FROM kisakone_Course LEFT JOIN kisakone_CourseRating ON kisakone_Course.id = kisakone_CourseRating.Course where kisakone_Course.id = $course_id")))[0];
	$course_slope = array_values(mysqli_fetch_array($link->query("SELECT coalesce(kisakone_CourseRating.Slope, 0) AS slope FROM kisakone_Course LEFT JOIN kisakone_CourseRating ON kisakone_Course.id = kisakone_CourseRating.Course where kisakone_Course.id = $course_id")))[0];
	

//Käytetään lopussa kilpailun sulku aikana!
$fixed_time = strtotime($round_starttime) + 3*60*60;
$round_endtime = date('Y-m-d H:i', $fixed_time);

	echo " <div class= 'code-show'>
				<b>lomakkeen kautta saadut kilpailu-tiedot, suppeasti:</b> 
				<ul>
					<li>Pelattavat luokat $echo_classe_enabled</li>
					<li>Kilpailun nimi:$event_name </li>
					<li>Kierroksen lähtöaika: $round_starttime  ->  $round_endtime </li>					
					<ul>
						<li>Radan nimi $course</li>
						<li>Radan par: $course_par</li>		
						<li><b>radan tasoitus tiedot</b></li>
						<ul>
							<li>Radan rating: $course_rating</li>
							<li>Radan slope: $course_slope</li>
						</ul>
				</ul>
			</div>	
		";

		
		//Tämä DIVi ja BUTTON piilottaa tiedot napin alle
		
		echo "
	<button class='btn btn-primary btn-md btn-block'>Näytä/piilota yksityiskohtaiset tiedot</button> 
		<div class='code'>";

	echo " <div class= 'code-show'>
				<b>lomakkeen kautta saadut kilpailu-tiedot:</b> 
				<ul>
					<li>Pelattavat luokat $echo_classe_enabled</li>
					<li><b>Kilpailun ID-numero: $event_id </b></li>
					<ul>
						<li>Kilpailun nimi:$event_name </li>
						<li>Kierroksen id: $round </li>
						<li>Kierroksen lähtöaika: $round_starttime </li>
						<li>Kierroksen lopetusaika: $round_endtime </li>					
					</ul>
					<li><b>Radan id: $course_id</b></li>
					<ul>
						<li>Radan nimi $course</li>
						<li>Radan par: $course_par</li>
						<li>Radan 1.väylän id: $course_hole1_id</li>					
						<li><b>radan tasoitus tiedot</b></li>
						<ul>
							<li>Radan rating: $course_rating</li>
							<li>Radan slope: $course_slope</li>
						</ul>
					</ul>	
				</ul>
			</div>	
		";



		//kaiken vanhan tiedon poisto kannasta:
		
echo "

	<div class='code-show'><h3><b>poistetaan  kilpailun vanhat tiedot:</b><br></h3>";
	
	
	
	$sql = "
DELETE kisakone_HoleResult.* FROM 
kisakone_HoleResult, kisakone_RoundResult 
WHERE
kisakone_HoleResult.RoundResult = kisakone_RoundResult.id 
AND
kisakone_RoundResult.Round = $round";
			if ($link->query($sql) === TRUE) {
				echo "Väylätuloset, ";
			} else {
				echo "Error deleting record: " . $link->error;
				$error += 1;
			}
			
	$sql = "
DELETE kisakone_RoundResultHandicap.* FROM
kisakone_RoundResult, kisakone_RoundResultHandicap
WHERE
kisakone_RoundResultHandicap.RoundResult = kisakone_RoundResult.id 
and
kisakone_RoundResult.Round = $round
";
			if ($link->query($sql) === TRUE) {
				echo "tasoituskierrokset, ";
			} else {
				echo "Error deleting record: " . $link->error;
				$error += 1;
			}			
			
			
$sql = "DELETE FROM kisakone_RoundResult WHERE kisakone_RoundResult.Round = $round";
			if ($link->query($sql) === TRUE) {
				echo "kierrostulokset, ";
			} else {
				echo "Error deleting record: " . $link->error;
				$error += 1;
			}
			
				$sql = "DELETE FROM kisakone_Participation WHERE kisakone_Participation.Event = $event_id";
			if ($link->query($sql) === TRUE) {
				echo "ilmoittautumiset, ";
			} else {
				echo "Error deleting record: " . $link->error;
				$error += 1;
			}
			
			
$sql = "
DELETE kisakone_StartingOrder.* FROM kisakone_Section, kisakone_StartingOrder 
WHERE 
kisakone_StartingOrder.Section = kisakone_section.id 
AND
kisakone_Section.Round = $round
";
			if ($link->query($sql) === TRUE) {
				echo "Starting_order,  ";
			} else {
				echo "Error deleting record: " . $link->error;
				$error += 1;
			}
$sql = "DELETE FROM kisakone_Section WHERE kisakone_Section.Round = $round";
			if ($link->query($sql) === TRUE) {
				echo "lohkot, ";
			} else {
				echo "Error deleting record: " . $link->error;
				$error += 1;
			}
$sql = "DELETE FROM kisakone_ClassInEvent WHERE kisakone_ClassInEvent.Event = $event_id";
			if ($link->query($sql) === TRUE) {
				echo "kilpailun luokat. ";
			} else {
				echo "Error deleting record: " . $link->error;
				$error += 1;
			}


//------------  VANHAT KILPAILU TIEDOT POISTETTU TIETOKANNASTA, ALETAAN LISÄÄMÄÄN UUTTA TIETOA ----------

echo "<h3><b>Aloitetaan tietojen lisääminen tietokantaan:</b><br></h3>------------------------------------------------------------------------------------------------------<br>Kilpailua koskevien tietojen lisääminen:";




// radan lisäys kilpailulle
	$rata = "UPDATE kisakone_Round SET Course='$course_id' WHERE id=$round";		
		if(mysqli_query($link, $rata)){
				echo " <ul><li>rata lisätty kilpailulle: $course_id</li>";
			} else{
				echo "ERROR: Rataa ei voitu lisätä kilpailulle. $rata. " . mysqli_error($link);
				$error += 1;
			}
//lohko
	
			$lohko = "INSERT INTO kisakone_Section(Round, Classification, Name, Present)
                            VALUES($round, 1, 'Lohko1', 1)";
		if(mysqli_query($link, $lohko)) {
					    $section_id = $link->insert_id;
				
					echo "<li>Lohko tehty onnistuneesti Lohkon ID: $section_id </li>";
				} else {
					echo "ERROR: Lohkoa ei voitu lisätä kilpailulle $lohko. <br>" . mysqli_error($link);
					$error += 1;
				}

//pelattavat luokat
			//mpo luokan lisääminen
			$mpo = "INSERT INTO kisakone_ClassInEvent(Classification, Event)
                            VALUES('21', $event_id)";
		if(mysqli_query($link, $mpo)) {
					    $mpo_class_id = $link->insert_id;
				
					echo "<li>MPO-luokkalisätty, classinevent_id: $mpo_class_id </li>";
				} else {
					echo "ERROR: Luokkaa ei voitu lisätä kilpailulle $mpo. <br>" . mysqli_error($link);
					$error += 1;

				}
			//Fpo loukan lisääminen, jos lomakkeesta valittu FPO
			
			if ($classes_fpo == 1){
		$fpo = "INSERT INTO kisakone_ClassInEvent(Classification, Event)
                            VALUES('22', $event_id)";
		if(mysqli_query($link, $fpo)) {
					    $fpo_class_id = $link->insert_id;
				
					echo "<li>FPO-luokkalisätty, classinevent_id: $fpo_class_id </li></ul><br>";
				} else {
					echo "ERROR: Luokkaa ei voitu lisätä kilpailulle $fpo. <br>" . mysqli_error($link);
					$error += 1;

				}	

			}
		  
	echo "---------------------------------------------------------------<br>
		  ---------- KILPAILIJOIDEN SCORET -----------<br>
		  ---------------------------------------------------------------<br><br>";
		
	
	
//siinä oli kierrostakoskevat asiat, sitten otetaan pelaaja kohtaiset insertit
			foreach($_POST['id'] as $pid){
					$score = $_POST["score_$pid"];
								
						// Hypätään yli kaikki pelaajat joiden score on alle 20 tai yli 200
						if ($score <  "20" OR $score > "200" AND $score !=999) {
						continue; }
												
						$result = "SELECT * FROM kisakone_Player,kisakone_User where player_id = $pid and kisakone_Player.player_id = kisakone_User.Player";
								
								
								
					
				if($row = mysqli_fetch_assoc(mysqli_query($link, $result))) {
					$p_firstname = $row['firstname'];
					$p_lastname = $row['lastname'];
					$p_club = $row['Club'];
					$p_sex = $row['sex'];
				}
				else {
					die("ei pelaajaa");
					$error += 1;
				}
				
				if ($score == 999){
					$dnf = 1;
					$completed = 0;
				}
				else {
					$dnf = 0;
					$completed = 1;
				}

echo "
<ul class='player-divider'></ul><br>
<table class='table table-bordered table-condensed table_player' >
  <tr>
    <td colspan=6> $p_firstname $p_lastname </td>	
  
  
  
  </tr>
  <tr>
    <th>Id</th>
	<th>Sex</th>
	<th>Club</th>
    <th>Score</th>
	<th>DNF</th>

  </tr>
   <tr>
    <td>$pid</td>
	<td>$p_sex</td>
    <td>$p_club</td>
	<td>$score</td>
	<td>$dnf</td>

  </tr>
</table>";

							
							
	//PELAAJAN ILMOITTAUTUMINEN KILPAILUUN:
	//
	// - Iffaillaan miehet $classinevent MPO = 21 ja naiset FPO = 22
	// - Tehdään muuttujat seuran asettamiseen: $club_setting = clumni ja $club_setting2 = value.    ( Arvoja käytetään suoraan mysql insertissä $parti )

if ($classes_fpo == 1){	
	if($p_sex === "male"){
		$classinevent = 21;
	}
	else {
		$classinevent = 22;
	}
}
else {
	$classinevent = 21;
}	

//Tehdään muuttujat Clubin asettamiseen, $club_setting = clumni ja $club_setting2 = value
	if($p_club > 0 ){
		$club_setting = ", Club";
		 $club_setting2 =", $p_club ";
	}
	else {
		$club_setting = "";
		$club_setting2 = "";
	}

							$parti = "INSERT INTO kisakone_Participation (Player, Event, Classification, Approved,EventFeePaid,OverallResult, DidNotFinish $club_setting)
												VALUES ($pid, $event_id, $classinevent,1,NOW(),$score,$dnf $club_setting2)";
										
							if(mysqli_query($link, $parti)){
										$parti_id = $link->insert_id;
							echo "<ul><li>Ilmoittautuminen id: $parti_id</li>
										<li>Luokka $classinevent</li>";
								} else{
							echo "ERROR: Ilmoittautumista ei voitu lisätä pelaajalle pid = $pid $parti. " . mysqli_error($link);
							$error += 1;
				}
	
		//lähtöjärjestys kierrokselle	
						
							$starting_order = "INSERT INTO kisakone_StartingOrder (Player, Section, StartingTime, StartingHole, GroupNumber)
									VALUES ($pid, $section_id, NOW(), 1, 1)";
							if(mysqli_query($link, $starting_order)){
									$starting_order_id = $link->insert_id;
							echo "<li>lähtöjärjestys id:  $starting_order_id</li>";
								} else{
							echo "ERROR: Could not able to execute $starting_order. " . mysqli_error($link);
							$error += 1;
							} 

							if ($score > 1 and $score !=999){
							$score_plusminus = $score - $course_par;
							}
							else {
							$score_plusminus = 0;								
							}

	// ITSE SCOREN LAITTAMINEN TIETOKANTAAN:
	
	

								$insert_score = "INSERT INTO kisakone_RoundResult (Round, Player,Result,SuddenDeath, Completed, DidNotFinish, PlusMinus, LastUpdated, CumulativePlusminus, CumulativeTotal)
															VALUES	($round, $pid, $score, 0, $completed, $dnf, $score_plusminus, NOW(), $score, $score)";
								if(mysqli_query($link, $insert_score)){
									$rr_id = $link->insert_id;
							echo "	<li>Lisätty tulos: $score </b></li>
									<li>kierrostuloksen id:  $rr_id</li>
									";
							//Lisätään tulos vielä holeresulttiin ni näyttää nätiltä..
								//DNF FIX
								}
										$insert_hole_result ="INSERT INTO kisakone_HoleResult (Hole, RoundResult, Player, Result, DidNotShow)
															VALUES	($course_hole1_id, $rr_id, $pid, $score, $dnf)";
										if(mysqli_query($link, $insert_hole_result)){
											$hr_id = $link->insert_id;
											echo "	<li>HoleResult lisätty</li>
													<li>hr_id:  $hr_id</li>
													</ul>";
										} else{
											echo "ERROR: Kierrostulosta ei voitu lisätä PID = $pid score = $insert_hole_result. " . mysqli_error($link);
											$error += 1;
										}
							
							

							
			} //pelaajien foreach loppuu


	echo '

	<div>
		<div class="leaderboards">
			<div class="mpo-board">';

				
				
				
				
				
//  ----------------------------------  RAAKATULOS LEADERBOARD  ALKAA printti vasemmalle----------------------------
//MPO-standings:

$mpo_scoret = "SELECT
kisakone_RoundResult.Result as score,
kisakone_Player.lastname as lastname,
kisakone_RoundResult.Player as p_id,
kisakone_RoundResult.Round as r_id,
kisakone_RoundResult.Round as r_id,
kisakone_RoundResult.DidNotFinish as r_dnf,
kisakone_Event.id as e_id
from
kisakone_RoundResult,
kisakone_Round,
kisakone_Event,
kisakone_Player,
kisakone_Participation
where
kisakone_Round.id = kisakone_RoundResult.Round
and
kisakone_Round.Event = kisakone_Event.id
and
kisakone_Event.id = $event_id
and
kisakone_RoundResult.Player = kisakone_Player.player_id
and
kisakone_Participation.Event = kisakone_Event.id
and
kisakone_Participation.Player = kisakone_Player.player_id
and
kisakone_Participation.Classification = 21
ORDER BY
kisakone_RoundResult.DidNotFinish,
kisakone_RoundResult.Result


";






if( mysqli_query($link, $mpo_scoret)){
				echo "
				<h3>MPO-leaderboard:</h3>";
			} else{
				echo "ERROR: Could not able to execute $mpo_scoret. " . mysqli_error($link);
				$error += 1;
			}
			

echo '
<div class="code-show">
<table class="table_leaderboard table-condensed table table-bordered">
  <tr>
	<td>#</td>
    <td>score</td>
    <td>lastname</td>		
    <td>p_id</td>

  </tr>';
  
  
  
  
// $rs = realstanding. joka nousee yhdellä silmukan sisällä
$s = 1;
$rs = 0;
$last = 0;


$mpo_sorted_scores = $link->query($mpo_scoret);
$count_mpo = mysqli_num_rows($mpo_sorted_scores);

        while($row = $mpo_sorted_scores->fetch_assoc()){
					 $e = $row['e_id'] ;
					 $p = $row['p_id'];
					 $r = $row['r_id'];
	
			
			//real standing
			$rs = $rs + 1;
			if($last < $row['score']){
				//fixed standing:
				
				//iffaus koska jos 1.sija on jaettu niin s=rs=0
				if($rs >0){ 
				$s = $rs;
				}
			}
			$last = $row['score'];
			

				
					echo '
						<tr>
							<td>'.$s.'</td>
							<td>'.$row['score'].'</td>	
							<td>'.$row['lastname'].'</td>
							<td>'.$row['p_id'].'</td>

						</tr>';

  			
			 
		
			//pelaajan ilmoittautumistiedon päivitys standingillä:
							$mpo_jarjestys = "UPDATE kisakone_Participation set Standing= $s where player = $p and event = $e";		
							if(mysqli_query($link, $mpo_jarjestys)){
							}else{
								echo "ERROR: Could not able to execute $mpo_jarjestys. " . mysqli_error($link);
								$error += 1;
								}
							
							if($row['r_dnf'] == 1){
							$dnf_leaderboard_score_fix = "UPDATE kisakone_RoundResult set Result = 0 where player = $p and Round =  $r";		
							if(mysqli_query($link, $dnf_leaderboard_score_fix)){
							}else{
								echo "ERROR: Could not able to execute $dnf_leaderboard_score_fix. " . mysqli_error($link);
								$error += 1;
							}
							}
							
}


echo " 
		</table>
		mpo-standing lisätty $count_mpo  pelaajalle
			</div>
			</div>
				<div class='fpo-board'>";


//FPO-standings:
$fpo_scoret = "SELECT
kisakone_RoundResult.Result as score,
kisakone_Player.lastname as lastname,
kisakone_RoundResult.Player as p_id,
kisakone_RoundResult.Round as r_id,
kisakone_RoundResult.Round as r_id,
kisakone_RoundResult.DidNotFinish as r_dnf,
kisakone_Event.id as e_id
from
kisakone_RoundResult,
kisakone_Round,
kisakone_Event,
kisakone_Player,
kisakone_Participation
where
kisakone_Round.id = kisakone_RoundResult.Round
and
kisakone_Round.Event = kisakone_Event.id
and
kisakone_Event.id = $event_id
and
kisakone_RoundResult.Player = kisakone_Player.player_id
and
kisakone_Participation.Event = kisakone_Event.id
and
kisakone_Participation.Player = kisakone_Player.player_id
and
kisakone_Participation.Classification = 22
ORDER BY
kisakone_RoundResult.DidNotFinish,
kisakone_RoundResult.Result


";

if( mysqli_query($link, $fpo_scoret)){
				echo "
				<h3>FPO-Leaderboard:</h3>";
			} else{
				echo "ERROR: Could not able to execute $fpo_scoret. " . mysqli_error($link);
				$error += 1;
			}
			

echo '
<div class="code-show">
<table class="table_leaderboard table-condensed table table-bordered">
  <tr>
	<td>#</td>
    <td>score</td>
    <td>lastname</td>		
    <td>p_id</td>

  </tr>';
  
  
  
  
// $rs = realstanding. joka nousee yhdellä silmukan sisällä
$s = 1;
$rs = 0;
$last = 0;


$fpo_sorted_scores = $link->query($fpo_scoret);
$count_fpo = mysqli_num_rows($fpo_sorted_scores);

        while($row = $fpo_sorted_scores->fetch_assoc()){
				 $e = $row['e_id'] ;
					 $p = $row['p_id'];
					 $r = $row['r_id'];
				
			//real standing
			$rs = $rs + 1; 
			if($last < $row['score']){
				//fixed standing:
				
				//iffaus koska jos 1.sija on jaettu niin s=rs=0
				if($rs >0){ 
				$s = $rs;
				}
			}
			$last = $row['score'];
			

				
					echo '
						<tr>
							<td>'.$s.'</td>
							<td>'.$row['score'].'</td>	
							<td>'.$row['lastname'].'</td>
							<td>'.$row['p_id'].'</td>

						</tr>';

			//pelaajan ilmoittautumistiedon päivitys standingillä:
							$fpo_jarjestys = "UPDATE kisakone_Participation set Standing= $s where player = $p and event = $e";		
							if(mysqli_query($link, $fpo_jarjestys)){
							}else{
								echo "ERROR: Could not able to execute $fpo_jarjestys. " . mysqli_error($link);
								$error += 1;
								}
							
							if($row['r_dnf'] == 1){
							$dnf_leaderboard_score_fix = "UPDATE kisakone_RoundResult set Result = 0 where player = $p and Round =  $r";		
							if(mysqli_query($link, $dnf_leaderboard_score_fix)){
							}else{
								echo "ERROR: Could not able to execute $dnf_leaderboard_score_fix. " . mysqli_error($link);
								$error += 1;
							}
							}
							
}

echo " 
			</table>
			<br> FPO-standing lisätty $count_fpo  pelaajalle
		</div>
	</div>
</div>
</div> <!-- yksityiskohdat piiloon-->"; 






			
			
			
echo ' 
</div> 
</div>
</div>
 <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Side Widget Well -->
			';

// lopuksi suljetaan kilpailu kisakoneessa, kaikki tarvittava tieto on nyt kisakoneessa. roundresulthandicap laitetaan tämän jälkeen.
	$close_event = "UPDATE kisakone_Event SET ResultsLocked = '$round_endtime' WHERE id = $event_id";		
		if(mysqli_query($link, $close_event)){
				echo "
					      <span class='ok_span'>Kierros suljettu onnistuneesti.</span><br>
				
			";
			} else{
				echo "ERROR: Could not able to execute $close_event. " . mysqli_error($link);
				$error += 1;
			}			
			
			// __ -- ** HCP ** -- __
      // (re-)calculate roundresult handicaps when event is closed 
	$result = mysqli_query($link,"
	SELECT 
	kisakone_RoundResult.id,
	DidNotFinish,
	Course,
	Result,
	kisakone_RoundResult.player,
	kisakone_Player.firstname,
	kisakone_Player.lastname
	FROM 
	kisakone_RoundResult,kisakone_Round,kisakone_Player
	WHERE 
	ROUND=kisakone_Round.id 
	AND 
	kisakone_RoundResult.Player = kisakone_Player.player_id 
	AND
	kisakone_Round.id= $round"
	) or die(mysql_error());


		$hcp_counter = 0;
		$hcp_dnf_counter = 0;
		
      foreach ($result as $row) {

	  	$dnf = $row['DidNotFinish'];
	  	$course = $row['Course'];
	  	$id = $row['id'];
		$pid = $row['player'];
		$p_fist = $row['firstname'];
		$p_last = $row['lastname'];
		$score = $row['Result'];
	//poikki jos dnf
       	if ($dnf == 1) {
			$hcp_dnf_counter +=1;
			continue;
		}		
				
		$result2 = mysqli_query($link,"select Rating,Slope from kisakone_CourseRating where Course = $course limit 1");
	
	   foreach ($result2 as $row2) {

			
       	if (!isset($row2['Rating']) || $row2['Rating']==0) { 
		     echo "<tr>
						<td colspan=3>radalla ei HCP-arvoja</td>
					</tr>";
            continue;  										//  poikki jos ei ratingia tai 0
      	}
		$result2_course_rating = $row2['Rating'];
   		$hcp = number_format(($row['Result']-$row2['Rating'])*80/$row2['Slope'],2,'.','');

					$del = mysqli_query($link, "delete from kisakone_RoundResultHandicap where RoundResult=$id");									
					$ins = mysqli_query($link, "insert into kisakone_RoundResultHandicap (RoundResult,Handicap) values ($id,$hcp)");
					$hcp_counter += 1;
							
							
							
							
							
	   }

} //HCP foreach loppuu... kaikki tarvittava tieto on nyt kannassa, loppu koodi on vain visuaalista infoa käyttäjälle!
echo "	<div class='code-show'>
			<h3>Kierrokselta tulevat tasoitukset:</h3>
			Tasoituskierrokset laskettu: $hcp_counter kpl. <br>
			ohitettu denffanneet pelaajat $hcp_dnf_counter kpl.
		</div>
		
				<br>
		<div class='well'>
		";
		if($error == 0 ){
		echo "
						<div class='leaderboards'>
							<div>
								<img src='../images/peukku.png' style='width: 100px;'>
							</div>
							<div>
								<br><a href = '../../kisakone/kilpailu/$event_id/katso/leaderboard' target='_new' id = 'link_kk'>
								Suoralinkki kisakoneen leaderboardiin.</a>
								</div>

						</div>
						 <span class='ok_span'>Ei virheitä.</span>
				<u> JOS </u>tuloksissa on  virheitä niin paina takaisin nappia niin pääset korjaamaan tuloksia samantien tai aloita tulosten syöttö alusta ja korjaa tulokset	
		</div>	";
		}else{
					echo "
						<span class='err_score'> VIRHEITÄ HAVAITTU $error kpl, tarkista yksityiskohtaiset tiedot</span>
						<br><a href = '../../kisakone/kilpailu/$event_id/katso/leaderboard' target='_new' id = 'link_kk'>Suoralinkki leaderboardiin.</a>
						</div>";
			
		}
			
echo '
  <!-- Modal -->
  <div class="modal fade" id="OK_modal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
		  
		  ';
		  
//OK-modal boxin tekstit ja aika laskurin pysäytys:
$time2 = microtime(true);
$runtime = $time2 - $time1; //value in seconds

		  
if($error == 0 ){	
	echo "
          <h4 class='modal-title'>Tulokset lisätty onnistuneesti!</h4>
        </div>
        <div class='modal-body'>
			<h2><img src='../images/peukku.png' style='width: 100px;'>
			<br>
			<a href = '../../kisakone/kilpailu/$event_id/katso/leaderboard' target='_new' id = 'link_kk'>
								Suoralinkki kisakoneen leaderboardiin.</a></h2>
								<br>
						 <span class='ok_span'>Ei virheitä.</span>
				<u> JOS</u>  tuloksissa on  virheitä niin paina takaisin nappia niin pääset korjaamaan tuloksia samantien tai aloita tulosten syöttö alusta ja korjaa tulokset.
						<br><br>
						<div class='well'>
						tulosten laskentaan käytetty aika: $runtime sekuntia				
						</div>
			
			";
			}else{
				echo "
          <h4 class='modal-title'>Tapahtui virhe!</h4>
        </div>
        <div class='modal-body'>
			<h2><i class='fa fa-exclamation-triangle fa-4x' aria-hidden='true' style='color:red;'></i><br>VIRHE!</h2>
			<br>
						<span class='err_score'> VIRHEITÄ HAVAITTU $error kpl, tarkista yksityiskohtaiset tiedot ja ilmoita ylläpidolle asiasta. yritä syöttää tulokset uudelleen.</span>
						<br><a href = '../../kisakone/kilpailu/$event_id/katso/leaderboard' target='_new' id = 'link_kk'>Suoralinkki leaderboardiin.</a>
						<br><br>
						tulosten laskentaan käytetty aika: $runtime sekuntia
								
			";	
			}

		  echo '
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Sulje</button>
        </div>
      </div>
      
    </div>
  </div>
';




					


 
 
 //aika-laskuri

	echo '<div class= "well">';
	echo "	Tulosten laskentaan käytetty aika: $runtime sekuntia" ;
	echo "</div></div>";
mysqli_close($link);
						



echo "
<script language='javascript' type='text/javascript'>
     $(window).load(function() {
     $('#loading').hide();
  });
</script>";

	
	
  
  
  ?>
  