<?php
require_once "../config/c_barang_masuk.php";
require_once "../template/assets/html2pdf/vendor/autoload.php";

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
    $content = ob_get_clean();

    $content = '
    <style type="text/css">
    .tabel {
        border-collapse: collapse;
    }
    .tabel th {
        padding: 8px 5px;
        background-color: #028898;
        color: #fff;
    }
    .tabel td {
        padding: 5px;
        background-color: #aee3fc;
    }
    img { 
        width: 50px; 
    }
    </style>
    ';

    $content .= '
    <page>
    <div style="padding: 5px; border: 1px solid; background-color: #9b9c9c; color: #fff;" align="center">
        <h3>Aplikasi Penjualan Barang</h3>
    </div>
    <div style="padding: 20px 0 10px 0; font-size: 15px;">
        Laporan Semua Data
    </div>
    <table border="1px" class="tabel">
        <tr>
            <th>ID Barang</th>
            <th>Stok Masuk</th>
            <th>Total Harga</th>
        </tr>';

        $lib = new Barang_stok();
        $tampil = $lib->tampil();
        while($data = $tampil->fetch(PDO::FETCH_OBJ)) {
            $content .= '
                <tr style="">
                    <td>'.$data->id_barang.'</td>
                    <td>'.$data->stok.'</td>
                    <td>'."Rp. ".number_format($data->total, 2, ",",".").'</td>
                </tr>  ';   
                } 
                $content .= '
    </table>
    </page>
    ';

    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->writeHTML($content);
    $html2pdf->output('example01.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
?>

