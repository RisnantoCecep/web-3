<?php 
function rupiah($i){
    return "Rp".number_format($i,0);
}
function getBaskets(){
    $cookie = isset($_COOKIE['budayaliterasi-basket']) ? $_COOKIE['budayaliterasi-basket'] : null;
    if($cookie){
        return json_decode($cookie, true);
    }
    return [];
}
function countBasket(){
    return count(getBaskets());
}
function clearBasket(){
    setcookie("budayaliterasi-basket", "", time() - 3600);
}

function stylePagination($url, $rows, $limit=10){
    $config['base_url'] = $url;
    $config['total_rows'] = $rows;
    $config['query_string_segment'] = 'pages';
    $config['page_query_string'] = true;
    $config['reuse_query_string'] = true;
    $config['per_page'] = $limit;

    // styling
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

    return $config;
}
?>