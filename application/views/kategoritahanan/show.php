<div class="table-responsive">
    <table class="table table-striped">


        <tbody>
            <tr>
                <td style="width:20%">Nama Kategori Tahanan</td>
                <td style="width:5%">:</td>
                <td>
                    <span><?php echo htmlentities($kategoritahanan['nama_kategori'], ENT_QUOTES); ?></span>

                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>
                    <a href="<?php echo base_url('KategoriTahanan'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>

                </td>
            </tr>

        </tbody>

    </table>
</div>
<nav aria-label="Page navigation">
    <?php echo $this->pagination->create_links(); ?>
</nav>