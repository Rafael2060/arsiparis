<div class="modal fade" id="basicModal" tabindex="-1">
    <form id="formHapus" action="<?php echo base_url('JenisSurat/delete') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Surat Masuk</h5>
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

<div class="row d-flex justify-content-between">
    <div class=" col-sm-12 col-md-4">
        <div class="input-group mb-3">
            <form class="search-form d-flex align-items-center" action="<?php echo base_url('SuratMasuk'); ?>" method="get">
                <input name="cari" type="text" class="form-control" placeholder="Cari..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 d-flex flex-row-reverse">
        <a style="height:70%" href="<?= base_url('SuratMasuk/create'); ?>" target="_self" class="btn btn-primary" rel="noopener noreferrer">TAMBAH</a>
    </div>
</div>


<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">No Surat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suratmasuks as $key => $data) :  ?>
                <tr>
                    <th scope="row"><?php echo $key + 1 + $offset; ?></th>
                    <td><?php echo htmlspecialchars($data['no_surat'], ENT_QUOTES); ?></td>

                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a href="<?php echo base_url('SuratMasuk/show/') . $data['id_suratmasuk']; ?>" type="button" class="btn bg-gradient btn-info"> <i class="bi bi-eye text-white"></i> </a>
                            <a href="<?php echo base_url('SuratMasuk/edit/') . $data['id_suratmasuk']; ?>" type="button" class="btn bg-gradient btn-warning"><i class="bi bi-pen text-white"></i></a>
                            <a onclick="javascript:hapussuratmasuk('<?php echo $data['id_suratmasuk'] ?>','<?php echo $data['no_surat'] ?>')" type="button" data-bs-toggle="modal" data-bs-target="#basicModal" class="btn bg-gradient bg-danger"><i class="bi bi-trash text-white"></i></a>
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
    function hapussuratmasuk(id, name) {
        // alert(id);
        // alert(name);
        // var jq = $.noConflict(true);

        // $("#formHapus").attr("action", "/pelayanan");
        $("#idHapus").val(id);
        $("#namaHapus").val(name);
        $("#formHapus .modal-body").html('Hapus data suratmasuk <strong>' + name + '</strong> ?');

    }
</script>