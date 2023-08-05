<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data Customer
				</h4>
			</div>


			<div class="col-auto">
				<a href="<?= base_url('customer/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span class="text">
						Tambah Customer
					</span>
				</a>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-striped w-100 dt-responsive nowrap" id="dataTable" name="tableCustomerMasuk">
			<thead>
				<tr>
					<th style="display: none;">No. </th>
					<th>No. </th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Hapus</th>
				</tr>
			</thead>
			<tbody>
				<?php
                $no = 1;
                if ($customer) :
                    $previousIdCustomer= null;
                    foreach ($customer as $bm) :
                ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $bm['nama']; ?></td>
					<td><?= $bm['alamat']; ?></td>
					<td>
						<a href="<?= base_url('customer/edit/') . $bm['id'] ?>"
							class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Yakin ingin hapus?')"
							href="<?= base_url('customer/delete/') . $bm['id'] ?>"
							class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php
                        $previousIdCustomer = $bm['id'];
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
