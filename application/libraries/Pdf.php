<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Memanggil autoloader Dompdf
require_once(APPPATH . 'third_party/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {
    public function generate($html, $filename='', $stream=TRUE, $paper='A4', $orientation='portrait') {
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE); // Agar bisa load gambar/CSS luar
        
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        
        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 1));
        } else {
            return $dompdf->output();
        }
    }
}