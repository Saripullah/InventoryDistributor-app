<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card shadow-sm border-bottom-primary">
			<div class="card-header bg-white py-3">
				<div class="row">
					<div class="col">
						<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
							Form Edit
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
				<?= form_open('', [], ['id' => $penjualan['id']]); ?>
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="jml">Tanggal</label>
					<div class="col-md-9">
						<input value="<?= set_value('tgl', $penjualan['tgl']); ?>" name="tgl" id="tgl" type="date"
							class="form-control" readonly>
						<?= form_error('tgl', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="id_barang">Pilih Barang</label>
					<div class="col-md-9">
						<div class="input-group">
							<select name="id_barang" id="id_barang" class="custom-select">
								<option value="" selected disabled>Pilih Barang</option>
								<?php foreach ($barang as $j) : ?>
								<option <?= $penjualan['id_barang'] == $j['id_barang'] ? 'selected' : ''; ?>
									<?= set_select('id_barang', $j['id_barang']) ?> value="<?= $j['id_barang'] ?>">
									<?= $j['id_barang'] ?> - <?= $j['nama_barang'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<?= form_error('id_barang', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="jml">Jumlah</label>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-2">
								<button type="button" class="btn btn-primary btn-quantity" data-ket="plus">+</button>
							</div>
							<div class="col-md-8">
								<input name="jml" id="jml" type="number" value="<?= set_value('jml', $penjualan['jml']); ?>" class="form-control text-center" readonly onchange="calculateTotal()">
							</div>
							<div class="col-md-2">
								<button type="button" class="btn btn-danger btn-quantity" data-ket="minus">-</button>
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
					<label class="col-md-3 text-md-right" for="total">Total</label>
					<div class="col-md-9">
						<input value="<?= set_value('total', $penjualan['total']); ?>" name="total" id="total"
							type="number" class="form-control" placeholder="Total Barang..." readonly>
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

		renderData()

		function renderData()
		{
			let url = '<?= base_url('barang/getdetailbarang/'); ?>' + '<?= $penjualan['id_barang'] ?>';
			$.getJSON(url, function(data) {
				$('#satuan').val(data.nama_satuan);
				$('#harga').val(data.harga);
				$('#param_stok').val(data.stok);
				$('#id_satuan').val(data.id_satuan);
				$('.btn-quantity').prop('disabled', false)
			})
		}

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
