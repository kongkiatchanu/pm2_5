<?php 
class Admin_model extends CI_Model{
	public function __contruct()
	{
		parent::__contruct();
	}

	public function getMenuAPILists(){
		$query = $this->db->select('menu_color_primary as primaryColor, menu_color_secondary as secondaryColor, menu_name as title, menu_subname as subTitle, menu_button_text as buttonText, menu_name_en as titleEn, menu_subname_en as subTitleEn, menu_button_text_en as buttonTextEn, menu_type as type, menu_target as targetUrl')->get_where('menu', array('deleted' => 0, 'is_show'=>1));
		return $query->result();	
	}

	public function getAPIList(){
		$query = $this->db->get_where('menu', array('deleted' => 0));
		return $query->result();	
	}

	public function getAPIDetail($menu_id){
		$query = $this->db->get_where('menu', array('menu_id' => $menu_id));
		return $query->result();	
	}

	public function addMenuApi($ar){
		$this->db->insert('menu',$ar);
		return $this->db->insert_id();	
	}

	public function updateMenuApi($ar){
		$this->db->where('menu_id',$ar['menu_id']);
		$this->db->update('menu',$ar);
	}
	
	public function insert_data($table, $data){
		$this->db->insert($table ,$data);
	}
	
	public function get_log(){
		$query = $this->db->order_by('createdate desc')->get('user_log');
		return $query->result();
	}

	public function get_alertmessage(){
		$query = $this->db->order_by('createdate desc')->get_where('alert_message', array('deleted'=>0));
		return $query->result();
	}
	
	
	public function login($username, $password)
	{
	   $this -> db -> select('*');
	   $this -> db -> from('admin');
	   $this -> db -> where('username', $username);
	   $this -> db -> where('password', $password);
	   $this -> db -> where('is_ban', 0);
	   $this -> db -> where('is_admin', 1);
	   $this -> db -> limit(1);
	 
	   $query = $this -> db -> get();
	 
	   if($query -> num_rows() == 1)
	   {
		 return $query->result();
	   }
	   else
	   {
		 return false;
	   }
	}
	
	public function getNewInbox(){
		$this->db->select("*, count(idcontact) as total_row");
        $this->db->from('contact');
		$this->db->where('contact.contact_view',0);
		$query = $this->db->get(); 
		return $query->result();
	}
	public function getInbox(){
		$this->db->select("*");
        $this->db->from('contact');
		$this->db->limit(3);
		$this->db->order_by('contact_datetime DESC');
		$query = $this->db->get(); 
		return $query->result();
	}
	
	public function getSection()
	{
		$query = $this->db->get('content_section');
		return $query->result();
	}
	public function getSectionByID($id_section)
	{
		$this->db->select('section_name');
		$query = $this->db->get_where('content_section', array('id_section' => $id_section));
		return $query->result();
	}
	
	/*getCategory*/
	public function getCategory()
	{
		$this->db->select('t2.id_section,t2.section_name,t1.id_category,t1.category_name,t3.id_category as idparent,t3.category_name as parent');
		$this->db->from('content_category t1'); 
		$this->db->join('content_section t2', 't2.id_section=t1.id_section', 'left');
		$this->db->join('content_category t3', 't1.category_parent=t3.id_category', 'left');
		$this->db->order_by('t1.id_category ASC');
		$query = $this->db->get();
		return  $query->result();
	}

	/*getCategoryRow*/
	public function getCategoryRow($id_category)
	{
		$this->db->select('t1.id_section,t1.section_name,t2.id_category,t2.category_name,t2.category_rewrite,t3.id_category as idparent,t3.category_name as parent');
		$this->db->from('content_section t1'); 
		$this->db->join('content_category t2', 't1.id_section=t2.id_section', 'left');
		$this->db->join('content_category t3', 't2.category_parent=t3.id_category', 'left');
		$this->db->where('t2.id_category',$id_category);
		$query = $this->db->get();
		return  $query->result();
	}

	/*updateCategory*/
	public function updateCategory($ar)
	{
		$this->db->where('id_category',$ar['id_category']);
		$this->db->update('content_category',$ar);
	}

	/*insertCategory*/
	public function insertCategory($ar)
	{
		$this->db->insert('content_category',$ar);
	}

	/*deleteCategory*/
	public function deleteCategory($id_category)
	{
		$this->db->delete('content', array('id_category' => $id_category));  
		$this->db->delete('content_category', array('id_category' => $id_category));  
	}

	/*getContentsList*/
	public function getContentsList($id_section)
	{
		$this->db->select('*');
		$this->db->from('content t1'); 
		$this->db->join('content_category t2', 't1.id_category=t2.id_category', 'left');
		$this->db->join('content_section t3', 't2.id_section=t3.id_section', 'left');
		$this->db->where('t3.id_section',$id_section)->order_by('t1.content_created DESC');
		$query = $this->db->get();
		return  $query->result();
	}

	public function getAllContentsList()
	{
		$this->db->select('*');
		$this->db->from('content t1'); 
		$this->db->join('content_category t2', 't1.id_category=t2.id_category', 'left');
		$this->db->join('content_section t3', 't2.id_section=t3.id_section', 'left');
		$query = $this->db->get();
		return  $query->result();
	}

	/*insertContents*/
	public function insertContents($ar)
	{
		$this->db->insert('content',$ar);
		return $this->db->insert_id();	
	}
	
	/*getContentRow*/
	public function getContentRow($idcontent)
	{
		$query = $this->db->get_where('content', array('idcontent' => $idcontent));
		return $query->result();	
	}
	
	/*updateContents*/
	public function updateContents($ar)
	{
		$this->db->where('idcontent',$ar['idcontent']);
		$this->db->update('content',$ar);
	}
	
	/*deleteContent*/
	public function deleteContent($idcontent)
	{
		$this->db->delete('content', array('idcontent' => $idcontent));  
	}
	
	public function getFileList($file_idcontent){
		$query = $this->db->get_where('content_file', array('file_idcontent' => $file_idcontent));
		return $query->result();
	}
	
	public function getCGalleryImgList($content_id){
		$query = $this->db->get_where('content_gallery', array('img_content_id' => $content_id));
		return $query->result();
	}
	
	public function updateMarkerConfig($ar){
		$this->db->where('id',$ar['id']);
		$this->db->update('report_marker',$ar);
	}
	
	public function getMarkerConfig($id){
		$query = $this->db->get_where('report_marker', array('id' => $id));
		return $query->result();
	}
}


