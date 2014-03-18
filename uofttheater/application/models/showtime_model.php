<?php

class Showtime_model extends CI_Model {

    function get_showtimes() {
        $query = $this->db->query("select s.id, s.movie_Id as movieId, s.theater_id as venueId, m.title, t.name, t.address, s.date, s.time, s.available
								from movie m, theater t, showtime s
								where m.id = s.movie_id and t.id=s.theater_id");
        return $query;
    }
    
    function get_showTimeWithId($showTimeId){
        $query = $this->db->query("select m.title, t.name
					from movie m, theater t, showtime s
					where m.id = s.movie_id and t.id=s.theater_id and s.id = ?", array($showTimeId));
        return $query;
    }
    
    function get_showTimeWithIdWithDateAndTime($showTimeId){
        $query = $this->db->query("select m.title, t.name, s.date, s.time 
					from movie m, theater t, showtime s
					where m.id = s.movie_id and t.id=s.theater_id and s.id = ?", array($showTimeId));
        return $query;
    }
    
    function populate() {

        $movies = $this->movie_model->get_movies();
        $theaters = $this->theater_model->get_theaters();

        //If it returns some results we continue
        if ($movies->num_rows() > 0 && $theaters->num_rows > 0) {
            $n = 1;
            foreach ($movies->result() as $movie) {
                foreach ($theaters->result() as $theater) {
                    for ($i = 1; $i < 15; $i++) {
                        for ($j = 20; $j <= 22; $j+=2) {
                            $this->db->query("insert into showtime (id, movie_id,theater_id,date,time,available)
									values ($n,$movie->id,$theater->id,adddate(current_date(), interval $i day),'$j:00',3)");
                        
                            $n = $n + 1;
                        }
                    }
                }
            }
        }
    }

    function delete() {
        $this->db->query("delete from showtime");
    }

}