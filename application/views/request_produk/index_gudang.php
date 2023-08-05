<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Request Barang
				</h4>
			</div>
			<div class="col-auto">
				<a href="<?= base_url('requestbarang/alldatas'); ?>" class="btn btn-sm btn-primary btn-icon-split">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span class="text">
						Tambah Request
					</span>
				</a>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<?php if ($this->session->flashdata('message')) : ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<?= $this->session->flashdata('message'); ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php endif; ?>
		<table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama</th>
					<th>Supplier</th>
					<th>Barang</th>
					<th>Jumlah</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($datas) :
					$no = 1;
					foreach ($datas as $s) :
				?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $s->nama; ?></td>
					<td><?= $s->nama_supplier; ?></td>
					<td><?= $s->nama_barang; ?></td>
					<td><?= $s->total; ?> <?= $s->nama_satuan; ?></td>
					<td><?php
								$dateString = $s->tanggal;
								$timestamp = strtotime($dateString);
								$formattedDate = date('d-m-Y H:i:s', $timestamp);
								echo $formattedDate;
								?></td>
					<td style="
   <?php
						if ($s->isPermit == '1' || $s->isPermit == '0') {
							echo 'background-color: red; color: white;';
						} else if ($s->isPermit == '2') {
							echo 'background-color: yellow; color: black;';
						} else if ($s->isPermit == '3' || $s->isPermit == '4') {
							echo 'background-color: orange; color: black;';
						} else if ($s->isPermit == '5') {
							echo 'background-color: green; color: white;';
						} else if ($s->isPermit == '6') {
							echo 'background-color: gray; color: white;';
						}
	?>
">
						<?php
								if ($s->isPermit == '1') {
									echo 'Menunggu konfirmasi';
								} else if ($s->isPermit == '2') {
									echo 'Dikonfirmasi';
								} else if ($s->isPermit == '3') {
									echo 'Menunggu Dikirim';
								} else if ($s->isPermit == '4') {
									echo 'Dalam Pengiriman';
								} else if ($s->isPermit == '5') {
									echo 'Telah Diterima';
								} else if ($s->isPermit == '6') {
									echo 'Stok Habis';
								} else if ($s->isPermit == '0') {
									echo 'Belum Disetujui';
								}
								?>
					</td>

					<th>
						<a href="<?= base_url('requestbarang/show/') . $s->id ?>"
							class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Yakin ingin hapus?')"
							href="<?= base_url('requestbarang/delete/') . $s->id ?>"
							class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
					</th>
				</tr>
				<?php endforeach; ?>
				<?php else : ?>
				<tr>
					<td colspan="6" class="text-center">
						Data Kosong
					</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
