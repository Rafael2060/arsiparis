<div class="table-responsive">
    <table class="table table-striped">
        <form action="<?php echo base_url('User/store'); ?>" method="post" enctype="multipart/form-data">

            <tbody>
                <tr>
                    <td style="width:10%">Nama</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="name" id="name" value="<?php echo set_value('name'); ?>">
                        <small class="text-danger"> <?php echo form_error('name'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td>
                        <input class="form-control" type="text" name="username" id="username" value="<?php echo set_value('username'); ?>">
                        <small class="text-danger"> <?php echo form_error('username'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>
                        <input class="form-control" type="email" name="email" id="email" value="<?php echo set_value('email'); ?>">
                        <small class="text-danger"> <?php echo form_error('email'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>
                        <select class="form-control" name="role" id="role">
                            <?php foreach ($role as $data) : ?>
                                <option value="<?php echo $data['id']; ?>"><?php echo $data['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
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