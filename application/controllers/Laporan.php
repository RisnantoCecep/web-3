<?php 
defined('BASEPATH') or exit('No Direct script access allowed');
class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

    }

    public function cetak_transaksi($id){
        $this->load->model("Transaction_model", "transaction");
        $data["laporan"] = $this->transaction->getOrder($id);
        $this->load->view("export/laporan_print", $data);
    }

    public function cetak_pdf($id)
    {
        $this->load->model("Transaction_model", "transaction");
        $data["laporan"] = $this->transaction->getOrder($id);
        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/wp3/uas//application/third_party/dompdf/autoload.inc.php";

        $dompdf = new Dompdf\Dompdf();
        $this->load->view('export/laporan_pdf', $data);
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe
        $html = $this->output->get_output();
        $dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("laporan_transaksi.pdf", array('Attachment' => 
        0));
    }

    public function export_excel($id){
        $this->load->model("Transaction_model", "transaction");
        $data["laporan"] = $this->transaction->getOrder($id);
        $data["title"] = 'data_transaksi';
        $this->load->view('export/export_excel', $data);
    }
    
}

?>