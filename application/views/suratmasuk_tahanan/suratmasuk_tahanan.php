<!-- modal Hapus Tahanan -->
<div class="modal fade" id="basicModal" tabindex="-1">
    <form id="formHapus" action="<?php echo base_url('SuratMasuk_Tahanan/delete') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Tahanan</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="idHapus" id="idHapus" value="">
                <input type="hidden" name="idSuratMasuk" id="idSuratMasuk" value="<?= $suratmasuk['id_suratmasuk']; ?>">
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">HAPUS</button>
                </div>
            </div>
        </div>
    </form>

</div><!-- End modal hapus tahanan-->

<div class="modal fade" id="modalCari" tabindex="-1">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cari Data Tahanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="row d-flex justify-content-between">

                <div class=" col-sm-12 col-md-4 mx-1 my-1">
                    <div class="input-group mb-3">
                        <form id="pencarian" class="search-form d-flex align-items-center" action="<?php echo base_url('Tahanan/cariJQ'); ?>" method="get">
                            <input name="cari" type="text" class="form-control" placeholder="Cari..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <input type="hidden" name="id_suratmasuk" id="id_suratmasuk" value="<?= $suratmasuk['id_suratmasuk'] ?>">
                            <input type="hidden" name="url" id="url" value="<?= base_url('SuratMasuk_Tahanan/store') ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="modal-body" id="hasil-cari">



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <a href="<?= base_url('SuratMasuk_Tahanan') . '/' . $suratmasuk['id_suratmasuk'] ?>"></a> -->
                <!-- <button type="submit" class="btn btn-danger">HAPUS</button> -->
            </div>
        </div>
    </div>

</div><!-- End Basic Modal-->

<div class="row d-flex justify-content-between">
    <span>Nomor surat : <strong> <?= $suratmasuk['no_surat']; ?> </strong></span>
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
        <a type="button" style="height:70%" class="btn btn-primary" rel="noopener noreferrer" data-bs-toggle="modal" data-bs-target="#modalCari">TAMBAH</a>
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
            <?php foreach ($suratmasuk_tahanans as $key => $data) :  ?>
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
                            <a target="_blank" href="<?php echo base_url('Tahanan/show/') . $data['id_tahanan']; ?>" type="button" class="btn bg-gradient btn-info"> <i class="bi bi-eye text-white"></i> </a>
                            <!-- <a href="<?php echo base_url('Tahanan/edit/') . $data['id_tahanan']; ?>" type="button" class="btn bg-gradient btn-warning"><i class="bi bi-pen text-white"></i></a> -->
                            <a onclick="javascript:hapusTahanan('<?php echo $data['id'] ?>','<?php echo $data['nama_tahanan'] ?>')" type="button" data-bs-toggle="modal" data-bs-target="#basicModal" class="btn bg-gradient bg-danger"><i class="bi bi-trash text-white"></i></a>
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
<script src="<?php echo base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        $('#pencarian').submit(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $('#hasil-cari').html('');
            var url = $(this).attr('action');
            var token = $("_token");
            //alert($(this).serialize());
            $.ajax({
                type: "post",
                url: url,
                data: $(this).serialize(),
                beforeFilter: function() {
                    //$('#loader').css('display', 'block');
                    //alert(data);
                },
                success: function(data1) {

                    if (data1) {
                        $('#hasil-cari').html(data1);
                    } else {

                        $('#hasil-cari').html("Gagal");
                        $("#loader").fadeOut(1000);
                    }
                }

            });

        });
    });

    function hapusTahanan(id, name) {
        // alert(id);
        // alert(name);
        // var jq = $.noConflict(true);

        // $("#formHapus").attr("action", "/pelayanan");
        $("#idHapus").val(id);
        $("#namaHapus").val(name);
        $("#formHapus .modal-body").html('Hapus data tahanan <strong>' + name + '</strong> ?');

    }

    function pilih(id_tahanan) {

        var id_suratmasuk = $('#id_suratmasuk').val();
        var url = $('#url').val();
        var id_tahanan = id_tahanan;
        // alert(url);
        // alert(id_suratmasuk);
        // alert(id_tahanan);

        $.ajax({
            type: "POST",
            url: url,
            data: {
                'id_suratmasuk': id_suratmasuk,
                'id_tahanan': id_tahanan,
            },
            beforeFilter: function() {
                //$('#loader').css('display', 'block');
                //alert(data);
            },
            success: function(data1) {

                if (data1) {
                    location.reload();
                    // $('#hasil-cari').html(data1);
                } else {

                    $('#hasil-cari').html("Gagal");
                    $("#loader").fadeOut(1000);
                }
            }

        });

        $('#modalCari').modal('toggle');
    };
</script>