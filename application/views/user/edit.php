<div class="table-responsive">
    <table class="table table-striped">
        <form action="<?php echo base_url('User/update'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?php echo $user['id']; ?>">
            <tbody>
                <tr>
                    <td style="width:10%">Nama</td>
                    <td style="width:5%">:</td>
                    <td>
                        <input class="form-control" type="text" name="name" id="name" value="<?php echo htmlentities($user['name'], ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('name'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><?php echo htmlentities($user['username'], ENT_QUOTES); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td> <input class=" form-control" type="email" name="email" id="email" value="<?php echo htmlentities($user['email'], ENT_QUOTES); ?>">
                        <small class="text-danger"> <?php echo form_error('email'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td>:</td>
                    <td>
                        <?php echo $user['image']; ?>
                        <img style="width: 100px;height:auto;" src="<?php echo base_url('assets/img/') . $user['image'] ?>" alt="">
                        <input type="file" name="user_file" id="user_file" size="20" />
                        <small class="text-danger"> <?php echo form_error('user_file'); ?></small>
                    </td>
                </tr>

                <?php if ($this->session->userdata('role_id') == '1') : ?>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>
                            <select class="form-control" name="role" id="role">
                                <?php foreach ($role as $data) : ?>
                                    <option value="<?php echo $data['id']; ?>" <?php
                                                                                if ($user['role_id'] == $data['id']) {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo $data['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                <?php else : ?>
                    <input type="hidden" name="role" value="<?php echo $user['role_id']; ?>">
                <?php endif; ?>

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