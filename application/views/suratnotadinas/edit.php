<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/css/gijgo.min.css') ?>" rel="stylesheet" type="text/css">

<!-- include summernote css/js -->
<link href="<?php echo base_url('assets/summernote/summernote2.css') ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/summernote/summernote.min.js') ?>" defer></script>

<form action="<?php echo base_url('SuratNotaDinas/update'); ?>" method="post" enctype="multipart/form-data">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td style="width:20%">Nomor Surat Nota Dinas</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input type="hidden" name="id_suratnotadinas" id="id_suratnotadinas" value="<?= $suratnotadinas['id_suratnotadinas'] ?>">
                        <input autofocus class="form-control" type="text" name="no_surat" id="no_surat" value="<?php echo htmlentities($suratnotadinas['no_surat'], ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('no_surat'); ?></small>

                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Kepada</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="kepada" id="kepada" value="<?php echo htmlentities($suratnotadinas['kepada'], ENT_QUOTES); ?>" />
                        <small class="text-danger"> <?php echo form_error('kepada'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Dari</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input style="background-color: white!important;" class="form-control" type="text" name="dari" id="dari" value="<?php echo htmlentities($suratnotadinas['dari'], ENT_QUOTES); ?>" />
                        <small class="text-danger"> <?php echo form_error('dari'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Perihal</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="perihal" id="perihal" value="<?php echo $suratnotadinas['perihal'] ?>" />
                        <small class="text-danger"> <?php echo form_error('perihal'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Rujukan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <textarea class="form-control" type="text" name="rujukan" id="rujukan"><?php echo $suratnotadinas['rujukan'] ?></textarea>
                        <small class="text-danger"> <?php echo form_error('rujukan'); ?></small>
                        <small> <i> Tekan tombol shift+enter untuk menambah baris.</i></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Sehubungan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <textarea class="form-control" type="text" name="sehubungan" id="sehubungan"><?php echo $suratnotadinas['sehubungan'] ?></textarea>
                        <small class="text-danger"> <?php echo form_error('sehubungan'); ?></small>
                        <small> <i> Tekan tombol shift+enter untuk menambah baris.</i></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Kota surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="kota" id="kota" value="<?php echo $suratnotadinas['kota'] ?>">
                        <small class="text-danger"> <?php echo form_error('kota'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tanggal Surat</td>
                    <td style="width:5%">:</td>
                    <td>

                        <input type="text" class="form-control" class="ml-1" autocomplete="off" id="tanggal" name="tanggal" width="276" value="<?= date('d-m-Y', strtotime($suratnotadinas['tanggal'])) ?>" />
                        <small class="text-danger"> <?php echo form_error('tanggal'); ?></small>
                        <script>
                            $('#tanggal').datepicker({
                                uiLibrary: 'bootstrap4',
                                format: 'dd-mm-yyyy'
                            });
                        </script>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Atas Nama (an)</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="an" id="an" value="<?php echo htmlentities($suratnotadinas['an'], ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('an'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Jabatan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="jabatan" id="jabatan" value="<?php echo htmlentities($suratnotadinas['jabatan'], ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('jabatan'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Nama Pejabat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="nama_pejabat" id="nama_pejabat" value="<?php echo htmlentities($suratnotadinas['nama_pejabat'], ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('nama_pejabat'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">NRP</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="nrp" id="nrp" value="<?php echo htmlentities($suratnotadinas['nrp'], ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('nrp'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tembusan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <textarea class="form-control" type="text" name="tembusan" id="tembusan"><?php echo htmlentities($suratnotadinas['tembusan'], ENT_QUOTES); ?></textarea>
                        <small class="text-danger"> <?php echo form_error('tembusan'); ?></small>
                        <small> <i> Tekan tombol shift+enter untuk menambah baris.</i></small>
                    </td>
                </tr>



                <input type="hidden" name="id_jenissurat" id="id_jenissurat" value="23">


                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('SuratNotaDinas'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
                        <button type="submit" class="btn btn-outline-primary">PERBARUI</button>

                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#rujukan').summernote({
            height: 150,
        });
        $('#sehubungan').summernote({
            height: 150,
        });
        $('#tembusan').summernote({
            height: 150,
        });

    });
</script>