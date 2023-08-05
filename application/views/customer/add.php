<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card shadow-sm border-bottom-primary">
			<div class="card-header bg-white py-3">
				<div class="row">
					<div class="col">
						<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
							Form Tambah Customer
						</h4>
					</div>
					<div class="col-auto">
						<a href="<?= base_url('customer') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="id_barang">Nama Customer</label>
					<div class="col-md-9">
						<input name="nama" id="nama" type="text" class="form-control" placeholder="Nama Customer">
						<?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="nama_barang">Alamat</label>
					<div class="col-md-9">
						<input name="alamat" id="alamat" type="text" class="form-control" placeholder="Alamat Customer">
						<?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
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
