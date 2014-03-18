<?php

echo anchor('main/goBackFromSeatView', 'Back') . "<br />";
echo "<html>";
echo "<table>";
echo '<tr><td>Movie Title:</td> <td>';
if(!empty($movietitle)){
    echo $movietitle;
}
echo '</td></tr>';
echo '<tr><td>Date:</td> <td>';
if(!empty($date)){
    echo $date;
}
echo '</td></tr>';
echo '<tr><td>Showtime:</td> <td>';
if(!empty($showtime)){
    echo $showtime;
}
echo '</td></tr>';
echo '<tr><td>Venue:</td> <td>';
if(!empty($venue)){
    echo $venue;
}
echo '</td></tr>';
echo '<tr><td>Price:</td> <td>';
if(!empty($price)){
    echo $price;
}
echo '</td></tr>';
echo '<tr><td>Seat:</td> <td>';
if(!empty($seat)){
    echo $seat;
}
echo '</td></tr>';
echo '<tr><td>First name:</td> <td>';
if(!empty($firstname)){
    echo $firstname;
}
echo '</td></tr>';
echo '<tr><td>Last name:</td> <td>';
if(!empty($lastname)){
    echo $lastname;
}
echo '</td></tr>';
echo '<tr><td>Credit Card Number:</td> <td>';
if(!empty($creditcardnumber)){
    echo $creditcardnumber;
}
echo '</td></tr>';
echo '<tr><td>Credit Card Expiration Date:</td> <td>';
if(!empty($creditcardexpirationdate)){
    echo $creditcardexpirationdate;
}
echo '</td></tr>';
echo "</table>";
echo '<button type="button" onclick="window.print()">Print Receipt</button>';
echo "</html>";
?>
