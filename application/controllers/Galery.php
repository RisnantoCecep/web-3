<?php 

    class Galery extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model("Galery_model", "galery");
            
        }

        public function category($slug){
           $data["page"] = "galery/category";
           $data["category"] = $this->galery->get_category($slug);
           $data["title"] = $data["category"]["category_title"];

           $config['base_url'] = current_url();
           $config['total-rows'] = $this->galery->countGalery($data["category"]["category_id"]);
           $config['query_string_segment'] = 'pages';
           $config['page_query_srting'] = true;
           $config['reuse_query_string'] = true;
           $config['per_page'] = 4;

           $config["full_tag_open"] = '<nav><ul class="pagination my-pagination justify-content-center">';
           $config["full_tag_close"] = "</ul></nav>";
           
           $config["first_link"] = "First";
           $config["first_tag_open"] = '<li class="page-item">';
           $config["first_tag_close"] = "</li>";
           
           $config["last_link"] = "Last";
           $config["last_tag_open"] = '<li class="page-item">';
           $config["last_tag_close"] = "</li>";
           
           $config["next_link"] = "&raquo";
           $config["next_tag_open"] = '<li class="page-item">';
           $config["next_tag_close"] = "</li>";
           
           $config["prev_link"] = "&laquo";
           $config["prev_tag_open"] = '<li class="page-item">';
           $config["prev_tag_close"] = "</li>";
           
           $config["cur_tag_open"] = '<li class="page-item active"><a class="page-link" href="#">';
           $config["cur_tag_close"] = "</a></li>";
           
           $config["num_tag_open"] = '<li class="page-item">';
           $config["num_tag_close"] = "</li>";
   
           $config["attributes"] = array("class" => "page-link");

           $this->pagination->initialize($config);
            
           $data['start'] = $this->input->get('pages');
           $data['galerys'] = $this->galery->find($config["per_page"], $data["start"], $data["category"]["category_id"], $this->input->get("search"));
           $this->load->view("templates/main", $data);
        }

        public function desc($slug){
            $data["galery"] = $this->galery->get($slug);
            $data["title"] = $data["galery"]["galery_title"];
            $data["page"] = "galery/description";
            $this->load->view("templates/main", $data);
        }
    } 

?> 