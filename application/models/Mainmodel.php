<?php
class Mainmodel extends CI_Model {

	public function __construct()
	{
   		$this->load->database();
	}
	public function auth($uname,$pass,$passmd5=true)
	{
   		$this->db->select('id,first_name,last_name,username,email');
		$this->db->from('user');
    	$this->db->where(array('username' => $uname,'password'=>($passmd5?md5($pass):$pass)));
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	//return $query->result_array();
		return $query->row();
	}
	public function register($data){
		$this->db->insert('user', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	public function getMyAnnouncement($userid){
		$this->db->select('id,title,content,start_date,end_date,active');
		$this->db->from('announcement');
    	$this->db->where(array('user_id' => $userid));
    	$query = $this->db->get();
		return $query->result();
	}
	public function saveMyAnnouncement($data){		 
		$this->db->insert('announcement', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	public function deleteMyAnnouncement($id){
		$this->db->delete('announcement', array('id' => $id));
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	public function getMyAnnouncementById($id){
		$this->db->select('id,title,content,start_date,end_date,active');
		$this->db->from('announcement');
    	$this->db->where(array('id' => $id));
    	$query = $this->db->get();
		return $query->row();
	}
	public function updateAnnouncementById($data,$id){
		$this->db->where('id', $id);
		$this->db->update('announcement', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	public function getAllAnnouncement(){
		$this->db->select('title,content,start_date,end_date,first_name,last_name,username,date_created');
		$this->db->from('announcement');
		$this->db->join('user', 'user.id = announcement.user_id','left');
		$this->db->where(array('announcement.active'=>1));
		$this->db->order_by("date_created", "desc");
    	$query = $this->db->get();
		return $query->result_array();
	}
	public function updateAnnoucementIfActive(){
		$this->db->where('end_date <= CURDATE()');
		$this->db->update('announcement', array('active'=>0));
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	public function saveNewUser($data){
		$this->db->insert('user', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	public function checkUserExist($username){
		$this->db->select('username');
		$this->db->from('user');
    	$this->db->where(array('username' => $username));
		$query = $this->db->count_all_results();
		return $query;
	}
}