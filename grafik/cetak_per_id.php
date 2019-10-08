<?php
require_once "../config/c_transaksi.php";
require_once "../template/assets/html2pdf/vendor/autoload.php";

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

if(isset($_GET['id'])) {
    $lib = new Transaksi();
    $edit_id = $lib->edit(@$_GET['id']);
    $data = $edit_id->fetch(PDO::FETCH_OBJ);
}

try {
    ob_start();
    $content = ob_get_clean();

    $content = '
    <style type="text/css">
    .tabel {
        border-collapse: collapse;
    }
    .tabel tr {
        width: 100%;
    }

    .tabel td {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 10px;
        background-color: #cdcdce;
        width: 350px;
    }

    tr {
        margin-bottom:10px;
    }
    </style>
    ';

    $content .= '
    <page>
    <div style="padding: 5px; border: 1px solid; background-color: #3392fc; color: #fff;" align="center">
        <h3>Aplikasi Rental Mobil</h3>
    </div>
    <div style="padding: 20px 0 10px 0; font-size: 15px;">
        Laporan Cetak Per ID
    </div>
    <table border="1px" class="tabel">
            <tr>
                <td>ID Transaksi</td>
                <td>'.$data->id_transaksi.'</td>
            </tr>
            <tr>
                <td>ID Barang</td>
                <td>'.$data->id_barang.'</td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td>'.$data->jumlah.'</td>
            </tr>
            <tr>
                <td>Total Harga</td>
                <td>'.$data->harga_barang.'</td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td>'.$data->nama_pelanggan.'</td>
            </tr>
            <tr>
                <td>Tgl. Transaksi</td>
                <td>'.$data->tgl_transaksi.'</td>
            </tr>
       
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


