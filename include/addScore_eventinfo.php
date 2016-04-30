<?php
  $kisat = "SELECT kisakone_Event.id,
  kisakone_Event.Name,
  kisakone_Round.id,
  kisakone_Round.StartTime
  FROM
  kisakone_Event,
  kisakone_Round
  WHERE
  kisakone_Event.Level = 2 AND
  kisakone_Event.id = kisakone_Round.Event AND
  kisakone_Event.ResultsLocked IS NULL
  ORDER BY
  kisakone_Round.StartTime DESC
  "; // Run your query  
  $kisat_result = $link->query($kisat);

  $radat = "
  SELECT 
  kisakone_Course.id, 
  kisakone_Course.Name, 
  coalesce(kisakone_CourseRating.Rating, 0) AS rating,
   coalesce(kisakone_CourseRating.Slope, 0) AS slope,
	  Count(*) AS vaylia,
	  Sum(kisakone_Hole.Par) AS par
  FROM 
  kisakone_Course
  LEFT JOIN 
  kisakone_CourseRating
  ON 
  kisakone_Course.id = kisakone_CourseRating.Course 
  LEFT JOIN kisakone_Hole
  ON kisakone_Course.id = kisakone_Hole.Course
  GROUP BY
  kisakone_Course.id
  ORDER BY
  kisakone_Course.id DESC
  "; // Run your query
  $radat_result = $link->query($radat);
  
  
  
$venue = "
SELECT * 
FROM
kisakone_venue
  "; // Run your query
  $venue_result = $link->query($venue);
  
  





  $pelaajat = "
  SELECT
  kisakone_Player.player_id,
  kisakone_Player.Lastname,
  kisakone_Player.Firstname,
  kisakone_User.Username
  FROM
  kisakone_Player,
  kisakone_User
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
  kisakone_Player.Lastname
  ";
  $result = $link->query($pelaajat);
  $player_cnt = $result->num_rows;
  
  
//get td users from scores config.php 

include '../data/config.php';
$string= implode("' OR username = '",$settings_normal_access);

$tdusers = "  username ='$string'";

    $tdu = "SELECT * FROM kisakone_User  WHERE $tdusers";
  $tds = $link->query($tdu);

  $link->close();

?>