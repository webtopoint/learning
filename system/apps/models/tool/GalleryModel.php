<?php

class GalleryModel extends Ci_Model

{

	private static $imgGallery = 'image_gallery';

	private static $images = 'gallery_images';

	private static $prod_gallery = 'product_gallery';

	function __construct()

	{

		parent::__construct();

		$this->load->database();

	}





	public function Insert_image_gallery($d){

		$this->db->insert(self :: $imgGallery,$d);

		return true;

	}

	public function image_gallery($id=0)
	{
		if($id)
			$this->db->where('id',$id);

		return $this->db->get_where(self :: $imgGallery,array('admin_id' => CLIENT_ID ));

	}

	public function getGalleryProducts($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('product_gallery_images');
	}
    function file_download_gallery($where=[]){
        if(count($where))
            $this->db->where($where);
        $this->db->where(['admin_id'=>CLIENT_ID]);
        return $this->db->get(__FUNCTION__);
    }
    function files_download_gallery($where){
        return $this->db->get_where(__FUNCTION__,$where);
    }
	public function getProductQuery($where=0)
	{
		
		$this->db->select('product_query.*,product_gallery_images.image as img');
		$this->db->from('product_query');
		$this->db->join('product_gallery_images','product_gallery_images.id=product_query.product_id');

		if($where)
			$this->db->where($where);

		$this->db->where('product_query.admin_id',CLIENT_ID);
		return $this->db->get();
	}

	public function list_galllery_images($a)

	{

		return $this->db->get_where(Self::$images,$a);

	}

	public function insert_gallery_images($d)

	{

		return $this->db->insert(Self::$images,$d);

	}

	public function deleteImage($where)
	{
		$res = $this->db->where($where)->get('gallery_images');
		if($res->num_rows())
		{
			$r = $res->row();
			if(unlink('public/temp/'.CLIENT_ID.'/'.$r->image))
				$this->db->where(array('file_name'=>$r->image))->delete('usespace');
			  $this->db->where($where)->delete('gallery_images');
			return 1;
		}
		return 0;
	}

	public function insert_product_images($d)

	{

		return $this->db->insert('product_gallery_images',$d);

	}

	public function updateProduct($where,$data)
	{
		$this->db->where($where)->where('admin_id',CLIENT_ID)->update('product_gallery_images',$data);
	}


	public function changeLayout($where,$data)
	{
		if($this->db->where($where)->where('admin_id',CLIENT_ID)->get('image_gallery')->num_rows())
			$this->db->where($where)->where('admin_id',CLIENT_ID)->update('image_gallery',$data);

	}
	public function changeVideoLayout($where,$data)
	{
		if($this->db->where($where)->where('admin_id',CLIENT_ID)->get('video_gallery')->num_rows())
			$this->db->where($where)->where('admin_id',CLIENT_ID)->update('video_gallery',$data);

	}

	public function changeProductLayout($where,$data)
	{
		if($this->db->where($where)->where('admin_id',CLIENT_ID)->get('product_gallery')->num_rows())
			$this->db->where($where)->where('admin_id',CLIENT_ID)->update('product_gallery',$data);

	}
	
	public function product_gallery($where=0)

	{
		if($where)
			$this->db->where($where);

		return $this->db->get_where(Self::$prod_gallery,array('admin_id' => CLIENT_ID ));

	}
	public function update_product_gallery($where=[],$data = [])

	{
// 		if($where)
			$this->db->where($where+array('admin_id' => CLIENT_ID ));

		return $this->db->update(Self::$prod_gallery,$data);

	}

	public function getImages()
	{
		return $this->db->where('admin_id',CLIENT_ID)->order_by('id','desc')->get('manage_files');
	}

	public function checkGalleryUse($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('gallery_link')->num_rows())
			return true;
		else
			return false;
	}
    function checkFileDownloadGalleryUse($where){
        if($this->db->where($where)->where('admin_id',CLIENT_ID)->get('file_download_gallery_link')->num_rows())
            return true;
        else
            return false;
    }
	public function checkProductGalleryUse($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('product_gallery_link')->num_rows())
			return true;
		else
			return false;
	}
	public function checkVideoGalleryUse($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('video_gallery_link')->num_rows())
			return true;
		else
			return false;
	}
	public function useGallery($data)
	{
		if( $this->db->where($data)->where('admin_id',CLIENT_ID)->get('gallery_link')->num_rows() )
		{
			$this->db->where($data)->where('admin_id',CLIENT_ID)->delete('gallery_link');
			$schema = array(
								'type'		=>	'igallery',
								'key_id'	=>	$data['gal_id'],
								'admin_id'	=>	CLIENT_ID,
								'page_id'	=>	$data['page_id']
							);
			$this->db->where($schema)->delete('web_schema');
		}
		else
		{
			$this->db->set('admin_id',CLIENT_ID)->insert('gallery_link',$data);
			$schema = array('type'=>'igallery',
							'key_id'=>$data['gal_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
		}
	}

	
	public function useProductGallery($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('product_gallery_link')->num_rows())
		{
			$this->db->where($data)->where('admin_id',CLIENT_ID)->delete('product_gallery_link');
				$schema = array('type'=>'pgallery',
							'key_id'=>$data['gal_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->where($schema)->delete('web_schema');
		}
		else
		{
			$this->db->set('admin_id',CLIENT_ID)->insert('product_gallery_link',$data);
			$schema = array('type'=>'pgallery',
							'key_id'=>$data['gal_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
		}
	}
	
	function usefileDownloadGallery($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('file_download_gallery_link')->num_rows())
		{
			$this->db->where($data)->where('admin_id',CLIENT_ID)->delete('file_download_gallery_link');
				$schema = array('type'=>'fdgallery',
							'key_id'=>$data['gal_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->where($schema)->delete('web_schema');
		}
		else
		{
			$this->db->set('admin_id',CLIENT_ID)->insert('file_download_gallery_link',$data);
			$schema = array('type'=>'fdgallery',
							'key_id'=>$data['gal_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
		}
	}

	public function useVideoGallery($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('video_gallery_link')->num_rows())
		{

			$this->db->where($data)->where('admin_id',CLIENT_ID)->delete('video_gallery_link');
				$schema = array('type'=>'vgallery',
							'key_id'=>$data['gal_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->where($schema)->delete('web_schema');
		}
		else
		{
			$this->db->set('admin_id',CLIENT_ID)->insert('video_gallery_link',$data);
			$schema = array('type'=>'vgallery',
							'key_id'=>$data['gal_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
		}
	}


	public function getGalleryLinkBy($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('gallery_link');
	}

	public function getProductGalleryLinkBy($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('product_gallery_link');
	}

	public function getVideoGalleryLinkBy($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('video_gallery_link');
	}

	public function addVideoGallery($data)
	{
		$this->db->insert('video_gallery',$data);
	}

	public function addVideoToGallery($data)
	{
		$this->db->insert('gallery_videos',$data);
	}

	public function getVideoGallery($where=0)
	{
		if($where)
		$this->db->where($where);

		return $this->db->where(array('admin_id'=>CLIENT_ID))->get('video_gallery');
	}

	public function getGalleryVideos($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('gallery_videos');
	}

}

?>