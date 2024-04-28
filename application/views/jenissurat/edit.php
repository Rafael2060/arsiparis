<div class="table-responsive">
    <table class="table table-striped">
        <form action="<?php echo base_url('JenisSurat/update'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_jenissurat" id="id_jenissurat" value="<?php echo $jenissurat['id_jenissurat']; ?>">
            <tbody>
                <tr>
                    <td style="width:15%">Nama Jenis Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="nama_jenissurat" id="nama_jenissurat" value="<?php echo htmlentities($jenissurat['nama_jenissurat'], ENT_QUOTES); ?>">
                        <input class="form-control" type="hidden" name="nama_jenissuratlama" id="nama_jenissuratlama" value="<?php echo htmlentities($jenissurat['nama_jenissurat'], ENT_QUOTES); ?>">

                        <small class="text-danger"> <?php echo form_error('nama_jenissurat'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('JenisSurat'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
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