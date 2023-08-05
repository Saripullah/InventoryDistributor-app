<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Riwayat Data Barang Masuk
                </h4>
            </div>


            <div class="col-auto">
                <a href="<?= base_url('barangmasuk/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Barang Masuk
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable" name="tableBarangMasuk">
            <thead>
                <tr>
                    <th style="display: none;">No. </th>
                    <th>No. </th>
                    <th>No Transaksi</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Masuk</th>
                    <th>Supplier</th>
                    <th>Harga</th>
                    <th>Jumlah Masuk</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>User</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $no2 = 1;
                if ($barangmasuk) :
                    $previousIdBarang = null;
                    foreach ($barangmasuk as $bm) :
                ?>
                        <tr>
                            <td style="display: none;"><?= $no++; ?></td>
                            <td>   <?= $no2++; ?>  </td>
                            <td><?= $bm['id_barang_masuk']; ?></td>
                            <td><?= $bm['nama_barang']; ?></td>
                            <td><?= $bm['tanggal_masuk']; ?></td>
                            <td><?= $bm['nama_supplier']; ?></td>
                            <td><?= $bm['harga']; ?></td>
                            <td><?= $bm['jumlah_masuk'] . ' ' . $bm['nama_satuan']; ?></td>
                            <td><?= $bm['expired']; ?></td>
                            <td><?= $bm['nama']; ?></td>
                            <td>
                                <?php if ($bm['is_input'] == '0') { ?>
                                <!-- <button class="btn btn-secondary btn-circle btn-sm"
                                    data-target="#inputBrgNew"
                                    data-toggle="modal"
                                >
                                    <i class="fa fa-cog"></i>
                                </button> -->
                                <a href="<?= base_url('barangmasuk/add/') . $bm['id_barang_masuk'] ?>" class="btn btn-secondary btn-circle btn-sm"><i class="fa fa-cog"></i></a>
                                <?php } ?>

                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('barangmasuk/delete/') . $bm['id_barang_masuk'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                        $previousIdBarang = $bm['barang_id'];
                        ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="inputBrgNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> -->