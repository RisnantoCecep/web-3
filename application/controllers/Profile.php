<?php 
class Profile extends CI_Controller {
    public function index() {
        if($this->session->userdata("user_id")){
            $this->load->model("Users_model", "users");
            $this->load->model("Transaction_model", "transaction");

            $data["tittle"] = "Profile";
            $data["page"] = "profile/user";
            $data["profile"] = $this->users->profile($this->session->userdata('user_id'));
            $data["histories"] = $this->transaction->findOrder($this->session->userdata('user_id'));
            $this->load->view("templates/main", $data);
        }else{
            redirect(base_url('login'));
        }
    }

    public function edit()
    {
        if($this->session->userdata('user_id')){
            $this->load->model('users_model','users');
            $this->users->edit(
                $this->session->userdata('user_id'),
                $this->input->post('name'),
                $this->input->post('mail'),
                $this->input->post('hp'),
                $this->input->post('gender'),
                $this->input->post('birthday')
            );
            redirect(base_url('profile'));
        } else{
            redirect(base_url('login'));
        }
    }

    public function password(){
        if($this->session->userdata('user_id')){
            if($this->input->post("password")){
                if($this->input->post("password") == $this->input->post("password-conf")){
                    $this->load->model('users_model','users');
                    $save = $this->users->updatePassword($this->session->userdata('user_id'), $this->input->post("password"));
                    if($save){
                        $this->session->set_flashdata("success", "Kata sandi berhasil diubah!");
                        redirect(base_url('profile'));
                    }else{
                        $data["msg"] = "Kegagalan, silahkan coba kembali!";
                    }
                }else{
                    $data["msg"] = "Silahkan konfirmasi kata sandi dengan kata sandi yang sama";
                }
            }

            $data["title"] = "Ganti Kata Sandi";
            $data["page"] = "profile/password";
            $this->load->view("templates/main", $data);
        }else{
            redirect(base_url('login'));
        }
    }

    public function orders($id){
        if($this->session->userdata('user_id')){
            $this->load->model("Transaction_model", "transaction");
            $data["title"] = "Detail Transaksi";
            $data["page"] = "profile/order_detail";
            $data["order"] = $this->transaction->getOrder($id);
            $data["id"] = $id;
            $this->load->view("templates/main", $data);
        }else{
            redirect(base_url('login'));
        }
    }

    public function imageSave(){
        if($this->session->userdata('user_id')){
            $this->load->model("Users_model", "users");
            if(isset($_FILES['image']['tmp_name'])){
                $imageFile = null;
                $dirUpload = "content/profile/";
                if(isset($_FILES['image']['tmp_name'])){
                    $namaSementara = $_FILES['image']['tmp_name'];
                    $extension = explode('.', $_FILES['image']['name']);
                    $extension = strtolower(end($extension));

                    if(in_array($extension, ['png', 'jpg', 'jpeg'])){
                        $imageFile = uniqid().'.'.$extension;
                        $terupload = move_uploaded_file($namaSementara, $dirUpload.$imageFile);
                        if(!$terupload){
                            $imageFile = null;
                            log_message('error', 'File gagal di upload!');
                        }
                    }
                }

                if($imageFile){
                    $save = $this->users->updateImage($this->session->userdata('user_id'), $imageFile);
                }else{
                    $this->session->set_flashdata("warning", "Upload foto profile gagal, silahkan coba kembali");
                }
            }else{
                $this->session->set_flashdata("warning", "Upload foto profile gagal, silahkan coba kembali");
            }
            redirect(base_url("profile"));
        }else{
            redirect(base_url('login'));
        }
    }


}

?>