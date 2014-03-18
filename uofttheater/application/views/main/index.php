<?php
 date_default_timezone_set("America/Toronto");
 echo "Welcome to U of T Cinema!";
 echo "To buy a ticket, please select a date and either a movie or a venue";
 echo "<html>";
 echo "<script>";
 echo "function movieShowtimesClicked() {";
 echo 'if(document.getElementById("dateselection").value == "promptdate"){alert("Please select a valid date");}';
 echo 'else if(document.getElementById("movieselection").value == "promptmovie"){alert("Please select a valid movie");}';
 echo 'else{';
    echo 'window.location = "'. site_url("main/showShowtimesByDateAndMovie") .'" + "/" + document.getElementById("dateselection").value + "/" + document.getElementById("movieselection").value;';
    echo '}';
 echo "}";
 echo "function venueShowtimesClicked() {";
 echo 'if(document.getElementById("dateselection").value == "promptdate"){alert("Please select a valid date");}';
 echo 'else if(document.getElementById("venueselection").value == "promptvenue"){alert("Please select a valid venue");}';
 echo 'else{';
    echo 'window.location = "'. site_url("main/showShowtimesByDateAndVenue") .'" + "/" + document.getElementById("dateselection").value + "/" + document.getElementById("venueselection").value;';
    echo '}';
 echo "}";
 echo "</script>";
 echo "<table>";
    echo '<tr><td>Date:</td> <td><select id="dateselection"><option value="promptdate">Select date...</option>';
    $currentDate = date_create();
    for ($i = 1; $i <= 14; $i++) {
        date_add($currentDate, date_interval_create_from_date_string("1 day"));
        echo '<option value = "'. date_format($currentDate, "Y-m-d") .'">'. date_format($currentDate, "Y-m-d") .'</option>';
    }
    echo '</select></td>';
    
    echo '<td>Movie:</td>';
    echo '<td><select id="movieselection"><option value="promptmovie">Select movie...</option>';
    if(!empty($movies)) {
     foreach ($movies as $movieId => $movieTitle) {
         echo '<option value = "'. $movieId .'">'. $movieTitle .'</option>';
     }
    }
    echo '</select></td>';
    echo '<td><button type="button" onclick="movieShowtimesClicked()">Search showtimes by date and movie</button></td></tr>';
    
    echo '<tr><td></td> <td></td> <td>Venue:</td>';
    echo '<td><select id="venueselection"><option value = "promptvenue">Select venue...</option>';
    if(!empty($venues)) {
     foreach ($venues as $venueId => $venueName) {
         echo '<option value = "'. $venueId .'">'. $venueName .'</option>';
     }
    }    
    echo '</select></td>';
    echo '<td><button type="button" onclick="venueShowtimesClicked()">Search showtimes by date and venue</button></td></tr>';
 echo "</table>";
 echo "</html>";
 
?>

