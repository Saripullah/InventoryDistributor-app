<?= $this->session->flashdata('pesan'); ?>
<style>
	.warning {
		background-color: #f2dede;
		padding: 10px;
		border: 1px solid #ebccd1;
		color: #a94442;
		margin-bottom: 20px;
	}

	.warning strong {
		color: #a94442;
	}

	.warning ul {
		margin: 0;
		padding: 0;
	}

	.warning li {
		margin-left: 30px;
		padding: 0;
		/* list-style: none; */
	}
</style>
<div class="card shadow-sm border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Data Barang
				</h4>
				<?php if (!empty($cekbarang)) { ?>
					<div class="warning">
						<strong>Perhatian Segera Lakukan Order!</strong><br> Ada barang yang sudah kritis!
						<ul>
							<?php foreach ($cekbarang as $data) { ?>
								<li>Nama barang: <b><?php echo $data->nama_barang; ?> </b> - Jumlah stok
									<b><?php echo $data->stok; ?></b>
								</li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>
			</div>
			<div class="col-auto">
				<a href="<?= base_url('barang/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span class="text">
						Tambah Barang
					</span>
				</a>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<table id="dataTable" class="table table-striped w-100 dt-responsive nowrap">
			<thead>
				<tr>
					<th style="display: none;">No. </th>
					<th>No. </th>
					<th>ID Barang</th>
					<th>Nama Barang</th>
					<th>Jenis Barang</th>
					<th>Harga</th>
					<th>Stok</th>
					<th>Kadaluarsa</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$no2 = 1;
				if ($barangHasStoks) :
					$previousIdBarang = null;
					foreach ($barangHasStoks as $barangHasStok) :
				?>
						<tr>
							<td style="display: none;"><?= $no++; ?></td>
							<td>
								<?php if ($barangHasStok['id_barang'] != $previousIdBarang) { ?>
									<?= $no2++; ?>
								<?php } ?>
							</td>
							<td>
								<?php if ($barangHasStok['id_barang'] != $previousIdBarang) { ?>
									<?= $barangHasStok['id_barang']; ?>
								<?php } ?>
							</td>
							<td>
								<?php if ($barangHasStok['id_barang'] != $previousIdBarang) { ?>
									<?= $barangHasStok['nama_barang']; ?>
								<?php } ?>
							</td>
							<td><?= $barangHasStok['nama_jenis']; ?></td>
							<td><?= $barangHasStok['harga']; ?></td>
							<td><?= $barangHasStok['stok'] . ' ' . $barangHasStok['nama_satuan']; ?></td>
							<?php if ($barangHasStok['expired'] == '0000-00-00') : ?>
								<td> - </td>
							<?php else : ?>
								<td><?= $barangHasStok['expired']; ?></td>
							<?php endif; ?>
							<td>
								<!-- <a href="<?= base_url('barang/edit/') . $barangHasStok['id_barang'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a> -->
								<a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('barang/delete/') . $barangHasStok['id_barang'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<?php
						$previousIdBarang = $barangHasStok['id_barang'];
						?>
					<?php endforeach; ?>
				<?php else : ?>
					<tr>
						<td colspan="7" class="text-center">
							Data Kosong
						</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>