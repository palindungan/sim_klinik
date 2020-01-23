<?php 
Class Dompdf {
    
    function PdfGenerator($html,$filename,$paper,$orientation)
    
    {
        require_once 'vendor/autoload.php';
        // instantiate and use the dompdf class
        $dompdf = new Dompdf\Dompdf(array('enable_remote' => true));
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper($paper, $orientation);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($filename,array('Attachment' => 0));

        // Jika ingin preview pdf setelah $filename kasih script bawah ini
        // ,array('Attachment' => 0)
    }
}
