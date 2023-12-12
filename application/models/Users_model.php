<?php 
class Users_model extends CI_Model {

    public function updateImage($id, $image){
        return $this->db->update("users", ["user_image"=>$image], ["user_id"=>$id]);
    }


    public function profile($id){
        $this->db->select("*, CONCAT('".base_url('content/profile/')."', IFNULL(user_image, 'default.png')) as user_image");
        return $this->db->get_where("users", ["user_id"=>$id])->row_array();
    }

    public function profileByEmail($email){
        $this->db->select("*, CONCAT('".base_url('content/profile/')."', IFNULL(user_image, 'default.png')) as user_image");
        return $this->db->get_where("users", ["user_email"=>$email])->row_array();
    }

    public function updatePassword($id, $password){
        $data['user_password'] = password_hash($password, PASSWORD_DEFAULT);
        return $this->db->update("users", $data, ["user_id"=>$id]);
    }

    public function edit($id, $name, $email, $phone,$gender, $birthday){
        $data["user_name"] = $name;
        $data["user_email"] = $email;
        $data["user_phone"] = $phone;
        $data["user_gender"] = $gender;
        $data["user_birthday"] = $birthday;
        $this->db->update("users", $data,["user_id"=>$id]);
    }

    public function login ($email, $password) {
        $data = $this->db->get_where("users", ["user_email"=>$email])->row_array();
        if($data) {
            if(password_verify($password, $data['user_password'])){
                return $data;
            }
        }
        return null;
    }

    public function register($name, $email, $phone, $password) {
        $this->db->where(["user_email"=>$email]);
        $this->db->or_where(["user_phone"=>$phone]);
        $cekEmail = $this->db->get("users")->num_rows();
        if($cekEmail == 0) {
            $data["user_name"]= $name;
            $data["user_email"]= $email;
            $data["user_phone"]= $phone;
            $data["user_password"]= password_hash($password, PASSWORD_DEFAULT);
            if($this->db->insert("users", $data)){
                $user = $this->db->get_where("users", ["user_id"=> $this->db->insert_id()])->row_array();
                return $user;
            }

        }
        return null;
    }

}
?>