<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {
     
    public function index(){
        $data["page"] = "pages/register";
        $this->load->view('templates/main', $data); 
    }

    public function registrasi(){
        $redirect = $this->session->userdata("redirect");

        // validasi form
        if($this->input->post("name") && $this->input->post("email") && $this->input->post("phone") && $this->input->post("password") && $this->input->post("password2"))
        {
            if($this->input->post("password") == $this->input->post("password2")) {
                $this->load->model("Users_model", "users");
                $register = $this->users->register($this->input->post("name"), $this->input->post("email"), $this->input->post("phone"), $this->input->post("password"));
                if($register){
                    $this->session->set_userdata($register);
                    redirect($redirect ?? base_url("profile"));
                } else{
                    $this->session->set_flashdata("warning", "Email yang anda gunakan sudah terdaftar");
                    redirect(base_url('register'));
                }
            }else{
                    $this->session->set_flashdata("warning", "konfirmasi kata sandi harus sama, coba lagi.");
                    redirect(base_url('register'));
            } 
        }else{
                    $this->session->set_flashdata("warning", "silahkan masukan nama, email, nomor handphone, & password terlebih dulu");
                    redirect(base_url('register'));
        }
     }
}
    


?>