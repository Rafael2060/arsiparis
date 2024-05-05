<div class="table-responsive">
    <table class="table table-striped">

        <tbody>
            <tr>
                <td style="width:20%">Nama Tahanan</td>
                <td style="width:5%">:</td>
                <td>
                    <span><?php echo htmlentities($tahanan['nama_tahanan'], ENT_QUOTES); ?></span>
                </td>
            </tr>
            <tr>
                <td style="width:20%">KTP</td>
                <td style="width:5%">:</td>
                <td>
                    <span><?php echo htmlentities($tahanan['ktp'], ENT_QUOTES); ?></span>
                </td>
            </tr>
            <tr>
                <td style="width:20%">Jenis Kelamin</td>
                <td style="width:5%">:</td>
                <td>
                    <?php
                    if ($tahanan['jk'] == 'L') {
                        $jk = 'Laki-Laki';
                    } else {
                        $jk = 'Perempuan';
                    } ?>
                    <span><?php echo $jk; ?></span>
                </td>
            </tr>
            <tr>
                <td style="width:20%">Tanggal Lahir</td>
                <td style="width:5%">:</td>
                <td>
                    <span><?php echo date("d-m-Y", strtotime($tahanan['tanggal_lahir'])); ?></span>
                </td>
            </tr>
            <tr>
                <td style="width:20%">Tanggal Masuk</td>
                <td style="width:5%">:</td>
                <td>
                    <span><?php echo date("d-m-Y", strtotime($tahanan['tanggal_masuk'])); ?></span>
                </td>
            </tr>
            <tr>
                <td style="width:20%">Kategori</td>
                <td style="width:5%">:</td>
                <td>
                    <span><?php echo htmlentities($tahanan['nama_kategori'], ENT_QUOTES); ?></span>
                </td>
            </tr>
            <tr>
                <td style="width:20%">Alamat</td>
                <td style="width:5%">:</td>
                <td>
                    <span><?php echo htmlentities($tahanan['alamat'], ENT_QUOTES); ?></span>
                </td>
            </tr>
            <tr>
                <td style="width:20%">Umur</td>
                <td style="width:5%">:</td>
                <td>
                    <span><?php echo htmlentities($tahanan['umur'], ENT_QUOTES); ?></span>
                </td>
            </tr>
            <tr>
                <td style="width:20%">Pekerjaan</td>
                <td style="width:5%">:</td>
                <td>
                    <span><?php echo htmlentities($tahanan['nama_pekerjaan'], ENT_QUOTES); ?></span>
                </td>
            </tr>
            <tr>
                <td style="width:20%">Agama</td>
                <td style="width:5%">:</td>
                <td>
                    <span><?php echo htmlentities($tahanan['nama_agama'], ENT_QUOTES); ?></span>
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>
                    <a href="<?php echo base_url('Tahanan'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>

                </td>
            </tr>

        </tbody>

    </table>
</div>
<nav aria-label="Page navigation">
    <?php echo $this->pagination->create_links(); ?>
</nav>