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
        <td><?php echo $suratpengantar['kota'] ?>, <?php echo date('d-M-Y', strtotime($suratpengantar['tanggal'])); ?></td>
    </tr>
    <tr>
        <td>Nomor</td>
        <td>:</td>
        <td><?php echo $suratpengantar['no_surat'] ?></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Klasifikasi</td>
        <td>:</td>
        <td><?php echo $suratpengantar['klasifikasi'] ?></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Lampiran</td>
        <td>:</td>
        <td><?php echo $suratpengantar['lampiran'] ?></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Hal</td>
        <td>:</td>
        <td><?php echo $suratpengantar['perihal'] ?></td>
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
        <td style="vertical-align: top;"><strong> <?php echo $suratpengantar['kepada'] ?></strong></td>
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
        <td><?php echo $suratpengantar['di'] ?></td>
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
            <?php echo $suratpengantar['rujukan'] ?>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top;">
            <p>2.</p>
        </td>
        <td>
            <?php echo $suratpengantar['sehubungan'] ?>
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
                <p style="margin: 0px;"><?php echo $suratpengantar['an'] ?></p>
            </center>
            <center>
                <p style="margin: 0px;"><?php echo $suratpengantar['jabatan'] ?></p>
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
                <?php if ($suratpengantar['qrcode'] == '') : ?>
                    <br><br><br>
                <?php else : ?>
                    <img style="width: 100px;" src="<?php echo base_url() . 'assets/qrcode/' . $suratpengantar['qrcode'] ?>">
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
                <p><?php echo $suratpengantar['nama_pejabat'] ?></p>
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
                    <p style="margin: 0px;"><?php echo $suratpengantar['nrp'] ?></p>
                </div>
            </center>
        </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <tembusan> <i><?php echo $suratpengantar['tembusan'] ?> </i></tembusan>
    </tr>
</table>