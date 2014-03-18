<?php
class Movie_model extends CI_Model {

	function get_movies()
	{
		$query = $this->db->query("select * from movie");
		return $query;	
	}

	function populate() {
		$this->db->query("insert into movie (id,title) values (1,'Men with Brooms')"); 
		$this->db->query("insert into movie (id,title) values (2,'Juno')");
		$this->db->query("insert into movie (id,title) values (3,'Barney\'s Version')");
		$this->db->query("insert into movie (id,title) values (4,'Canadian Bacon')");
	}

	function delete() {
		$this->db->query("delete from movie");
	}
	
	
}