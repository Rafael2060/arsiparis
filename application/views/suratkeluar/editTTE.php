<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/css/gijgo.min.css') ?>" rel="stylesheet" type="text/css">

<form action="<?php echo base_url('SuratKeluar/updateTTE'); ?>" method="post" enctype="multipart/form-data">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td style="width:20%">Nomor Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input type="hidden" name="id_suratkeluar" id="id_suratkeluar" value="<?= $suratkeluar['id_suratkeluar'] ?>">
                        <input autofocus class="form-control" type="text" name="no_surat" id="no_surat" value="<?php echo htmlentities($suratkeluar['no_surat'], ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('no_surat'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">File surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input type="file" name="user_file" id="user_file" size="20" />
                        <small class="text-danger"> <?php echo form_error('user_file'); ?></small>
                        <?php if (!$suratkeluar['file'] == '') : ?>
                            <?php $random = rand(10, 100); ?>
                            <a href="<?= base_url() . '/uploads/keluar/' . $suratkeluar['file'] . '?t=' . $random; ?>" target="_blank" rel="noopener noreferrer">Lihat File</a>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('SuratKeluar'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
                        <button type="submit" class="btn btn-outline-primary">SIMPAN</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</form>