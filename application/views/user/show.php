<div class="table-responsive">
    <table class="table table-striped">

        <tbody>
            <tr>
                <td style="width:10%">Nama</td>
                <td style="width:5%">:</td>
                <td><?php echo $user['name']; ?></td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><?php echo $user['username']; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $user['email']; ?></td>
            </tr>
            <tr>
                <td>Image</td>
                <td>:</td>
                <td><?php echo $user['image']; ?></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td><?php echo $user['role']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><a href="<?php echo base_url('Admin'); ?>" type="button" class="btn btn-outline-primary">Kembali</a> </td>
            </tr>

        </tbody>
    </table>
</div>
<nav aria-label="Page navigation">
    <?php echo $this->pagination->create_links(); ?>
</nav>