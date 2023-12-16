<?php 
class Transaction_model extends CI_Model {

    public function payments(){
        return $this->db->get("payments")->result_array();
    }

    public function paymentCount(){
        return $this->db->get("payments")->num_rows();
    }

    public function paymentSave($id, $bank, $an, $rekening){
        $data["payment_bank"] = $bank;
        $data["payment_an"] = $an;
        $data["payment_rekening"] = $rekening;
        if($id){
            return $this->db->update("payments", $data, ["payment_id"=>$id]);
        }else{
            return $this->db->insert("payments", $data);
        }
    }

    public function paymentDelete($id){
        return $this->db->delete("payments", ["payment_id"=>$id]);
    }

    public function kurir(){
        return $this->db->get("kurir")->result_array();
    }

    public function getKurir($id){
        return $this->db->get_where("kurir", ["kurir_id"=>$id])->row_array();
    }

    public function kurirSave($id, $name, $price){
        $data['kurir_name'] = $name;
        $data['kurir_price'] = $price;
        if($id){
            return $this->db->update("kurir", $data, ["kurir_id"=>$id]);
        }else{
            return $this->db->insert("kurir", $data);
        }
    }

    public function kurirDelete($id){
        return $this->db->delete("kurir", ["kurir_id"=>$id]);
    }

    public function coorierCount(){
        return $this->db->get("kurir")->num_rows();
    }

    public function count($user_id=null){
        if($user_id){
            $this->db->where(["transactions.user_id"=>$user_id]);
        }
        return $this->db->get("transactions")->num_rows();
    }

    public function findOrder($user_id, $limit=10, $offset=0, $is_process=false){
        $this->db->join("payments", "payments.payment_id = transactions.payment_id");
        $this->db->join("kurir", "kurir.kurir_id = transactions.kurir_id");
        $this->db->join("users", "users.user_id = transactions.user_id");
        $this->db->order_by("transaction_created DESC");
        if($user_id){
            $this->db->where(["transactions.user_id"=>$user_id]);
        }
        if($is_process){
            $this->db->where("(transaction_status != 'Selesai')");
        }
        if($limit){
            $this->db->limit($limit,$offset);
        }
        return $this->db->get("transactions")->result_array();
    }

    public function getOrder($id){
        $this->db->join("payments", "payments.payment_id = transactions.payment_id");
        $this->db->join("kurir", "kurir.kurir_id = transactions.kurir_id");
        $this->db->join("users", "users.user_id = transactions.user_id");
        $data = $this->db->get_where("transactions", ["transaction_id"=>$id])->row_array();
        if($data){
            $this->db->select("*, CONCAT('".base_url('assets/img/galerys/')."', galery_image) as galery_image, galery_image as image_path");
            $this->db->join("galerys", "galerys.galery_id = transaction_detail.galery_id");
            $this->db->join("categories", "categories.category_id = galerys.category_id");

            $data['details'] = $this->db->get_where("transaction_detail", ["transaction_id"=>$id])->result_array();
        }
        return $data;
    }

    public function updateOrder($id, $status){
        $order = $this->getOrder($id);
        if($order){
            if(in_array($order["transaction_status"], ["Menunggu pembayaran", "Pembayaran diterima"]) && !in_array($status, ["Menunggu pembayaran", "Pembayaran diterima"])){
                // update stock (-) = jika pembelian di proses
                foreach($order["details"] as $detail){
                    $stok = $detail["galery_stok"] - $detail["detail_qty"];
                    $this->db->update("galerys", ["galery_stok"=>$stok], ["galery_id"=>$detail["galery_id"]]);
                }
            }
            if(in_array($order["transaction_status"], ["Sedang dikirim", "Selesai"]) && $status == "Dibatalkan"){
                // update stock (+) = jika batal beli
                foreach($order["details"] as $detail){
                    $stok = $detail["galery_stok"] + $detail["detail_qty"];
                    $this->db->update("galerys", ["galery_stok"=>$stok], ["galery_id"=>$detail["galery_id"]]);
                }
            }
            return $this->db->update("transactions", ["transaction_status"=>$status], ["transaction_id"=>$id]);
        }
        return null;
    }

    public function order($user_id, $kurir_id, $payment_id, $address, $total){
        $kurir = $this->getKurir($kurir_id);
        if($kurir){
            $data["transaction_id"] = uniqid('', true);
            $data["user_id"] = $user_id;
            $data["kurir_id"] = $kurir_id;
            $data["payment_id"] = $payment_id;
            $data["transaction_code"] = strtoupper(uniqid("TR"));
            $data["transaction_total"] = $total;
            $data["transaction_ship"] = $kurir["kurir_price"];
            $data["transaction_address"] = $address;
            if($this->db->insert("transactions", $data)){
                return $data["transaction_id"];
            }
        }
        return null;
    }

    public function orderDetail($transaction_id, $galery_id, $detail_qty, $detail_price){
        $data["transaction_id"] = $transaction_id;
        $data["galery_id"] = $galery_id;
        $data["detail_qty"] = $detail_qty;
        $data["detail_price"] = $detail_price;
        return $this->db->insert("transaction_detail", $data);
    }

}
?>