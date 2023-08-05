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
					Data Penjualan
				</h4>
			</div>
			<div class="col-auto">
				<a href="<?= base_url('penjualan/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span class="text">
						Tambah Data
					</span>
				</a>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<form action="<?= base_url('penjualan/pdf') ?>" method="post" target="_blank">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
				value="<?= $this->security->get_csrf_hash(); ?>" />

			<table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Harga</th>
						<th>Total</th>
						<th>Tanggal</th>
						<th>Aksi</th>
						<th>Pilih</th> <!-- Kolom baru untuk pilihan -->
					</tr>
				</thead>
				<tbody>
					<?php
				$no = 1;
				$grandTotal = 0;
				if ($penjualan) :
					foreach ($penjualan as $b) :
				?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $b['id_barang']; ?></td>
						<td><?= $b['nama_barang']; ?></td>
						<td><?= number_format($b['jml'], 0, ',', '.'); ?> <?= $b['nama_satuan'] ?></td>
						<td><?= 'Rp ' . number_format($b['harga'], 0, ',', '.'); ?></td>
						<td class="total-cell"><?= 'Rp ' . number_format($b['total'], 0, ',', '.'); ?></td>
						<td><?= $b['tgl']; ?></td>
						<td>
							<a href="<?= base_url('penjualan/edit/') . $b['id'] ?>"
								class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
							<a onclick="return confirm('Yakin ingin hapus?')"
								href="<?= base_url('penjualan/delete/') . $b['id'] ?>"
								class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
						</td>
						<td>
							<input type="checkbox" name="selectRow[<?= $b['id']; ?>]" onclick="calculateSelectedTotal()"
								data-total="<?= $b['total']; ?>" id="selectRow">
						</td>
					</tr>
					<?php
						$grandTotal += $b['total'];
					endforeach;
					?>
					<?php else : ?>
					<tr>
						<td colspan="8" class="text-center">
							Data Kosong
						</td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<hr>
			<input type="hidden" name="penjualan" value="<?= htmlspecialchars(json_encode($penjualan)); ?>">
			<input type="hidden" name="grandTotal" value="<?= $grandTotal; ?>">
			<div class="col align-items-center">
				<div class="row-md-12">
					<p id="selectedTotal">Total Terpilih: 0</p>
				</div>
				
				<div class="row-md-12">
					<div class="form-group d-flex align-items-center">
						<label class="mr-2" for="id">Pilih Customer</label>
						<select name="customer" id="customer" class="custom-select" required>
							<option value="" selected disabled>--</option>
							<?php foreach ($customer as $cs) : ?>
							<option <?= set_select('id', $cs['id']) ?> value="<?= $cs['id'] ?>">
								<?= $cs['nama'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="row-md-12 text-right">
					<button name="cetakButton" id="cetakButton" class="btn btn-primary" type="submit">Cetak</button>
				</div>
			</div>
			<style>
				.row {
					display: flex;
					flex-wrap: wrap;
					margin-right: -15px;
					margin-left: -15px;
				}

				.row-md-12 {
					flex: 0 0 50%;
					max-width: 50%;
					padding-right: 15px;
					padding-left: 15px;
				}

				.form-group {
					margin-bottom: 0;
				}

				.custom-select {
					height: 40px;
					padding: 0 10px;
					border: 1px solid #ccc;
					border-radius: 4px;
					width: 100%;
					background-color: #fff;
					transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
				}

				.custom-select:focus {
					border-color: #80bdff;
					outline: 0;
					box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
				}

			</style>
		</form>
	</div>
</div>
<script>
	function formatRupiah(angka) {
		var bilangan = parseInt(angka);
		return 'Rp ' + bilangan.toLocaleString('id-ID');
	}

	function calculateSelectedTotal() {
		const checkboxes = document.querySelectorAll('input[id="selectRow"]:checked');
		let selectedTotal = 0;
		checkboxes.forEach((checkbox) => {
			const total = parseFloat(checkbox.dataset.total);
			if (!isNaN(total)) {
				selectedTotal += total;
			}
		});
		document.getElementById('selectedTotal').innerText = 'Total Terpilih: ' + formatRupiah(selectedTotal);
	}

</script>
