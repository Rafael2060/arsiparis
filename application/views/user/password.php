<div class="table-responsive">
    <table class="table table-striped">
        <form action="<?php echo base_url('User/updatePassword'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?php echo $user['id']; ?>">
            <tbody>
                <tr>
                    <td style="width:10%">Nama</td>
                    <td style="width:5%">:</td>
                    <td><?php echo htmlentities($user['name'], ENT_QUOTES); ?></td>

                </tr>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><?php echo htmlentities($user['username'], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td> <input class=" form-control" type="password" name="password" id="password" value="">
                        <small class="text-danger"> <?php echo form_error('password'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td>Konfirmasi Password</td>
                    <td>:</td>
                    <td> <input class=" form-control" type="password" name="password2" id="password2" value="">
                        <small class="text-danger"> <?php echo form_error('password2'); ?></small>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('Admin'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
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