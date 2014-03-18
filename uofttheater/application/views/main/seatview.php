
<?php

echo anchor('main/goBackFromSeatView', 'Back') . "<br />";
$whiteUrl = "images/WhiteSquare.png";
$greenUrl = "images/GreenSquare.png";
$yellowUrl = "images/YellowSquare.png";
$defaultUrl = $whiteUrl;
$seat1Url = $defaultUrl;
$seat2Url = $defaultUrl;
$seat3Url = $defaultUrl;
if (!empty($seat1)) {
    $seat1Url = base_url($seat1);
}
if (!empty($seat2)) {
    $seat2Url = base_url($seat2);
}
if (!empty($seat3)) {
    $seat3Url = base_url($seat3);
}

echo "<html>";
echo "<script>";
echo "function seat1clicked() {";
if ($seat1 == $whiteUrl || $seat1 == $greenUrl) {
    echo 'document.getElementById("seat1img").src = "' . base_url($greenUrl) . '";';
    echo 'document.getElementById("nextLink").href = "' . site_url("main/seatSelected/1") . '";';
    if ($seat2 == $whiteUrl || $seat2 == $greenUrl) {
        echo 'document.getElementById("seat2img").src = "' . base_url($whiteUrl) . '";';
    }
    if ($seat3 == $whiteUrl || $seat3 == $greenUrl) {
        echo 'document.getElementById("seat3img").src = "' . base_url($whiteUrl) . '";';
    }
}
echo "}";

echo "function seat2clicked() {";
if ($seat2 == $whiteUrl || $seat2 == $greenUrl) {
    echo 'document.getElementById("seat2img").src = "' . base_url($greenUrl) . '";';
    echo 'document.getElementById("nextLink").href = "' . site_url("main/seatSelected/2") . '";';
    if ($seat1 == $whiteUrl || $seat1 == $greenUrl) {
        echo 'document.getElementById("seat1img").src = "' . base_url($whiteUrl) . '";';
    }
    if ($seat3 == $whiteUrl || $seat3 == $greenUrl) {
        echo 'document.getElementById("seat3img").src = "' . base_url($whiteUrl) . '";';
    }
}
echo "}";

echo "function seat3clicked() {";
if ($seat3 == $whiteUrl || $seat3 == $greenUrl) {
    echo 'document.getElementById("seat3img").src = "' . base_url($greenUrl) . '";';
    echo 'document.getElementById("nextLink").href = "' . site_url("main/seatSelected/3") . '";';
    if ($seat1 == $whiteUrl || $seat1 == $greenUrl) {
        echo 'document.getElementById("seat1img").src = "' . base_url($whiteUrl) . '";';
    }
    if ($seat2 == $whiteUrl || $seat2 == $greenUrl) {
        echo 'document.getElementById("seat2img").src = "' . base_url($whiteUrl) . '";';
    }
}
echo "}";
echo "</script>";
echo "<table>";
echo "<tr>";
echo '<td width="50px"><img type="button" onclick="seat1clicked()" src="' . $seat1Url . '" id="seat1img"/></td>';
echo '<td width="50px"></td>';
echo '<td width="50px"><img type="button" onclick="seat2clicked()" src="' . $seat2Url . '" id="seat2img" onclick="seat2clicked()"/></td>';
echo '<td width="50px"><img type="button" onclick="seat3clicked()" src="' . $seat3Url . '" id="seat3img" onclick="seat3clicked()"/></td>';
echo "</tr>";
echo "</table>";
if(!empty($seatError))
{
    echo '<p><font color="red">'.$seatError.'</font></p>';
}
if ($seat1 == $greenUrl) {
    echo '<a href="' . site_url("main/seatSelected/1") . '" id="nextLink">Next</a>';
} else if ($seat2 == $greenUrl) {
    echo '<a href="' . site_url("main/seatSelected/2") . '" id="nextLink">Next</a>';
} else if ($seat3 == $greenUrl) {
    echo '<a href="' . site_url("main/seatSelected/3") . '" id="nextLink">Next</a>';
} else {
    echo '<a href="' . site_url("main/seatSelected/0") . '" id="nextLink">Next</a>';
}
echo "</html>";
?>
