<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/css/gijgo.min.css') ?>" rel="stylesheet" type="text/css">

<form action="<?= base_url('Tahanan/store') ?>" method="post" enctype="multipart/form-data">
    <div class="table-responsive">
        <table class="table table-striped">

            <tbody>
                <tr>
                    <td style="width:20%">Nama Tahanan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type=" text" name="nama_tahanan" id="nama_tahanan" value="<?= set_value('nama_tahanan') ?>">
                        <input type="hidden" name="id_tahanan" value="<?= set_value('id_tahanan'); ?>">
                        <small class="text-danger"> <?php echo form_error('nama_tahanan'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">KTP</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="ktp" id="ktp" value="<?= set_value('ktp') ?>">
                        <small class="text-danger"> <?php echo form_error('ktp'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Jenis Kelamin</td>
                    <td style="width:5%">:</td>
                    <td>
                        <select class="form-select" name="jk" id="jk">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Tanggal Lahir</td>
                    <td style="width:5%">:</td>
                    <td>

                        <input class="form-control" class="ml-1" autocomplete="off" id="tanggal_lahir" name="tanggal_lahir" width="276" value="<?= set_value('tanggal_lahir') ?>" />
                        <small class="text-danger"> <?php echo form_error('tanggal_lahir'); ?></small>
                        <script>
                            $('#tanggal_lahir').datepicker({
                                uiLibrary: 'bootstrap4',
                                format: 'dd-mm-yyyy'
                            });
                        </script>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Tanggal Masuk</td>
                    <td style="width:5%">:</td>
                    <td>

                        <input class="form-control" class="ml-1" autocomplete="off" id="tanggal_masuk" name="tanggal_masuk" width="276" value="<?= set_value('tanggal_masuk') ?>" />
                        <small class="text-danger"> <?php echo form_error('tanggal_masuk'); ?></small>
                        <script>
                            $('#tanggal_masuk').datepicker({
                                uiLibrary: 'bootstrap4',
                                format: 'dd-mm-yyyy'
                            });
                        </script>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Kategori</td>
                    <td style="width:5%">:</td>
                    <td>
                        <select class="form-control" name="id_kategori" id="id_kategori">
                            <?php foreach ($kategoritahanans as $data) : ?>
                                <option value="<?= $data['id_kategori']; ?>"><?= $data['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Alamat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type=" text" name="alamat" id="alamat" value="<?= set_value('alamat'); ?>">
                        <small class="text-danger"> <?php echo form_error('alamat'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Umur</td>
                    <td style="width:5%">:</td>
                    <td>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="umur" name="umur" value="<?= set_value('umur'); ?>">
                            <div class="input-group-append">
                                <button onclick="javascript:hitungumur()" class="btn btn-outline-secondary" type="button">HITUNG</button>
                            </div>
                        </div>
                        <small class="text-danger"> <?php echo form_error('umur'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Pekerjaan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <select class="form-control" name="id_pekerjaan" id="id_pekerjaan">
                            <?php foreach ($pekerjaans as $data) : ?>
                                <option value="<?= $data['id_pekerjaan']; ?>"><?= $data['nama_pekerjaan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Agama</td>
                    <td style="width:5%">:</td>
                    <td>
                        <select class="form-control" name="id_agama" id="id_agama">
                            <?php foreach ($agamas as $data) : ?>
                                <option value="<?= $data['id_agama']; ?>"><?= $data['nama_agama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('Tahanan'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
                        <button class="btn btn-outline-primary" type="submit">SIMPAN</button>
                    </td>
                </tr>

            </tbody>

        </table>
    </div>
</form>

<script>
    function hitungumur() {
        var tanggal_lahir = $('#tanggal_lahir').val();
        var year = new Date().getFullYear();
        var tahunlahir = tanggal_lahir.split("-");
        var umur = parseInt(year) - parseInt(tahunlahir[2]);

        if (umur) {
            $('#umur').val(umur);
        } else {
            $('#umur').val('0');

        }
    }
</script>

<nav aria-label="Page navigation">
    <?php echo $this->pagination->create_links(); ?>
</nav>