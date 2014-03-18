<?php
class Theater_model extends CI_Model {

	function get_theaters()
	{
		$query = $this->db->query("select * from theater");
		return $query;	
	}  

	function populate() {
		$this->db->query("insert into theater (id,name,address) values (1,'Gallery 1265','1265 Military Trail
Scarborough')"); 
		$this->db->query("insert into theater (id,name,address) values (2,'Hart House Theatre','7 Hart House Circle
Toronto')");
		$this->db->query("insert into theater (id,name,address) values (3,'University of Toronto Art Centre','15 King\'s College Circle
Toronto')");
		
	}

	function delete() {
		$this->db->query("delete from theater");
	}
	
	
}