<div class="modal fade" id="basicModal" tabindex="-1">
    <form id="formHapus" action="<?php echo base_url('KategoriTahanan/delete') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Kategori Tahanan</h5>
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
            <form class="search-form d-flex align-items-center" action="<?php echo base_url('KategoriTahanan'); ?>" method="get">
                <input name="cari" type="text" class="form-control" placeholder="Cari..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 d-flex flex-row-reverse">
        <a style="height:70%" href="<?= base_url('KategoriTahanan/create'); ?>" target="_self" class="btn btn-primary" rel="noopener noreferrer">TAMBAH</a>
    </div>
</div>


<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Kategori Tahanan</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kategoritahanans as $key => $data) :  ?>
                <tr>
                    <th scope="row"><?php echo $key + 1 + $offset; ?></th>
                    <td><?php echo htmlspecialchars($data['nama_kategori'], ENT_QUOTES); ?></td>

                    <td class="text-center ">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a href="<?php echo base_url('KategoriTahanan/show/') . $data['id_kategori']; ?>" type="button" class="btn bg-gradient btn-info"> <i class="bi bi-eye text-white"></i> </a>
                            <?php if (cek_staff()) : ?>
                                <a href="<?php echo base_url('KategoriTahanan/edit/') . $data['id_kategori']; ?>" type="button" class="btn bg-gradient btn-warning"><i class="bi bi-pen text-white"></i></a>
                                <a onclick="javascript:hapusKategoriTahanan('<?php echo $data['id_kategori'] ?>','<?php echo $data['nama_kategori'] ?>')" type="button" data-bs-toggle="modal" data-bs-target="#basicModal" class="btn bg-gradient bg-danger"><i class="bi bi-trash text-white"></i></a>
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
    function hapusKategoriTahanan(id, name) {
        // alert(id);
        // alert(name);
        // var jq = $.noConflict(true);

        // $("#formHapus").attr("action", "/pelayanan");
        $("#idHapus").val(id);
        $("#namaHapus").val(name);
        $("#formHapus .modal-body").html('Hapus data kategori tahanan <strong>' + name + '</strong> ?');

    }
</script>