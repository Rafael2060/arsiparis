<div class="table-responsive">
    <table class="table table-striped">
        <form action="<?php echo base_url('JenisSurat/store'); ?>" method="post" enctype="multipart/form-data">
            <tbody>
                <tr>
                    <td style="width:15%">Nama Jenis Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="nama_jenissurat" id="nama_jenissurat" value="<?php echo htmlentities(set_value('nama_jenissurat'), ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('nama_jenissurat'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('JenisSurat'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
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