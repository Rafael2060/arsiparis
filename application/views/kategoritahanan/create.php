<div class="table-responsive">
    <table class="table table-striped">
        <form action="<?php echo base_url('KategoriTahanan/store'); ?>" method="post" enctype="multipart/form-data">
            <tbody>
                <tr>
                    <td style="width:15%">Nama Kategori Tahanan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" value="<?php echo htmlentities(set_value('nama_kategori'), ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('nama_kategori'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('KategoriTahanan'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
                        <button type="submit" class="btn btn-outline-primary">SIMPAN</button>
                    </td>
                </tr>

            </tbody>
        </form>
    </table>
</div>
<nav aria-label="Page navigation">
    <?php echo $this->pagination->create_links(); ?>
</nav>