<?php
define("WHITESQUAREURL", "images/WhiteSquare.png");
define("GREENSQUAREURL", "images/GreenSquare.png");
define("YELLOWSQUAREURL", "images/YellowSquare.png");
class Seat_model extends CI_Model {
    
    function checkSeats() {
        $showTimeId = $this->session->userdata('showTimeId');
        $query = $this->db->query('SElECT * FROM ticket WHERE showtime_id = ?', array($showTimeId));
        $array = array(true, true, true);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $seat = $row->seat;
                if ($seat >= 1 && $seat <= 3) {
                    $array[$seat-1] = false;
                }
            }
        }
        return $array;
    }
    
    function whiteSquareUrl(){
        return WHITESQUAREURL;
    }
    
    function yellowSquareUrl(){
        return YELLOWSQUAREURL;
    }
    
    function greenSquareUrl(){
        return GREENSQUAREURL;
    }
}

?>
