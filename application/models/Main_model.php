<?php 
class Main_model extends CI_Model{
	public function __contruct()
	{
		parent::__contruct();
	}
	
	public function getMarkerConfig($id){
		$query = $this->db->get_where('report_marker', array('id' => $id));
		return $query->result();
	}
	
	public function insertMessage($ar){
		$this->db->insert('alert_message',$ar);
		return $this->db->insert_id();	
	}

	public function getMessage($message_key){
		$query = $this->db->get_where('alert_message', array('message_key' => $message_key));
		return $query->result();
	}
}