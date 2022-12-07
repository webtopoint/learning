<?php

class MenuModel extends CI_Model{

	

	function __construct()

	{

		parent::__construct();

	}
    function removeMenuGroup($id = 0){
        $this->db->where(['admin_id'=>CLIENT_ID,'group_id'  => $id])->delete('menu');
        $this->db->where(['admin_id'=>CLIENT_ID,'id'  => $id])->delete('menu_groups');
        $this->db->where(['admin_id'=>CLIENT_ID,'group_id'  => $id])->delete('menu_css');
        return $this;
    }
    function getIconCss($id){
        return $this->db->where('id',$id)->get('menu')->row()->iconCss;
    }
    function UpdateIconCss($id,$data){
        return $this->db->where('id',$id)->update('menu',$data);
    }
    function get_menu_groups($where = [], $limit = 0, $isPrimary = 0, $isSecondary = 0){
        
        if(count($where) > 0)
            $this->db->where($where);
            
        if($limit)
            $this->db->limit($limit);
            
        if($isPrimary)
            $this->db->where('isPrimary',$isPrimary);
            
        if($isSecondary)
            $this->db->where('isSecondary',$isSecondary);
            
        return $this->db->get_where('menu_groups',['admin_id'=>CLIENT_ID]);
    }
    
    function updateMenuGroup($id = 0, $data = []){
        return $this->db->where('id',$id)->update('menu_groups',$data);
    }
    
    function install_menu_group($name = 'Main Menu',$update = true){
        $this->db->insert('menu_groups',['name'=>$name,'admin_id'=>CLIENT_ID]);
        $id = $this->db->insert_id();
        if($update){
            $this->db->where('admin_id',CLIENT_ID)->update('menu',['group_id'=>$id]);
            $this->db->where('admin_id',CLIENT_ID)->update('menu_css',['group_id'=>$id]);
        }
        else{
            $this->db->insert('menu_css',['group_id'=>$id,'admin_id'=>CLIENT_ID]);
        }
        return (object) ['id'=>$id,'name'=>$name];
    }
    
	public function get_menus($group_id = 0,$id = 0){
        if($group_id)
            $this->db->where('group_id',$group_id);
        if($id)
            $this->db->where('id',$id);
		return $this->db->where('admin_id',CLIENT_ID)

						->order_by('sort')

						->get('menu');

	}
	function print_menu_items($where=[]){
	    if(count($where))
	        $this->db->where($where);
	    $query = $this->db->where('admin_id',CLIENT_ID)

						->order_by('sort')

						->get('menu');
			$ref   = [];
			$items = [];

			foreach($query->result() as $k => $data) {

			    $thisRef = &$ref[$data->id];
			    $thisRef['parent'] = $data->parent;
                $thisRef['type']   = $data->type;
			    $thisRef['label'] = $data->label;
			    $thisRef['link'] = $data->link;
			    $thisRef['id'] = $data->id;
			    $thisRef['icon'] = $data->icon;

			   if($data->parent == 0)
			        $items[$data->id] = &$thisRef;
			   else 
			        $ref[$data->parent]['child'][$data->id] = &$thisRef;
			   
			}
			return $items;
	}
    
	public function getMenuCSS($where = [])
	{
	    if(count($where))
	        $this->db->where($where);
		 return $this->db->where('admin_id',CLIENT_ID)->get('menu_css');
	}

	public function update_menu($where,$d)
	{
		 $this->db->where($where);
		return $this->db->update('menu_css',$d);
		// return 1;
	}

}

?>