<div class="table-responsive">
    <table class="table table-striped">
        <form action="<?php echo base_url('JenisSurat/update'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_jenissurat" id="id_jenissurat" value="<?php echo $jenissurat['id_jenissurat']; ?>">
            <tbody>
                <tr>
                    <td style="width:15%">Nama Jenis Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo htmlentities($jenissurat['nama_jenissurat'], ENT_QUOTES); ?></span>

                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('JenisSurat'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>

                    </td>
                </tr>

            </tbody>
        </form>
    </table>
</div>
<nav aria-label="Page navigation">
    <?php echo $this->pagination->create_links(); ?>
</nav>