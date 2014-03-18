<?php

echo anchor('main/goBackFromUserInfoView', 'Back') . "<br />";
echo "<html>";
echo "<script>";
echo "function nextButtonClicked(){";
echo 'var firstname = ""; var lastname=""; var ccnum=""; var ccyear="";';
echo 'firstname = document.getElementById("firstname").value.replace(/[^a-zA-Z0-9~%.:_\- ]/g, "");';
echo 'lastname = document.getElementById("lastname").value.replace(/[^a-zA-Z0-9~%.:_\- ]/g, "");';
echo 'ccnum = document.getElementById("ccnum").value.replace(/[^a-zA-Z0-9~%.:_\- ]/g, "");';
echo 'ccmonth = document.getElementById("ccmonth").value.replace(/[^a-zA-Z0-9~%.:_\- ]/g, "");';
echo 'ccyear = document.getElementById("ccyear").value.replace(/[^a-zA-Z0-9~%.:_\- ]/g, "");';
echo 'var url = "' . site_url("main/validateUserForm/") . '" + "/";';
echo 'if(firstname != "" && lastname != "" && ccnum != "" && ccmonth != "" && ccyear != "") {';
    echo 'url = url + firstname + "/";';
    echo 'url = url + lastname + "/";';
    echo 'url = url + ccnum + "/";';
    echo 'url = url + ccmonth + "/";';
    echo 'url = url + ccyear;';
    echo 'window.location = url;';
    echo "}";
echo "else {";
    echo 'alert("Some fields are not filled or are only filled with special characters that are not allowed!");';
    echo "}";
echo "}";
echo "</script>";
echo "<table>";
if (!empty($firstName)) {
    echo '<tr><td>First name:</td> <td><input type="text" id="firstname" size="45" maxlength="45" value="' . $firstName . '"></td>';
} else {
    echo '<tr><td>First name:</td> <td><input type="text" id="firstname" size="45" maxlength="45"></td>';
}
if(!empty($firstNameError)){
    echo '<td><font color="red">'.$firstNameError.'</font></td>';
}
else{
    echo '<td></td>';
}
echo '</tr>';
if (!empty($lastName)) {
    echo '<tr><td>Last name:</td> <td><input type="text" id="lastname" size="45" maxlength="45" value="' . $lastName . '"></td>';
} else {
    echo '<tr><td>Last name:</td> <td><input type="text" id="lastname" size="45" maxlength="45"></td>';
}
if(!empty($lastNameError)){
    echo '<td><font color="red">'.$lastNameError.'</font></td>';
}
else{
    echo '<td></td>';
}
echo '</tr>';
if (!empty($creditCardNumber)) {
    echo '<tr><td>Credit Card Number:</td> <td><input type="text" id="ccnum" size="16" maxlength="16" value="' . $creditCardNumber . '"></td>';
} else {
    echo '<tr><td>Credit Card Number:</td> <td><input type="text" id="ccnum" size="16" maxlength="16"></td>';
}
if(!empty($creditCardNumberError)){
    echo '<td><font color="red">'.$creditCardNumberError.'</font></td>';
}
else{
    echo '<td></td>';
}
echo '</tr>';
echo '<tr><td>Credit Card Expiration Date:</td> <td><table><tr><td>Month:</td><td><input type="text" id="ccmonth" size="2" maxlength="2" ';
if (!empty($creditCardExpirationMonth)) {
    echo 'value="' . $creditCardExpirationMonth . '"';
}
echo '></td><td>Year:</td><td><input type="text" id="ccyear" size="2" maxlength="2" ';
if (!empty($creditCardExpirationYear)) {
    echo 'value="' . $creditCardExpirationYear . '"';
}
echo '"></td></tr></table></td>';
if(!empty($creditCardExpirationDateError)){
    echo '<td><font color="red">'.$creditCardExpirationDateError.'</font></td>';
}
else{
    echo '<td></td>';
}
echo '</tr>';

echo "</table>";
echo '<button type = "button" onclick = "nextButtonClicked()" id="nextButton">Next</button>';
echo "</html>";
?>
