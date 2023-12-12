<?php 
class Galery_model extends CI_Model {

    public function categories() {
        return $this->db->get("categories")->result_array();
    }

    public function get_category($id) {
        return $this->db->get_where("categories", ['category_slug'=>$id])->row_array();
    }

    public function countAllCategory() {
        return $this->db->get("categories")->num_rows();
    }

    public function countGalery($category_id=null, $search=null)
    {
        if($category_id) {
            $this->db->where(["category_id"=>$category_id]);
        }
        if($search){
            $this->db->where("(galery_title LIKE '%$search%')");
        }
        return $this->db->get("galerys")->num_rows();
    }

     // ambil data list buku
     public function find($limit=10, $offset=0, $category_id=null, $search=null){
        $this->db->select("*, CONCAT('".base_url('assets/img/galerys/')."', galery_image) as galery_image");
        $this->db->join("categories", "categories.category_id = galerys.category_id");
        if($category_id){
            $this->db->where(["galerys.category_id"=>$category_id]);
        }
        if($search){
            $this->db->where("(galery_title LIKE '%$search%')");
        }
        $this->db->where("(galery_stok > 0)");
        $this->db->limit($limit,$offset);
        $this->db->order_by("galery_created DESC");
        return $this->db->get("galerys")->result_array();
    }

    // ambil data satu buku
    public function get($slug){
        $this->db->select("*, CONCAT('".base_url('assets/img/galerys/')."', galery_image) as galery_image, galery_image as image_path");
        $this->db->join("categories", "categories.category_id = galerys.category_id");
        $data = $this->db->get_where("galerys", ["galery_slug"=>$slug])->row_array();
        if($data){
            $this->db->join("transactions", "transactions.transaction_id = transaction_detail.transaction_id");
            $data['terjual'] = $this->db->get_where("transaction_detail", ["galery_id"=>$data["galery_id"], "transaction_status"=>"Selesai"])->num_rows();
        }
        return $data;
    }

    public function saveGalery($id, $category_id, $title, $image, $stok, $price, $desc){
        $data['category_id'] = $category_id;
        $data['galery_title'] = $title;
        $data['galery_slug'] = uniqid(strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title))).'-');
        $data['galery_stok'] = $stok;
        $data['galery_price'] = $price;
        $data['galery_desc'] = $desc;
        if($image){
            $data['galery_image'] = $image;
        }
        if($id){
            return $this->db->update("galerys", $data, ['galery_id'=>$id]);
        }else{
            return $this->db->insert("galerys", $data);
        }
    }

    public function deleteGalery($id){
      return $this->db->delete("galerys", ["galery_id"=>$id]);   
    }

    public function findBasket(){
        $baskets = getBaskets();
        $basket = null;
        $ids = [];
        for($i = 0; $i < count($baskets); $i++){
            $spliter = explode(":", $baskets[$i]);
            if(count($spliter)==2){
                $basket[$spliter[0]] = $spliter[1];
                $ids[] = $spliter[0];
            }
        }

        if($ids){
            // QUERY
            $this->db->select("*, CONCAT('".base_url('assets/img/galerys/')."', galery_image) as galery_image, galery_image as image_path");
            $this->db->join("categories", "categories.category_id = galerys.category_id");
            $this->db->where_in('galery_id', $ids);
            $data = $this->db->get("galerys")->result_array();
            if($data){
                foreach($data as $i => $galery){
                    $data[$i]['qty'] = $basket[$galery['galery_id']];
                    $data[$i]['total'] = $data[$i]['qty'] * $galery['galery_price'];
                }
            }
            return $data;
        }
        return [];
    }


}
?> 