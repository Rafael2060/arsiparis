<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/css/gijgo.min.css') ?>" rel="stylesheet" type="text/css">



<form action="<?php echo base_url('Verifikasi/store'); ?>" method="post" enctype="multipart/form-data">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td style="width:20%">Nomor Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo htmlentities($suratkeluar['no_surat'], ENT_QUOTES); ?></span>
                        <input type="hidden" name="id_suratkeluar" id="id_suratkeluar" value="<?= $suratkeluar['id_suratkeluar'] ?>">
                        <input type="hidden" name="id_verifikasi" id="id_verifikasi" value="<?= $id_verifikasi ?>">
                        <input type="hidden" name="target_role_id" id="target_role_id" value="0">
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Nomor Agenda</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo htmlentities($suratkeluar['no_agenda'], ENT_QUOTES); ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Tujuan Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo htmlentities($suratkeluar['tujuan_surat'], ENT_QUOTES); ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tanggal Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?= date('d-m-Y', strtotime($suratkeluar['tanggal_surat'])) ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Tanggal Dikirim</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?= date('d-m-Y', strtotime($suratkeluar['tanggal_dikirim'])) ?></span>
                    </td>
                </tr>


                <tr>
                    <td style="width:20%">Jenis Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?= $suratkeluar['nama_jenissurat']; ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Perihal</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo htmlentities($suratkeluar['perihal'], ENT_QUOTES); ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Lampiran</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo htmlentities($suratkeluar['lampiran'], ENT_QUOTES); ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">File surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <?php if (!$suratkeluar['file'] == '') : ?>
                            <?php $random = rand(10, 100); ?>
                            <a href="<?= base_url() . '/uploads/keluar/' . $suratkeluar['file'] . '?t=' . $random; ?>" target="_blank" rel="noopener noreferrer">Lihat File</a>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tahanan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <?php foreach ($tahanans as $key => $data) : ?>
                            <a href="<?= base_url() . '/Tahanan/show/' . $data->id_tahanan; ?>" target="_blank" rel="noopener noreferrer"><?= $key + 1 . '. ' . $data->nama_tahanan ?></a><br />
                        <?php endforeach; ?>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tanggal Verifikasi</td>
                    <td style="width:5%">:</td>
                    <td>

                        <input type="text" class="form-control" class="ml-1" autocomplete="off" id="tanggal_verifikasi" name="tanggal_verifikasi" width="276" value="<?= set_value('tanggal_verifikasi') ?>" />
                        <small class="text-danger"> <?php echo form_error('tanggal_verifikasi'); ?></small>
                        <script>
                            $('#tanggal_verifikasi').datepicker({
                                uiLibrary: 'bootstrap4',
                                format: 'dd-mm-yyyy'
                            });
                        </script>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Terima / Tolak Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <select class="form-control" name="tolak" id="tolak">
                            <option value="0" selected>VERIFIKASI</option>
                            <option value="1">TOLAK SURAT</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Catatan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="catatan" id="catatan" />
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('SuratMasuk'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
                        <a onclick="javascript:verifikasisurat('<?php echo $suratkeluar['id_suratkeluar'] ?>','<?php echo $suratkeluar['no_surat'] ?>')" type="button" data-bs-toggle="modal" data-bs-target="#modalSimpan" class="btn btn-outline-primary">PROSES</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="modal fade" id="modalSimpan" tabindex="-1">

        <div id="formHapus" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Proses Surat Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="idHapus" id="idHapus" value="">
                <input type="hidden" name="target" id="target" value="">
                <div class="modal-body">
                    Disposisi surat ke ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-success">PROSES</button>
                </div>
            </div>
        </div>


    </div><!-- End Basic Modal-->
</form>

<script>
    function verifikasisurat(id, name) {
        // alert(id);
        // alert(name);
        // var jq = $.noConflict(true);

        // $("#formHapus").attr("action", "/pelayanan");
        // target = $("#target_role_id :selected").attr("data-nama");
        target = $("#tolak :selected").html();

        $("#idHapus").val(id);
        $("#namaHapus").val(name);
        $("#target").html(target);
        $("#target").val(target);
        $("#formHapus .modal-body").html('Akhiri proses surat keluar dengan status <strong>' + target + '</strong> ?');

    }
</script>