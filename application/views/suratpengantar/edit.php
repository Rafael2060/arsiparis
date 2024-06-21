<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/css/gijgo.min.css') ?>" rel="stylesheet" type="text/css">

<!-- include summernote css/js -->
<link href="<?php echo base_url('assets/summernote/summernote2.css') ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/summernote/summernote.min.js') ?>" defer></script>

<form action="<?php echo base_url('SuratPengantar/update'); ?>" method="post" enctype="multipart/form-data">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td style="width:20%">Nomor Pengantar</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input type="hidden" name="id_suratpengantar" id="id_suratpengantar" value="<?php echo $suratpengantar['id_suratpengantar']; ?>">
                        <input autofocus class="form-control" type="text" name="no_surat" id="no_surat" value="<?php echo $suratpengantar['no_surat']; ?>">
                        <small class="text-danger"> <?php echo form_error('no_surat'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Klasifikasi</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="klasifikasi" id="klasifikasi" value="<?php echo $suratpengantar['klasifikasi']; ?>" />
                        <small class="text-danger"> <?php echo form_error('klasifikasi'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Lampiran</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="lampiran" id="lampiran" value="<?php echo $suratpengantar['lampiran']; ?>" />
                        <small class="text-danger"> <?php echo form_error('lampiran'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Perihal</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="perihal" id="perihal" value="<?php echo $suratpengantar['perihal']; ?>" />
                        <small class="text-danger"> <?php echo form_error('perihal'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Kepada</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="kepada" id="kepada" value="<?php echo $suratpengantar['kepada']; ?>" />
                        <small class="text-danger"> <?php echo form_error('kepada'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Di</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input style="background-color: white!important;" class="form-control" type="text" name="di" id="di" value="<?php echo $suratpengantar['di']; ?>" />
                        <small class="text-danger"> <?php echo form_error('di'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Rujukan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <textarea class="form-control" type="text" name="rujukan" id="rujukan"><?php echo $suratpengantar['rujukan']; ?></textarea>
                        <small class="text-danger"> <?php echo form_error('rujukan'); ?></small>
                        <small> <i> Tekan tombol shift+enter untuk menambah baris.</i></small>

                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Sehubungan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <textarea class="form-control" type="text" name="sehubungan" id="sehubungan"><?php echo $suratpengantar['sehubungan']; ?></textarea>
                        <small class="text-danger"> <?php echo form_error('sehubungan'); ?></small>
                        <small> <i> Tekan tombol shift+enter untuk menambah baris.</i></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Kota surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="kota" id="kota" value="<?php echo $suratpengantar['kota']; ?>">
                        <small class="text-danger"> <?php echo form_error('kota'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tanggal Surat</td>
                    <td style="width:5%">:</td>
                    <td>

                        <input type="text" class="form-control" class="ml-1" autocomplete="off" id="tanggal" name="tanggal" width="276" value="<?php echo date('d-m-Y', strtotime($suratpengantar['tanggal'])); ?>" />
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
                        <input class="form-control" type="text" name="an" id="an" value="<?php echo $suratpengantar['an']; ?>">
                        <small class="text-danger"> <?php echo form_error('an'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Jabatan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="jabatan" id="jabatan" value="<?php echo $suratpengantar['jabatan']; ?>">
                        <small class="text-danger"> <?php echo form_error('jabatan'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Nama Pejabat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="nama_pejabat" id="nama_pejabat" value="<?php echo $suratpengantar['nama_pejabat']; ?>">
                        <small class="text-danger"> <?php echo form_error('nama_pejabat'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">NRP</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="nrp" id="nrp" value="<?php echo $suratpengantar['nrp']; ?>">
                        <small class="text-danger"> <?php echo form_error('nrp'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tembusan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <textarea class="form-control" type="text" name="tembusan" id="tembusan"><?php echo $suratpengantar['tembusan']; ?></textarea>
                        <small class="text-danger"> <?php echo form_error('tembusan'); ?></small>
                        <small> <i> Tekan tombol shift+enter untuk menambah baris.</i></small>
                    </td>
                </tr>

                <!-- <tr>
                    <td style="width:20%">Jenis Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <select class="form-control" name="id_jenissurat" id="id_jenissurat">
                            <?php foreach ($jenissurats as $data) : ?>
                                <option value="<?= $data['id_jenissurat']; ?>" <?php if ($data['id_jenissurat'] == $suratpengantar['id_jenissurat']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $data['nama_jenissurat']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr> -->

                <input type="hidden" name="id_jenissurat" value="24">

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('SuratPengantar'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
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