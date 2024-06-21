<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/css/gijgo.min.css') ?>" rel="stylesheet" type="text/css">

<!-- include summernote css/js -->
<link href="<?php echo base_url('assets/summernote/summernote2.css') ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/summernote/summernote.min.js') ?>" defer></script>

<form action="<?php echo base_url('SuratPerintah/updatette'); ?>" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="basicModal" tabindex="-1">
        <form id="formHapus" action="<?php echo base_url('SuratPerintah/delete') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">TTE Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="hidden" name="id_suratperintah" id="id_suratperintah" value="<?= $suratperintah['id_suratperintah'] ?>">
                    <div class="modal-body">
                        <p>TTE Surat ini ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">TTE</button>
                    </div>
                </div>
            </div>
        </form>

    </div><!-- End Basic Modal-->
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td style="width:20%">Nomor Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input type="hidden" name="id_suratperintah" id="id_suratperintah" value="<?= $suratperintah['id_suratperintah'] ?>">
                        <p><?php echo htmlentities($suratperintah['no_surat'], ENT_QUOTES); ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Pertimbangan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo $suratperintah['pertimbangan']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Dasar</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo $suratperintah['dasar']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Kepada</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo $suratperintah['kepada']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Untuk</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo $suratperintah['untuk']; ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Kota surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo $suratperintah['kota']; ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tanggal Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo date('d-M-Y', strtotime($suratperintah['tanggal'])); ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Atas Nama (an)</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo $suratperintah['an']; ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Jabatan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo $suratperintah['jabatan']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Nama Pejabat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo $suratperintah['nama_pejabat']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">NRP</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo $suratperintah['nrp']; ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tembusan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo $suratperintah['tembusan']; ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Jenis Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <select class="form-control" name="id_jenissurat" id="id_jenissurat">
                            <?php foreach ($jenissurats as $data) : ?>
                                <option disabled value="<?= $data['id_jenissurat']; ?>" <?php if ($data['id_jenissurat'] == $suratperintah['id_jenissurat']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $data['nama_jenissurat']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('SuratPerintah'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
                        <!-- <button type="submit" class="btn btn-outline-primary">PERBARUI</button> -->
                        <?php if (cek_kasattahti() || cek_kapolres()) : ?>
                            <!-- <a href="<?php echo base_url('SuratPerintah/tte/') . $suratperintah['id_suratperintah']; ?>" type="button" class="btn bg-gradient btn-info">TTE</a> -->
                            <a data-bs-toggle="modal" data-bs-target="#basicModal" type="button" class="btn bg-gradient btn-success text-white">TTE</a>
                        <?php endif; ?>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#pertimbangan').summernote({
            height: 150,
        });
        $('#dasar').summernote({
            height: 150,
        });
        $('#kepada').summernote({
            height: 150,
        });
        $('#untuk').summernote({
            height: 150,
        });
        $('#tembusan').summernote({
            height: 150,
        });

    });

    function tte(id, name) {
        // alert(id);
        // alert(name);
        // var jq = $.noConflict(true);

        // $("#formHapus").attr("action", "/pelayanan");
        $("#idHapus").val(id);
        $("#namaHapus").val(name);
        $("#formHapus .modal-body").html('Hapus data surat perintah <strong>' + name + '</strong> ?');

    }
</script>