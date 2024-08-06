<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<!-- Gijgo Calendar -->
<script src="<?php echo base_url('assets/js/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/css/gijgo.min.css') ?>" rel="stylesheet" type="text/css">


<!-- include summernote css/js -->
<link href="<?php echo base_url('assets/summernote/summernote2.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/summernote/summernote-bs4.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/summernote/summernote-list-styles-bs4.css') ?>" rel="stylesheet">

<script src="<?php echo base_url('assets/summernote/summernote.min.js') ?>" defer></script>
<script src="<?php echo base_url('assets/summernote/summernote-bs4.js') ?>" defer></script>
<script src="<?php echo base_url('assets/summernote/summernote-list-styles-bs4.js') ?>" defer></script>

<form action="<?php echo base_url('SuratBiasa/store'); ?>" method="post" enctype="multipart/form-data">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td style="width:20%">Nomor Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input type="hidden" name="id_suratbiasa" id="id_suratbiasa" value="">
                        <input autofocus class="form-control" type="text" name="no_surat" id="no_surat" value="">
                        <small class="text-danger"> <?php echo form_error('no_surat'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Pertimbangan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <textarea class="form-control" type="text" name="pertimbangan" id="pertimbangan"></textarea>
                        <small class="text-danger"> <?php echo form_error('pertimbangan'); ?></small>
                        <small> <i> Tekan tombol shift+enter untuk menambah baris.</i></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Dasar</td>
                    <td style="width:5%">:</td>
                    <td>
                        <textarea style="background-color: white!important;" class="form-control" type="text" name="dasar" id="dasar"></textarea>
                        <small class="text-danger"> <?php echo form_error('dasar'); ?></small>
                        <small> <i> Tekan tombol shift+enter untuk menambah baris.</i></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Kepada</td>
                    <td style="width:5%">:</td>
                    <td>
                        <textarea class="form-control" type="text" name="kepada" id="kepada"></textarea>
                        <small class="text-danger"> <?php echo form_error('kepada'); ?></small>
                        <small> <i> Tekan tombol shift+enter untuk menambah baris.</i></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Untuk</td>
                    <td style="width:5%">:</td>
                    <td>
                        <textarea class="form-control" type="text" name="untuk" id="untuk"></textarea>
                        <small class="text-danger"> <?php echo form_error('untuk'); ?></small>
                        <small> <i> Tekan tombol shift+enter untuk menambah baris.</i></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Kota surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="kota" id="kota" value="">
                        <small class="text-danger"> <?php echo form_error('kota'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tanggal Surat</td>
                    <td style="width:5%">:</td>
                    <td>

                        <input type="text" class="form-control" class="ml-1" autocomplete="off" id="tanggal" name="tanggal" width="276" value="" />
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
                        <input class="form-control" type="text" name="an" id="an" value="">
                        <small class="text-danger"> <?php echo form_error('an'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Jabatan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="jabatan" id="jabatan" value="">
                        <small class="text-danger"> <?php echo form_error('jabatan'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Nama Pejabat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="nama_pejabat" id="nama_pejabat" value="">
                        <small class="text-danger"> <?php echo form_error('nama_pejabat'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">NRP</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="nrp" id="nrp" value="">
                        <small class="text-danger"> <?php echo form_error('nrp'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tembusan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <textarea class="form-control" type="text" name="tembusan" id="tembusan"></textarea>
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
                                <option value="<?= $data['id_jenissurat']; ?>" <?php if ($data['id_jenissurat'] == 22) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $data['nama_jenissurat']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr> -->

                <input type="hidden" name="id_jenissurat" value="54">

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('SuratBiasa'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
                        <button type="submit" class="btn btn-outline-primary">SIMPAN</button>
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
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'listStyles', 'paragraph']],
                ['misc', ['codeview']]
            ]
        });
        $('#dasar').summernote({
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'listStyles', 'paragraph']],
                ['misc', ['codeview']]
            ]
        });
        $('#kepada').summernote({
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'listStyles', 'paragraph']],
                ['misc', ['codeview']]
            ]
        });
        $('#untuk').summernote({
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'listStyles', 'paragraph']],
                ['misc', ['codeview']]
            ]
        });
        $('#tembusan').summernote({
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'listStyles', 'paragraph']],
                ['misc', ['codeview']]
            ]
        });

    });
</script>