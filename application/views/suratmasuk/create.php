<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/css/gijgo.min.css') ?>" rel="stylesheet" type="text/css">

<form action="<?php echo base_url('SuratMasuk/store'); ?>" method="post" enctype="multipart/form-data">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td style="width:20%">Nomor Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input autofocus class="form-control" type="text" name="no_surat" id="no_surat" value="<?php echo htmlentities(set_value('no_surat'), ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('no_surat'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Nomor Agenda</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="no_agenda" id="no_agenda" value="<?php echo htmlentities(set_value('no_agenda'), ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('no_agenda'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Asal Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="asal_surat" id="asal_surat" value="<?php echo htmlentities(set_value('asal_surat'), ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('asal_surat'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tanggal Surat</td>
                    <td style="width:5%">:</td>
                    <td>

                        <input type="text" class="form-control" class="ml-1" autocomplete="off" id="tanggal_surat" name="tanggal_surat" width="276" value="<?= set_value('tanggal_surat') ?>" />
                        <small class="text-danger"> <?php echo form_error('tanggal_surat'); ?></small>
                        <script>
                            $('#tanggal_surat').datepicker({
                                uiLibrary: 'bootstrap4',
                                format: 'dd-mm-yyyy'
                            });
                        </script>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Tanggal Diterima</td>
                    <td style="width:5%">:</td>
                    <td>

                        <input type="text" class="form-control" class="ml-1" autocomplete="off" id="tanggal_diterima" name="tanggal_diterima" width="276" value="<?= set_value('tanggal_diterima') ?>" />
                        <small class="text-danger"> <?php echo form_error('tanggal_diterima'); ?></small>
                        <script>
                            $('#tanggal_diterima').datepicker({
                                uiLibrary: 'bootstrap4',
                                format: 'dd-mm-yyyy'
                            });
                        </script>
                    </td>
                </tr>


                <tr>
                    <td style="width:20%">Jenis Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <select class="form-control" name="id_jenissurat" id="id_jenissurat">
                            <?php foreach ($jenissurats as $data) : ?>
                                <option value="<?= $data['id_jenissurat']; ?>"><?= $data['nama_jenissurat']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Perihal</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="perihal" id="perihal" value="<?php echo htmlentities(set_value('perihal'), ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('perihal'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Lampiran</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="number" name="lampiran" id="lampiran" value="<?php echo htmlentities(set_value('lampiran'), ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('lampiran'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">File surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input type="file" name="user_file" id="user_file" size="20" />
                        <small class="text-danger"> <?php echo form_error('user_file'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('SuratMasuk'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
                        <button type="submit" class="btn btn-outline-primary">SIMPAN</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</form>