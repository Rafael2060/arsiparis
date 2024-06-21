<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/css/gijgo.min.css') ?>" rel="stylesheet" type="text/css">

<div class="modal fade" id="basicModal" tabindex="-1">
    <form id="formHapus" action="<?php echo base_url('SuratPerintah/delete') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Surat Perintah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="idHapus" id="idHapus" value="">
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">HAPUS</button>
                </div>
            </div>
        </div>
    </form>

</div><!-- End Basic Modal-->

<div class="modal fade" id="modalCari" tabindex="-1">
    <form id="formCari" action="<?php echo base_url('SuratPerintah') ?>" method="get">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cari Data Surat Perintah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="form-group row mx-1 my-1">
                    <label for="no_surat" class="col-sm-3 col-form-label">No Surat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_surat" name="no_surat">
                    </div>
                </div>

                <div class="form-group row mx-1 my-1">
                    <label for="no_agenda" class="col-sm-3 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-9">
                        <input class="form-control" class="ml-1" autocomplete="off" id="tanggal_awal" name="tanggal_awal" width="276" value="<?= set_value('tanggal_awal') ?>" />
                        <small class="text-danger"> <?php echo form_error('tanggal_awal'); ?></small>
                        <script>
                            $('#tanggal_awal').datepicker({
                                uiLibrary: 'bootstrap4',
                                format: 'dd-mm-yyyy'
                            });
                        </script>
                    </div>
                </div>

                <div class="form-group row mx-1 my-1">
                    <label for="no_agenda" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-9">
                        <input class="form-control" class="ml-1" autocomplete="off" id="tanggal_akhir" name="tanggal_akhir" width="276" value="<?= set_value('tanggal_akhir') ?>" />
                        <small class="text-danger"> <?php echo form_error('tanggal_akhir'); ?></small>
                        <script>
                            $('#tanggal_akhir').datepicker({
                                uiLibrary: 'bootstrap4',
                                format: 'dd-mm-yyyy'
                            });
                        </script>
                    </div>
                </div>

                <div class="form-group row mx-1 my-1">
                    <label for="id_jenissurat" class="col-sm-3 col-form-label">Jenis Surat</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="id_jenissurat" id="id_jenissurat">
                            <option value="">Semua</option>
                            <?php foreach ($jenissurats as $data) :  ?>
                                <?php if ($data['tipe'] == 'm') {
                                    $tipe = 'Masuk';
                                } else {
                                    $tipe = 'Keluar';
                                }
                                ?>
                                <option value="<?= $data['id_jenissurat']; ?>"><?= $data['nama_jenissurat']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">CARI</button>
                </div>
            </div>
        </div>
    </form>

</div><!-- End cari Modal-->

<div class="row d-flex justify-content-between">
    <div class=" col-sm-12 col-md-4">
        <div class="input-group mb-3">
            <form class="search-form d-flex align-items-center" action="<?php echo base_url('SuratPerintah'); ?>" method="get">
                <!-- <input name="cari" type="text" class="form-control" placeholder="Cari..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div> -->
                <div class="input-group-append">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalCari" class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 d-flex flex-row-reverse">
        <?php if (cek_staff()) : ?>
            <a style="height:70%" href="<?= base_url('SuratPerintah/create'); ?>" target="_self" class="btn btn-primary" rel="noopener noreferrer">TAMBAH</a>
        <?php endif; ?>
        <!-- <a style="height:70%" href="<?= base_url('SuratPerintah/export/?') . 'no_surat=' . $parameter['no_surat'] . '&tanggal_awal=' . $parameter['tanggal_awal'] . '&tanggal_akhir=' . $parameter['tanggal_akhir'] . '&id_jenissurat=' . $parameter['id_jenissurat']; ?>" target="_self" class="btn btn-success" rel="noopener noreferrer">CETAK</a> -->
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead class="">
            <tr>
                <th scope="col">#</th>
                <th scope="col">No Surat</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jenis Surat</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suratperintahs as $key => $data) : ?>
                <tr>
                    <th scope="row"><?php echo $key + 1 + $offset; ?></th>
                    <td><?php echo htmlspecialchars($data['no_surat'], ENT_QUOTES); ?></td>
                    <?php $tanggal = date("d-m-Y", strtotime($data['tanggal'])); ?>
                    <td><?php echo htmlspecialchars($tanggal, ENT_QUOTES); ?></td>
                    <td><?php echo htmlspecialchars($data['nama_jenissurat'], ENT_QUOTES); ?></td>

                    <td class="text-left">
                        <div class="btn-group btn-group-sm text-left " role="group" aria-label="Basic example">
                            <a target="_blank" href="<?php echo base_url('SuratPerintah/show/?id=') . $data['id_suratperintah']; ?>" type="button" class="btn bg-gradient btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Print"> <i class="bi bi-printer text-white"></i> </a>

                            <?php if (cek_staff()) : ?>
                                <a href="<?php echo base_url('SuratPerintah/edit/') . $data['id_suratperintah']; ?>" type="button" class="btn bg-gradient btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class="bi bi-pen text-white"></i></a>
                            <?php endif; ?>

                            <?php if (cek_kasattahti() || cek_kapolres()) : ?>
                                <?php if ($data['qrcode'] == '') : ?>
                                    <a href="<?php echo base_url('SuratPerintah/tte/') . $data['id_suratperintah']; ?>" type="button" class="btn bg-gradient btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="TTE"><i class="bi bi-patch-check text-white"></i></a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (cek_staff()) : ?>
                                <a onclick="javascript:hapussuratperintah('<?php echo $data['id_suratperintah'] ?>','<?php echo $data['no_surat'] ?>')" type="button" data-bs-toggle="modal" data-bs-target="#basicModal" class="btn bg-gradient bg-danger"><i class="bi bi-trash text-white"></i></a>
                            <?php endif; ?>

                        </div>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
</div>
<nav aria-label="Page navigation">
    <?php echo $this->pagination->create_links(); ?>
</nav>

<small>Total data : <?= $total; ?></small>

<script>
    function hapussuratperintah(id, name) {
        // alert(id);
        // alert(name);
        // var jq = $.noConflict(true);

        // $("#formHapus").attr("action", "/pelayanan");
        $("#idHapus").val(id);
        $("#namaHapus").val(name);
        $("#formHapus .modal-body").html('Hapus data surat perintah <strong>' + name + '</strong> ?');

    }
</script>