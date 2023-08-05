<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
					Riwayat Barang Keluar
				</h4>
				<?php if ($filter !=null) {
                    echo $filter ;
                } else {}?>
			</div>
			<div class="col-auto">
				<form class="form-inline" action="<?= base_url('barangkeluar/filterSold') ?>" method="POST">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
						value="<?php echo $this->security->get_csrf_hash();?>">
					<div class="form-group">
						<label for="filter">Filter: </label>
						<select class="form-control" id="filter" name="filter">
							<option value="" selected>Pilih Filter</option>
							<option value="ttlSold">Terlaris</option>
							<option value="date">Tanggal</option>
						</select>
					</div>
					<div id="inputTanggal" style="display:none" class="col-auto">
						<div class="form-group">
							<label for="tanggalMulai">Tanggal Mulai</label>
							<input type="date" class="form-control" id="tanggalMulai" name="date1">
						</div>
						<div class="form-group">
							<label for="tanggalSelesai">Tanggal Selesai</label>
							<input type="date" class="form-control" id="tanggalSelesai" name="date2">
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<div class="col-auto">
				<a href="<?= base_url('barangkeluar/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span class="text">
						Input Barang Keluar
					</span>
				</a>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
			<thead>
				<tr>
					<th>No. </th>
					<th>No Transaksi</th>
					<th>Nama Barang</th>
					<th>Tanggal Keluar</th>
					<th>Keterlambatan Input</th>
					<th>Jumlah Keluar</th>
					<th>User</th>
					<th>Hapus</th>
				</tr>
			</thead>
			<tbody>
				<?php
                $no = 1;
                if (!strpos($filter,'terlaris')) :
                    foreach ($barangkeluar as $bk) :
                        ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $bk['id_barang_keluar']; ?></td>
					<td><?= $bk['nama_barang']; ?></td>
					<td><?= $bk['tanggal_keluar']; ?></td>
					<td><?= $bk['tanggal_sekarang']; ?></td>
					<td><?= $bk['jumlah_keluar'] .' '. $bk['nama_satuan']; ?></td>
					<td><?= $bk['nama']; ?></td>
					<td>
						<a onclick="return confirm('Yakin ingin hapus?')"
							href="<?= base_url('barangkeluar/delete/') . $bk['id_barang_keluar'] ?>"
							class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endforeach; ?>
				<?php elseif (strpos($filter,'terlaris')) :
                    foreach ($barangkeluar as $bk) :
                        ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $bk['id_barang_keluar']; ?></td>
					<td><?= $bk['tanggal_keluar']; ?></td>
					<td><?= $bk['tanggal_sekarang']; ?></td>
					<td><?= $bk['nama_barang']; ?></td>
					<td><?= $bk['total_sold'] . ' ' . $bk['nama_satuan']; ?></td>
					<td><?= $bk['nama']; ?></td>
					<td>
						<a onclick="return confirm('Yakin ingin hapus?')"
							href="<?= base_url('barangkeluar/delete/') . $bk['id_barang_keluar'] ?>"
							class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
	integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script>
	$(document).ready(function () {
		var dropdown = document.getElementById("filter");
		dropdown.onchange = function () {
			if (this.value === "date") {
				document.getElementById("inputTanggal").style.display = "flex";
			} else {
				document.getElementById("inputTanggal").style.display = "none";
			}
		}
	});

</script>
