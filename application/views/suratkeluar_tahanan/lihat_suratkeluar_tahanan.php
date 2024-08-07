<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/css/gijgo.min.css') ?>" rel="stylesheet" type="text/css">

<div class="modal fade" id="basicModal" tabindex="-1">
    <form id="formHapus" action="<?php echo base_url('SuratKeluar/delete') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Surat Keluar</h5>
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
    <form id="formCari" action="<?php echo base_url('SuratKeluar') ?>" method="get">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cari Data Surat Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="form-group row mx-1 my-1">
                    <label for="no_surat" class="col-sm-3 col-form-label">No Surat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_surat" name="no_surat">
                    </div>
                </div>
                <div class="form-group row mx-1 my-1">
                    <label for="no_agenda" class="col-sm-3 col-form-label">No Agenda</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_agenda" name="no_agenda">
                    </div>
                </div>


                <div class="form-group row mx-1 my-1">
                    <label for="no_agenda" class="col-sm-3 col-form-label">Tanggal Dikirim Awal</label>
                    <div class="col-sm-9">
                        <input class="form-control" class="ml-1" autocomplete="off" id="tanggal_dikirim_awal" name="tanggal_dikirim_awal" width="276" value="<?= set_value('tanggal_dikirim_awal') ?>" />
                        <small class="text-danger"> <?php echo form_error('tanggal_dikirim_awal'); ?></small>
                        <script>
                            $('#tanggal_dikirim_awal').datepicker({
                                uiLibrary: 'bootstrap4',
                                format: 'dd-mm-yyyy'
                            });
                        </script>
                    </div>
                </div>
                <div class="form-group row mx-1 my-1">
                    <label for="no_agenda" class="col-sm-3 col-form-label">Tanggal Dikirim Akhir</label>
                    <div class="col-sm-9">
                        <input class="form-control" class="ml-1" autocomplete="off" id="tanggal_dikirim_akhir" name="tanggal_dikirim_akhir" width="276" value="<?= set_value('tanggal_dikirim_akhir') ?>" />
                        <small class="text-danger"> <?php echo form_error('tanggal_dikirim_akhir'); ?></small>
                        <script>
                            $('#tanggal_dikirim_akhir').datepicker({
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
            <form class="search-form d-flex align-items-center" action="<?php echo base_url('SuratKeluar'); ?>" method="get">
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
        <!-- <a style="height:70%" href="<?= base_url('SuratKeluar/create'); ?>" target="_self" class="btn btn-primary" rel="noopener noreferrer">TAMBAH</a> -->
        <!-- <a style="height:70%" href="<?= base_url('SuratKeluar/export/?') . 'no_surat=' . $parameter['no_surat'] . '&no_agenda=' . $parameter['no_agenda'] . '&tanggal_dikirim_awal=' . $parameter['tanggal_dikirim_awal'] . '&tanggal_dikirim_akhir=' . $parameter['tanggal_dikirim_akhir'] . '&id_jenissurat=' . $parameter['id_jenissurat']; ?>" target="_self" class="btn btn-success" rel="noopener noreferrer">CETAK</a> -->
    </div>
</div>

<?php if (isset($nama_tahanan)) :  ?>
    <div>
        <h5>Nama Tahanan : <?= $nama_tahanan ?></h5>
    </div>
<?php else : ?>

<?php endif; ?>

<div class="table-responsive">
    <table class="table table-striped">
        <thead class="">
            <tr>
                <th scope="col">#</th>
                <th scope="col">No Surat</th>
                <th scope="col">Tanggal Dikirim</th>
                <th scope="col">Jenis Surat</th>
                <th scope="col">Tujuan Surat</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suratkeluars as $key => $data) :  ?>
                <tr>
                    <th scope="row"><?php echo $key + 1 + $offset; ?></th>
                    <td><?php echo htmlspecialchars($data['no_surat'], ENT_QUOTES); ?></td>
                    <?php $tanggal = date("d-m-Y", strtotime($data['tanggal_dikirim'])); ?>
                    <td><?php echo htmlspecialchars($tanggal, ENT_QUOTES); ?></td>
                    <td><?php echo htmlspecialchars($data['nama_jenissurat'], ENT_QUOTES); ?></td>
                    <td><?php echo htmlspecialchars($data['tujuan_surat'], ENT_QUOTES); ?></td>

                    <td class="text-center">
                        <div class="btn-group btn-group-sm text-center" role="group" aria-label="Basic example">
                            <a href="<?php echo base_url('SuratKeluar/show/') . $data['id_suratkeluar']; ?>" type="button" class="btn bg-gradient btn-info"> <i class="bi bi-eye text-white"></i> </a>
                            <a href="<?php echo base_url('SuratKeluar/edit/') . $data['id_suratkeluar']; ?>" type="button" class="btn bg-gradient btn-warning"><i class="bi bi-pen text-white"></i></a>
                            <a href="<?php echo base_url('SuratKeluar/tahanan/') . $data['id_suratkeluar']; ?>" type="button" class="btn bg-gradient btn-success" data-toggle="tooltip" data-placement="top" title="Tambah Tahanan"><i class="bi bi-person-plus-fill text-white"></i></a>
                            <a onclick="javascript:hapussuratkeluar('<?php echo $data['id_suratkeluar'] ?>','<?php echo $data['no_surat'] ?>')" type="button" data-bs-toggle="modal" data-bs-target="#basicModal" class="btn bg-gradient bg-danger"><i class="bi bi-trash text-white"></i></a>
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
    function hapussuratkeluar(id, name) {
        // alert(id);
        // alert(name);
        // var jq = $.noConflict(true);

        // $("#formHapus").attr("action", "/pelayanan");
        $("#idHapus").val(id);
        $("#namaHapus").val(name);
        $("#formHapus .modal-body").html('Hapus data surat keluar <strong>' + name + '</strong> ?');

    }
</script>