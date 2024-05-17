<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/css/gijgo.min.css') ?>" rel="stylesheet" type="text/css">

<form action="<?php echo base_url('SuratMasuk/store'); ?>" method="post" enctype="multipart/form-data">
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td style="width:20%">Nomor Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo htmlentities($suratmasuk['no_surat'], ENT_QUOTES); ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Nomor Agenda</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo htmlentities($suratmasuk['no_agenda'], ENT_QUOTES); ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Asal Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo htmlentities($suratmasuk['asal_surat'], ENT_QUOTES); ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tanggal Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?= date('d-m-Y', strtotime($suratmasuk['tanggal_surat'])) ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width:20%">Tanggal Diterima</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?= date('d-m-Y', strtotime($suratmasuk['tanggal_diterima'])) ?></span>
                    </td>
                </tr>


                <tr>
                    <td style="width:20%">Jenis Surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?= $suratmasuk['nama_jenissurat']; ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Perihal</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo htmlentities($suratmasuk['perihal'], ENT_QUOTES); ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Lampiran</td>
                    <td style="width:5%">:</td>
                    <td>
                        <span><?php echo htmlentities($suratmasuk['lampiran'], ENT_QUOTES); ?></span>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">File surat</td>
                    <td style="width:5%">:</td>
                    <td>
                        <?php if (!$suratmasuk['file'] == '') : ?>
                            <?php $random = rand(10, 100); ?>
                            <a href="<?= base_url() . '/uploads/masuk/' . $suratmasuk['file'] . '?t=' . $random; ?>" target="_blank" rel="noopener noreferrer">Lihat File</a>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%">Tahanan</td>
                    <td style="width:5%">:</td>
                    <td>
                        <?php foreach ($tahanans as $key => $data) : ?>
                            <a href="<?= base_url() . '/Tahanan/show/' . $data->id_tahanan; ?>" target="_blank" rel="noopener noreferrer"><?= $key + 1 . '. ' . $data->nama_tahanan ?></a><br />
                        <?php endforeach; ?>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url('SuratMasuk'); ?>" type="button" class="btn btn-outline-secondary">KEMBALI</a>
                    </td>
                </tr>

            </tbody>
        </table>


        <h5>Status Disposisi</h5>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam</th>
                        <th scope="col">User</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Dibaca</th>
                        <th scope="col">Ditolak</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Tujuan</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($disposisis as $key => $data) : ?>
                        <tr>
                            <td style="width:5%"><?= $key + 1 ?></td>
                            <td style="width:8%"><?= date('d-m-Y', strtotime($data['tanggal_disposisi'])) ?></td>
                            <td style="width:8%"><?= date('H:i:s', strtotime($data['created'])) ?></td>
                            <td style="width:10%"><?= $data['username'] ?></td>
                            <td style="width:10%"><?= $data['role'] ?></td>
                            <td style="width:10%"><?php if ($data['dibaca'] == '1') {
                                                        echo 'SUDAH';
                                                    } else {
                                                        echo 'BELUM';
                                                    } ?></td>
                            <td style="width:10%"><?php if ($data['tolak'] == '1') {
                                                        echo 'DITOLAK';
                                                    } else {
                                                        echo 'DITERIMA';
                                                    } ?></td>
                            <td style="width:10%"><?= $data['catatan'] ?></td>
                            <td style="width:10%"><?php
                                                    foreach ($roles as $datarole) {
                                                        if ($data['target_role_id'] == $datarole['id']) {
                                                            echo $datarole['role'];
                                                        }
                                                    }
                                                    ?></td>
                            <td style="width:10%"><?php if ($data['status'] == '0') {
                                                        echo 'PROSES';
                                                    } else {
                                                        echo 'SELESAI';
                                                    } ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</form>