<?php 
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Galery_model", "galery");
        $this->load->model("Transaction_model", "transaction");

    }

    public function index() {
        if($this->session->userdata('user_flag') == "admin"){
            $data['title'] = 'Dashboard Admin';
            $data['page'] = 'admin/dasboard';
            $data['galery_count'] = $this->galery->countGalery();
            $data['transaction_count'] = $this->transaction->count();
            $data['payment_count'] = $this->transaction->paymentCount();
            $data['coorier_count'] = $this->transaction->coorierCount();
            $data['orders'] = $this->transaction->findOrder(null, null, null, true);
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }
    public function galerys(){
        if($this->session->userdata('user_flag') == 'admin'){
            $rows = $this->galery->countGalery($this->input->get('category'), $this->input->get('search'));
            $config = stylePagination(current_url(), $rows, 10);
            $start = $this->input->get("pages");
            $this->pagination->initialize($config);
            
            $data['title'] = 'Data Galery';
            $data['page'] = 'admin/galery_list';
            $data['categories'] = $this->galery->categories();
            $data['order'] = $start;
            $data['galerys'] = $this->galery->find(10, $start, $this->input->get('category'), $this->input->get('search'));
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }

    public function galery_editor($slug=null) {
        if($this->session->userdata('user_flag') == 'admin'){
            $data['title'] = ($slug) ? 'Edit Data Galery' : 'Tambah Galery';
            $data['page'] = 'admin/galery_editor';
            $data['categories'] = $this->galery->categories();
            $data['galery'] = ($slug) ? $this->galery->get($slug) : null;
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }

    public function galery_save(){
        if($this->session->userdata('user_flag') == 'admin'){
            $galeryEdit = ($this->input->post('id')) ? $this->galery->get($this->input->post('id')) : null;
            if(($galeryEdit || isset($_FILES['image'])) && $this->input->post('title') && $this->input->post('category') && $this->input->post('price') && $this->input->post('desc')){

                $imageFile = null;
                $dirUpload = "assets/img/galerys/";
                if(isset($_FILES['image']['tmp_name'])) {
                    $namaSementara = $_FILES['image']['tmp_name'];
                    $extension = explode('.', $_FILES['image']['name']);
                    $extension = strtolower(end($extension));

                    if(in_array($extension, ['png', 'jpg', 'jpeg'])) {
                        $imageFile = uniqid('', true).'.'.$extension;
                        $terupload = move_uploaded_file($namaSementara, $dirUpload.$imageFile);
                        if(!$terupload){
                            $imageFile = null;
                            log_message('error', 'File gagal diupload!');
                        }

                    }
                }
                $save = $this->galery->saveGalery(
                    $this->input->post('id'),
                    $this->input->post('category'),
                    $this->input->post('title'),
                    $imageFile,
                    $this->input->post('stok'),
                    $this->input->post('price'),
                    $this->input->post('desc')
                );
                if($save){
                    if(isset($galeryEdit['image_path']) && $imageFile){
                        unlink($dirUpload.$galeryEdit['image_path']);
                    }
                }
                redirect(base_url('admin/galerys'));
            }else{
                redirect(base_url('admin/galery_editor'));
            }
        }else{
            redirect(base_url('login'));
        }
    }

    public function galery_delete($slug) {
        if($this->session->userdata('user_flag') == 'admin') {
            $dirUpload = "assets/img/galerys/";
            $galery = $this->galery->get($slug);
            if($galery){
                if($this->galery->deleteGalery($galery['galery_id'])){
                    if(@$galery['image_path']){
                        unlink($dirUppload.$galery['image_path']);
                    }
                    $this->session->set_flashdata("success", "Galery berhasil di hapus");
                }else{
                    $this->session->set_flashdata("warning", "Galery gagal di hapus silahkan coba lagi");
                }
            }else{
                 $this->session->set_flashdata("warning", "Galery gagal dihapus silahkan coba lagi");
            }
            redirect(base_url('admin/galerys'));
        }else{
            redirect(base_url('login'));
        }
    }

    public function transactions($id=null){
        if($this->session->userdata('user_flag') == 'admin'){
            if($id){
                if($this->input->post('status')) {
                    $acc = $this->transaction->updateOrder($id, $this->input->post('status'));
                    if($acc){
                        $this->session->set_flashdata("success", "Transaksi berhasil di update ke".$this->input->post('status'));
                    }else{
                        $this->session->set_flashdata("warning", "Transaksi gagal di update!");
                    }
                }
                $data['title'] = 'Detail Transaksi';
                $data['page'] = 'admin/transaction_detail';
                $data['order'] = $this->transaction->getOrder($id);
            }else{
                $rows = $this->transaction->count();
                $config = stylePagination(current_url(), $rows, 10);
                $start = $this->input->get("pages");
                $this->pagination->initialize($config);

                $data['title'] = 'Data Transaksi';
                $data['page'] = 'admin/transaction_list';
                $data['order'] = $start;
                $data['orders'] = $this->transaction->findorder(null, 10, $start);
            }
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }

    public function payments() {
        if($this->session->userdata('user_flag') == 'admin'){
            $data['title'] = 'Data Pembayaran';
            $data['page'] = 'admin/payment_list';
            $data['data'] = $this->transaction->payments();
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }

    public function payment_save(){
        if($this->session->userdata('user_flag') == 'admin'){
            if($this->input->post("bank") && $this->input->post("an") && $this->input->post("rekening")){
                $acc = $this->transaction->paymentSave($this->input->post("id"), $this->input->post("bank"), $this->input->post("an"), $this->input->post("rekening"));
                if($acc){
                    $this->session->set_flashdata("success", "Pembayaran berhasil disimpan");
                }else{
                    $this->session->set_flashdata("warning", "Gagal menyimpan data pembayaran");
                }
            }else{
                $this->session->set_flashdata("warning", "Gagal menyimpan data pembayaran");
            }
        }else{
            $this->session->set_flashdata("warning", "Gagal menyimpan data pembayaran");
        }
        redirect(base_url('admin/payments'));
    }


    public function payment_delete(){
        if($this->session->userdata('user_flag') == 'admin'){
            if($this->input->get("id")){
                $acc = $this->transaction->paymentDelete($this->input->get("id"));
                if($acc){
                    $this->session->set_flashdata("success", "Pembayaran berhasil di hapus");
                }else{
                    $this->session->set_flashdata("warning", "Gagal menghapus data pembayaran");
                }
            }else{
                $this->session->set_flashdata("warning", "Gagal menghapus data pembayaran");
            }
        }else{
            $this->session->set_flashdata("warning", "Gagal menghapus data pembayaran");
        }
        redirect(base_url('admin/payments'));
    }

    public function cooriers(){
        if($this->session->userdata('user_flag') == 'admin'){
            $data['title'] = 'Data Kurir';
            $data['page'] = 'admin/coorier_list';
            $data['data'] = $this->transaction->kurir();
        }else{
            $data['page'] = 'admin/forbidden';
        }
        $this->load->view('templates/main', $data);
    }

    public function coorier_save(){
        if($this->session->userdata('user_flag') == 'admin'){
            if($this->input->post("name") && $this->input->post("price")){
                $acc = $this->transaction->kurirSave($this->input->post("id"), $this->input->post("name"), $this->input->post("price"));
                if($acc){
                    $this->session->set_flashdata("success", "Kurir berhasil disimpan");
                }else{
                    $this->session->set_flashdata("warning", "Gagal menyimpan data kurir");
                }
            }else{
                $this->session->set_flashdata("warning", "Gagal menyimpan data kurir");
            }
        }else{
            $this->session->set_flashdata("warning", "Gagal menyimpan data kurir");
        }
        redirect(base_url('admin/cooriers'));
    }

    public function coorier_delete(){
        if($this->session->userdata('user_flag') == 'admin'){
           if($this->input->get('id')){
                $acc = $this->transaction->kurirDelete($this->input->get('id'));
                if($acc){
                    $this->session->set_flashdata("success", "kurir berhasil dihapus");
                }else{
                    $this->session->set_flashdata("warning", "Gagal menghapus data kurir");
                }
           }else{
                $this->session->set_flashdata("warning", "Gagal menghapus data kurir");
           }
        }else{
            $this->session->set_flashdata("warning", "Gagal menghapus data kurir");
        }
        redirect(base_url('admin/cooriers'));
    }
}
?>