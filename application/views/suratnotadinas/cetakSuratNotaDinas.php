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

        <td width="50%">
            <center>
                <kop> DAERAH SUMATERA BARAT</kop>
            </center>
        </td>
        <td width="25%">
        </td>
        <td width="25%">
        </td>
    </tr>
    <tr>

        <td width="50%" style="border-bottom: 1px solid black;">
            <center>
                <kop> RESOR KOTA PADANG</kop>
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
                <subkop> <u> NOTA DINAS</u></subkop>
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
                <subkop> Nomor : <?php echo $suratnotadinas['no_surat'] ?></subkop>
            </center>
        </td>
        <td width="15%">
        </td>
    </tr>

</table>
<br><br>
<table width="100%">
    <tr>
        <td width="100">
        </td>
        <td width="100px">
            <p> Kepada</p>
        </td>
        <td width="1%">
            <p> :</p>
        </td>
        <td>
            <p> Yth. <?php echo $suratnotadinas['kepada'] ?></p>
        </td>
    </tr>
    <tr>
        <td width="100">
        </td>
        <td width="100px">
            <p> Dari</p>
        </td>
        <td width="1%">
            <p> :</p>
        </td>
        <td>
            <p> <?php echo $suratnotadinas['dari'] ?></p>
        </td>
    </tr>
    <tr>
        <td width="50px">
        </td>
        <td width="100px">
            <p> Perihal</p>
        </td>
        <td width="1%">
            <p>:</p>
        </td>
        <td>
            <p> <?php echo $suratnotadinas['perihal'] ?></p>
        </td>
    </tr>
    <tr>
        <td colspan="4" style="height: 20px;">
        </td>
    </tr>

</table>
<br />
<table width="100%">
    <tr>
        <td width="50px">
            &nbsp;
        </td>
        <td width="10px">
            <p>1.</p>
        </td>
        <td width="">
            <p>Rujukan :</p>
        </td>
    </tr>
    <tr>
        <td width="50px">
            &nbsp;
        </td>
        <td width="10px">
            <p></p>
        </td>
        <td width="">
            <?php echo $suratnotadinas['rujukan'] ?>
        </td>
    </tr>
    <tr>
        <td width="50px">
            &nbsp;
        </td>
        <td width="10px" style="vertical-align: text-top;">
            <p>2.</p>
        </td>
        <td width="">
            <p><?php echo $suratnotadinas['sehubungan'] ?></p>
        </td>
    </tr>
    <tr>
        <td width="50px">
            &nbsp;
        </td>
        <td width="10px">
            <p>3.</p>
        </td>
        <td width="">
            <p>Demikian untuk menjadikan maklum.</p>
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
            <center>
                <p><?php echo $suratnotadinas['kota'], ', ' . date('d-M-Y', strtotime($suratnotadinas['tanggal'])); ?></p>
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
                <p><?php echo $suratnotadinas['jabatan'] ?></p>
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
                <?php if ($suratnotadinas['qrcode'] == '') : ?>
                    <br><br><br>
                <?php else : ?>
                    <img style="width: 100px;" src="<?php echo base_url() . 'assets/qrcode/' . $suratnotadinas['qrcode'] ?>">
                <?php endif; ?>
            </center>
        </td>
    </tr>
    <tr>
        <td width="400px">
            <tembusan> <i> <small>Tembusan :</small></i></tembusan>
        </td>
        <td width=" 10px">
            &nbsp;
        </td>
        <td width="">
            <center>
                <p><?php echo $suratnotadinas['nama_pejabat'] ?></p>
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
                    <p style="margin: 0px;"><?php echo $suratnotadinas['nrp'] ?></p>
                </div>
            </center>
        </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="500px">
            <tembusan> <i> <?php echo $suratnotadinas['tembusan'] ?> </i> </tembusan>
        </td>
    </tr>

</table>
<br>
<table width="100%">
    <tr>
        <td width="500px">
            <tembusan> <i> <small> <u>Keterangan :</u> </small></i> </tembusan>
        </td>
    </tr>
    <tr>
        <td width="500px">
            <tembusan> <i> <small>Nota dinas hanya digunakan dalam Satuan Organisasi Mabes Polri/Wilayah sendiri, tidak diperbolehkan untuk keluar Mabes Polri/Polda/Polwitabes/Poltabes/Polres/Polresta dan jajarannya.</small></i> </tembusan>
        </td>
    </tr>
</table>