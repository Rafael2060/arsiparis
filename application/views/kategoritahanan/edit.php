<div class="table-responsive">
    <table class="table table-striped">
        <form action="<?php echo base_url('KategoriTahanan/update'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_kategori" id="id_kategori" value="<?php echo $kategoritahanan['id_kategori']; ?>">
            <tbody>
                <tr>
                    <td style="width:15%">Nama Jenis Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" value="<?php echo htmlentities($kategoritahanan['nama_kategori'], ENT_QUOTES); ?>">
                        <input class="form-control" type="hidden" name="nama_kategorilama" id="nama_kategorilama" value="<?php echo htmlentities($kategoritahanan['nama_kategori'], ENT_QUOTES); ?>">

                        <small class="text-danger"> <?php echo form_error('nama_kategori'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('KategoriTahanan'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
                        <button type="submit" class="btn btn-outline-primary">UPDATE</button>
                    </td>
                </tr>

            </tbody>
        </form>
    </table>
</div>
<nav aria-label="Page navigation">
    <?php echo $this->pagination->create_links(); ?>
</nav>