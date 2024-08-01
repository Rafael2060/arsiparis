<div class="modal fade" id="basicModal" tabindex="-1">
    <form id="formHapus" action="<?php echo base_url('Tahanan/delete') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Tahanan</h5>
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
            <form class="search-form d-flex align-items-center" action="<?php echo base_url('Tahanan'); ?>" method="get">
                <input name="cari" type="text" class="form-control" placeholder="Cari..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 d-flex flex-row-reverse">
        <?php if (cek_staff()) : ?>
            <a style="height:70%" href="<?= base_url('Tahanan/create'); ?>" target="_self" class="btn btn-primary" rel="noopener noreferrer">TAMBAH</a>
        <?php endif; ?>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Tahanan</th>
                <th scope="col">Kategori Tahanan</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tahanans as $key => $data) :  ?>
                <tr>
                    <th scope="row"><?php echo $key + 1 + $offset; ?></th>
                    <td><?php echo htmlspecialchars($data['nama_tahanan'], ENT_QUOTES); ?></td>
                    <td><?php echo htmlspecialchars($data['nama_kategori'], ENT_QUOTES); ?></td>
                    <?php
                    if ($data['jk'] == 'L') {
                        $jk = 'Laki-Laki';
                    } else {
                        $jk = 'Perempuan';
                    } ?>
                    <td><?php echo htmlspecialchars($jk, ENT_QUOTES); ?></td>
                    <td><?php echo date("d-m-Y", strtotime($data['tanggal_masuk'])); ?></td>

                    <td class="text-center ">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a href="<?php echo base_url('Tahanan/show/') . $data['id_tahanan']; ?>" type="button" class="btn bg-gradient btn-info"> <i class="bi bi-eye text-white"></i> </a>
                            <?php if (cek_staff()) : ?>
                                <a href="<?php echo base_url('Tahanan/edit/') . $data['id_tahanan']; ?>" type="button" class="btn bg-gradient btn-warning"><i class="bi bi-pen text-white"></i></a>
                                <a href="<?php echo base_url('Tahanan/suratmasuk/') . $data['id_tahanan']; ?>" type="button" class="btn bg-gradient btn-primary"><i class="bi bi-box-arrow-in-right text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Surat Masuk"></i></a>
                                <a href="<?php echo base_url('Tahanan/suratkeluar/') . $data['id_tahanan']; ?>" type="button" class="btn bg-gradient btn-secondary"><i class="bi bi-box-arrow-right text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Surat Keluar"></i></a>
                                <a onclick="javascript:hapusTahanan('<?php echo $data['id_tahanan'] ?>','<?php echo $data['nama_tahanan'] ?>')" type="button" data-bs-toggle="modal" data-bs-target="#basicModal" class="btn bg-gradient bg-danger"><i class="bi bi-trash text-white"></i></a>
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
    function hapusTahanan(id, name) {
        // alert(id);
        // alert(name);
        // var jq = $.noConflict(true);

        // $("#formHapus").attr("action", "/pelayanan");
        $("#idHapus").val(id);
        $("#namaHapus").val(name);
        $("#formHapus .modal-body").html('Hapus data tahanan <strong>' + name + '</strong> ?');

    }
</script>