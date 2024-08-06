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
                <img style="height:70px;width:auto" src="<?php echo base_url('assets/img/logo_tri_brata.png') ?>" alt="">
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
                <kop> RESOR KOTA PADANG</kop>
            </center>
        </td>
        <td width="25%">
        </td>
        <td width="25%">
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

</table>
<br><br>
<table width="100%">
    <tr>
        <td width="70px"></td>
        <td width="5px"></td>
        <td width="350px"></td>
        <td></td>
        <td width="10px"></td>
        <td><?php echo $suratbiasa['kota'] ?>, <?php echo date('d-M-Y', strtotime($suratbiasa['tanggal'])); ?></td>
    </tr>
    <tr>
        <td>Nomor</td>
        <td>:</td>
        <td><?php echo $suratbiasa['no_surat'] ?></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Klasifikasi</td>
        <td>:</td>
        <td><?php echo $suratbiasa['klasifikasi'] ?></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Lampiran</td>
        <td>:</td>
        <td><?php echo $suratbiasa['lampiran'] ?></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Hal</td>
        <td>:</td>
        <td><?php echo $suratbiasa['perihal'] ?></td>
        <td></td>
        <td></td>
        <td>Kepada</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="vertical-align: top;">Yth.</td>
        <td style="vertical-align: top;"><strong> <?php echo $suratbiasa['kepada'] ?></strong></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>di</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $suratbiasa['di'] ?></td>
    </tr>

</table>
<br><br>

<table width="100%">
    <tr>
        <td width="10px" style="vertical-align: top;">
            <p>1.</p>
        </td>
        <td>
            <p>Rujukan :</p>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top;">
            <p></p>
        </td>
        <td>
            <?php echo $suratbiasa['rujukan'] ?>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top;">
            <p>2.</p>
        </td>
        <td>
            <?php echo $suratbiasa['sehubungan'] ?>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top;">
            <p>3.</p>
        </td>
        <td>
            <p>
                Demikian untuk maklum
            </p>
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
        <tembusan> <i><?php echo $suratbiasa['tembusan'] ?> </i></tembusan>
    </tr>
</table>