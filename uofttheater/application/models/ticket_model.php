<?php
class Ticket_model extends CI_Model {
    
    function get_tickets(){
        return $this->db->query('SELECT * FROM ticket');
    }
    
    function fillSessionData(){
        $a = array
            (
                'firstName' => 'Shaun',
                'lastName' => 'Kho',
                'creditCardNumber' => '1111222233334444',
                'creditExpiratonDate' => '0123',
                'showTimeId' => 1,
                'seat' => 1
            );
        $this->session->set_userdata($a);
    }
    
    function insertTicket($firstName, $lastName, $creditCardNumber, $creditCardExpirationDate, $showTimeId, $seat){
        $query = $this->db->query('SElECT MAX(ticket) AS MaxTicketId FROM ticket');
        $maxId = 1;
        if ($query->num_rows() > 0) {
            $queryResultArray = $query->result();
            $maxId = $queryResultArray[0]->MaxTicketId + 1;
        }
        $expirationDate = str_replace("/", "", $creditCardExpirationDate);
        echo $expirationDate;
        $this->db->query('INSERT INTO ticket (ticket, first, last, creditcardnumber, creditcardexpiration, showtime_id, seat) 
            VALUES (?, ?, ?, ?, ?, ?, ?)', array($maxId, $firstName, $lastName, $creditCardNumber, $expirationDate, $showTimeId, $seat));
        $this->db->query('UPDATE showtime SET available = available - 1 WHERE id = ?', array($showTimeId));
    }
    
    function validateShowTimeId($showTimeId) {
        $query = $this->db->query('select * from showtime where id = ?', array($showTimeId));
        return $query->num_rows() > 0;
    }

    function validateCreditCardNumber($creditCardNumber) {
        return strlen($creditCardNumber) == 16;
    }

    function validateCurrentDate($showTimeDate) {
        $dateArray = getdate(strtotime($showTimeDate));
        $currentDateArray = getdate();
        if ($dateArray['year'] < $currentDateArray['year']) {
            return false;
        }
        if ($dateArray['year'] == $currentDateArray['year']) {
            if ($dateArray['mon'] < $currentDateArray['mon']) {
                return false;
            }
            if ($dateArray['mon'] == $currentDateArray['mon']) {
                if ($dateArray['mday'] <= $currentDateArray['mday']) {
                    return false;
                }
            }
        }
        $twoWeeksFromNow = date_create();
        date_add($twoWeeksFromNow, date_interval_create_from_date_string("14 days"));
        $twoWeeksFromNowArray = getdate(date_timestamp_get($twoWeeksFromNow));
        if ($dateArray['year'] > $twoWeeksFromNowArray['year']) {
            return false;
        }
        if ($dateArray['year'] == $twoWeeksFromNowArray['year']) {
            if ($dateArray['mon'] > $twoWeeksFromNowArray['mon']) {
                return false;
            }
            if ($dateArray['mon'] == $twoWeeksFromNowArray['mon']) {
                if ($dateArray['mday'] >= $twoWeeksFromNowArray['mday']) {
                    return false;
                }
            }
        }
        echo "yes3";
        return true;
    }

    function validateCreditCardExpirationDate($creditCardExpirationDate) {
        date_default_timezone_set("America/Toronto");
        $expireDateArray = getdate(date_timestamp_get(date_create_from_format("m/y", $creditCardExpirationDate)));
        $currentDateArray = getdate();
        if (!checkdate($expireDateArray['mon'], 1, $expireDateArray['year'])) {
            return false;
        }
        if ($expireDateArray['year'] < $currentDateArray['year']) {
            return false;
        }
        if ($expireDateArray['year'] == $currentDateArray['year']) {
            if ($expireDateArray['mon'] <= $currentDateArray['mon']) {
                return false;
            }
        }
        echo "yes2";
        return true;
    }

    function validateName($firstName, $lastName) {
        if(strlen($firstName) > 0 && strlen($lastName) > 0){ echo "yes 1";}
        return strlen($firstName) > 0 && strlen($lastName) > 0;
    }

    function seatAvailable($showTimeId, $seatNumber) {
        $queryString = "SELECT * FROM ticket WHERE showtime_id = ? AND seat = ?";
        $queryResult = $this->db->query($queryString, array($showTimeId, $seatNumber));
        if($queryResult->num_rows() == 0) {echo "seatAvailable yes";}
        else
        {
            echo "seatAvailable no";
            
        }
        return $queryResult->num_rows() == 0;
    }
    
    function deleteTickets(){
        $this->db->query("DELETE FROM ticket");
    }
    
    function delete() {
    }
}

?>
