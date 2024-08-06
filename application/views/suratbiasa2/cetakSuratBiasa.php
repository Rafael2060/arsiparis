<style>
    body {
        margin: 40px;
    }

    table,
    th,
    td {
        border: 0px solid black;
        border-collapse: collapse;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 12px;
    }

    kop {
        font-size: 12px;
        font-weight: 600;
    }

    subkop {
        font-size: 12px;
    }

    p {
        font-size: 12px;
    }

    ol {
        font-size: 12px;
    }

    tembusan {
        font-size: 10px;
    }

    tembusan>i>ol {
        font-size: 10px;
    }
</style>

<table width="100%">
    <tr>

        <td width="50%">
            <center>
                <kop>KEPOLISIAN NEGARA REPUBLIK INDONESIA</kop>
            </center>
        </td>
        <td width="25%">
            &nbsp;
        </td>
        <td width="25%">
            &nbsp;
        </td>
    </tr>
    <tr>

        <td width="50%" style="border-bottom: 1px solid black;width:fit-content;">
            <center>
                <div>
                    <kop> MARKAS BESAR</kop>
                </div>
            </center>
        </td>
        <td width="25%">
        </td>
        <td width="25%">
        </td>
    </tr>

</table>
<br><br>
<table width="100%">
    <tr>
        <td width="15%">
        </td>
        <td>
            <center>
                <img style="height:70px;width:auto" src="<?php echo base_url('assets/img/logo_tri_brata.png') ?>" alt="">
            </center>
        </td>
        <td width="15%">
        </td>
    </tr>
    <tr>
        <td width="15%">
        </td>
        <td>
            <center>
                <subkop> SURAT BIASA</subkop>
            </center>
        </td>
        <td width="15%">
        </td>
    </tr>
    <tr>
        <td width="15%">
        </td>
        <td>
            <center>
                <subkop> Nomor : <?php echo $suratbiasa['no_surat'] ?> </subkop>
            </center>
        </td>
        <td width="15%">
        </td>
    </tr>

</table>
<br><br>

<table width="100%">
    <tr>
        <td width="50px" style="vertical-align: top;">
            <p>Pertimbangan</p>
        </td>
        <td width="10px">
            <p>:</p>
        </td>
        <td width="">
            <p><?php echo $suratbiasa['pertimbangan'] ?></p>
        </td>
    </tr>
    <tr>
        <td width="50px" style="vertical-align: top;">
            <p> Dasar</p>
        </td>
        <td width="10px">
            <p>:</p>
        </td>
        <td width="">
            <p><?php echo $suratbiasa['dasar'] ?></p>
        </td>
    </tr>
    <tr>
        <td width="50px" style="vertical-align: top;">
            <p>
                Kepada
            </p>
        </td>
        <td width="10px" style="vertical-align: top;">
            <p>
                :
            </p>
        </td>
        <td width="">
            <p style="margin: 0px;"><?php echo $suratbiasa['kepada'] ?></p>
        </td>
    </tr>
    <tr>
        <td width="50px" style="vertical-align: top;">
            <p>Untuk</p>
        </td>
        <td width="10px" style="vertical-align: top;">
            <p>:</p>
        </td>
        <td width="" style="vertical-align: top;">
            <p><?php echo $suratbiasa['untuk'] ?></p>
        </td>
    </tr>
    <tr>
        <td width="50px" style="vertical-align: top;">
            <p>Selesai.</p>
        </td>
        <td width="10px">
            <p></p>
        </td>
        <td width="">
        </td>
    </tr>
</table>
<br>

<table width="100%">
    <tr>
        <td width="400px">
            &nbsp;
        </td>
        <td width="10px">
            &nbsp;
        </td>
        <td width="">
            <table>
                <tr>
                    <td>Dikeluarkan di</td>
                    <td>:</td>
                    <td><?php echo $suratbiasa['kota'] ?></td>
                </tr>
                <tr>
                    <td>pada tanggal</td>
                    <td>:</td>
                    <td><?php echo date('d-M-Y', strtotime($suratbiasa['tanggal'])) ?></td>
                </tr>
            </table>


        </td>
    </tr>
    <tr>
        <td width="400px">
            &nbsp;
        </td>
        <td width="10px">
            &nbsp;
        </td>
        <td width="">
            <center>
                <p style="margin: 0px;"><?php echo $suratbiasa['an'] ?></p>
            </center>
            <center>
                <p style="margin: 0px;"><?php echo $suratbiasa['jabatan'] ?></p>
            </center>
        </td>
    </tr>
    <tr>
        <td width="400px">
            &nbsp;
        </td>
        <td width="10px">
            &nbsp;
        </td>
        <td width="">
            <?php
            // require 'vendor/autoload.php'; // load folder vendor/autoload
            // $qrCode = new Endroid\QrCode\QrCode('KASATTAHTI'); // mengambil data kode siswa sebagai data  QR code
            // $qrCode->writeFile('./QRcode/' . 'KASATTAHTI' . '.png'); // direktori untuk menyimpan gambar QR code
            // 
            ?>
            <!-- tampilkan gambar QR code -->
            <!-- <img src="<?= base_url('./QRcode/' . 'KASATTAHTI' . '.png') ?>" alt="QRcode-siswa" width="100px"> -->

            <?php
            // include "phpqrcode/qrlib.php";
            // $isi    = 'Kasattahti';
            // QRcode::png($isi);

            ?>
            <center>
                <?php if ($suratbiasa['qrcode'] == '') : ?>
                    <br><br><br>
                <?php else : ?>
                    <img style="width: 100px;" src="<?php echo base_url() . 'assets/qrcode/' . $suratbiasa['qrcode'] ?>">
                <?php endif; ?>
            </center>
        </td>
    </tr>
    <tr>
        <td width="400px">
            <tembusan> <i> <small>Tembusan :</small></i></tembusan>
        </td>
        <td width="10px">
            &nbsp;
        </td>
        <td width="">
            <center>
                <p><?php echo $suratbiasa['nama_pejabat'] ?></p>
            </center>
        </td>
    </tr>
    <tr>
        <td width="400px">
            &nbsp;
        </td>
        <td width="10px">
            &nbsp;
        </td>
        <td width="">
            <center>
                <div style="border-top: 1px solid black;width:fit-content;">
                    <p style="margin: 0px;"><?php echo $suratbiasa['nrp'] ?></p>
                </div>
            </center>
        </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="500px">
            <tembusan> <i> <?php echo $suratbiasa['tembusan'] ?></i> </tembusan>
        </td>
    </tr>
    <tr>
        <td width="500px">
        </td>
    </tr>
</table>