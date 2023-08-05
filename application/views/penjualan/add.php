<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card shadow-sm border-bottom-primary">
			<div class="card-header bg-white py-3">
				<div class="row">
					<div class="col">
						<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
							Form Penjualan
						</h4>
					</div>
					<div class="col-auto">
						<a href="<?= base_url('penjualan') ?>" class="btn btn-sm btn-secondary btn-icon-split">
							<span class="icon">
								<i class="fa fa-arrow-left"></i>
							</span>
							<span class="text">
								Kembali
							</span>
						</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<?= $this->session->flashdata('pesan'); ?>
				<?= form_open('', []); ?>
				<input name="tgl" id="tgl" type="date" class="form-control" hidden>

				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="jenis_id">Pilih Barang</label>
					<div class="col-md-9">
						<div class="input-group">
							<select name="id_barang" id="id_barang" class="custom-select">
								<option value="" selected disabled>Pilih Barang</option>
								<?php foreach ($barang as $j) : ?>
									<option <?= set_select('id_barang', $j['id_barang']) ?> value="<?= $j['id_barang'] ?>">
										<?= $j['id_barang'] ?> - <?= $j['nama_barang'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<?= form_error('jenis_id', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="detail-barang"></div>
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="jml">Jumlah</label>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-2">
								<button type="button" class="btn btn-primary btn-quantity" data-ket="plus" disabled>+</button>
							</div>
							<div class="col-md-8">
								<input name="jml" id="jml" type="number" value="0" class="form-control text-center" readonly onchange="calculateTotal()">
							</div>
							<div class="col-md-2">
								<button type="button" class="btn btn-danger btn-quantity" data-ket="minus" disabled>-</button>
							</div>
							<?= form_error('jml', '<small class="text-danger">', '</small>'); ?>
						</div>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="nama_barang">Satuan</label>
					<div class="col-md-9">
						<input name="satuan" id="satuan" class="form-control"readonly>
						<?= form_error('satuan', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="nama_barang">Harga</label>
					<div class="col-md-9">
						<input name="harga" id="harga" type="number" class="form-control"readonly>
						<?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="nama_barang">Total</label>
					<div class="col-md-9">
						<input value="<?= set_value('total'); ?>" name="total" id="total" type="number" class="form-control"readonly>
						<?= form_error('total', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>

				<input type="hidden" id="param_stok" />
				<input type="hidden" id="id_satuan" name="id_satuan" />

				<div class="row form-group">
					<div class="col-md-9 offset-md-3">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn btn-secondary">Reset</bu>
					</div>
				</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		// Mendapatkan elemen input tanggal
		var inputTgl = document.getElementById("tgl");

		// Mendapatkan tanggal hari ini
		var today = new Date();

		// Mendapatkan nilai tahun, bulan, dan tanggal
		var year = today.getFullYear();
		var month = ("0" + (today.getMonth() + 1)).slice(-2); // ditambahkan +1 karena indeks bulan dimulai dari 0
		var day = ("0" + today.getDate()).slice(-2);

		// Mengatur format nilai default menjadi yyyy-mm-dd
		var defaultValue = year + "-" + month + "-" + day;

		// Mengatur nilai default menjadi tanggal hari ini
		inputTgl.value = defaultValue;

		function calculateTotal(quantity) {
			const jml = parseFloat(quantity);
			const harga = parseFloat($('#harga').val());
			const total = isNaN(jml) || isNaN(harga) ? 0 : jml * harga;

			$('#total').val(total)
		}


		$('.btn-quantity').click(function(){
			var ket = $(this).attr('data-ket')
			var quantity = parseInt($('#jml').val())
			var stock = parseInt($('#param_stok').val())

			if(ket == 'plus') {
				if(quantity < stock) {
					$('#jml').val(quantity + 1)
					calculateTotal(quantity + 1)
				}
			} else {
				if(quantity > 1) {
					$('#jml').val(quantity - 1)
					calculateTotal(quantity - 1)
				}
			}
		})
	})

	
</script>