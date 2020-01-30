<?php
    $now = Date('Y-m-d');
    $hari = hari_ini();
    $tgl_indo = tgl_indo($now);
    $jam = date("H:i");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Nomor Antrian</title>
    <style type="text/css" media="print">
        @page {
    margin: 0;

  }

  .body {
    margin:0in 0.2in 0in 0.3in;
    
    font-family: Arial, Helvetica, sans-serif;
   }

   .footer{
    position:absolute;
    bottom:0;
  }
  p, td{
      font-size: 12px;
  }

    </style>
</head>
<body onload="">
    <h6 style="font-weight:100;text-align:center;">Klinik Ampel Sehat</h6>
    <h6 style="text-align:center;margin-top:-25px;">Nomor Antrian</h6>
    <h1 style="text-align:center;margin-top:-20px;"><?php echo $kode_antrian; ?></h1>
    <p style="text-align:center;">No.Ref : <?php echo $no_ref; ?></p>
    <p style="text-align:center;margin-top:-10px;"><?php echo $hari . "," . $tgl_indo . " " . $jam; ?></p>
    
</body>
</html>
<script>

</script>
<script type="text/javascript">
    function PrintWindow() {
        window.print();
        CheckWindowState();
    }

    function CheckWindowState() {
        if(document.readyState=="complete") {
            window.close();
        } else {
            setTimeout("CheckWindowState()", 10)
        }
    }
    PrintWindow();
</script>