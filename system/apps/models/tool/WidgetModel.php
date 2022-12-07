<?php
class WidgetModel extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function insertWidget($data){
        return $this->db->insert('widget_table',$data);
    }
    public function updateWidget($id,$data)
    {
    	return $this->db->where(array('admin_id'=>CLIENT_ID,'id'=>$id))->update('widget_table',$data);
    }
    public function getAllWidget($id=0,$where=[],$groupBy = false)
    {	if($id)
    		$this->db->where('id',$id);
        if(count($where) > 0 )
            $this->db->where($where);
            
        if($groupBy)
            $this->db->group_by('widget_type');
    	return $this->db->where('admin_id',CLIENT_ID)->order_by('id','desc')->get('widget_table');
    }
    
    
    public function addWidgetData($data)
    {
        return $this->db->insert('widget_data',$data);
    }
    public function getWidgetData($wid)
    {
        return $this->db->where('widget_id',$wid)->order_by('id','desc')->get('widget_data');
    }
    public function getWidgetCustom($where)
    {
        return $this->db->where($where)->order_by('id','desc')->get('widget_data');
    }
    public function useWidget($data)
    {
        return $this->db->insert('widget_link',$data);
    }
    public function removeWidget($where)
    {
        
           // $this->db->where($where);
        return $this->db->where($where)->delete('widget_link');
    }
    public function widgetLink($where)
    {
       return $this->db->where($where)->get('widget_link');
    }

    public function siteVisit()
    {   
        return $this->db->set('val','val+1',FALSE)->where(array('admin_id'=>CLIENT_ID))->update('counter');
    }
    public function getVisit()
    {
        return $this->db->where('admin_id',CLIENT_ID)->get('counter')->row()->val;
    }

    public function getWidgetFooter()
    {
        return $this->db->where(array('admin_id'=>CLIENT_ID,'pos_type'=>'footer'))->order_by('sequence','asc')->get('widget_link');
    }
    public function update($where,$data,$table)
    {
        $this->db->where($where)->where('admin_id',CLIENT_ID)->update($table,$data);
    }
    public function delete($where,$table)
    {
       return  $this->db->where($where)->where(array('admin_id'=>CLIENT_ID))->delete($table);
    }
}

?>