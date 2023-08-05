<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card shadow-sm border-bottom-primary">
			<div class="card-header bg-white py-3">
				<div class="row">
					<div class="col">
						<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
							Form Edit Customer
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
				<?= form_open('', [], ['id' => $customer['id']]); ?>
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="nama_customer">Nama Customer</label>
					<div class="col-md-9">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
							</div>
							<input value="<?= set_value('nama', $customer['nama']); ?>" name="nama" id="nama"
								type="text" class="form-control" placeholder="Nama Customer...">
						</div>
						<?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="nama_customer">Alamat Customer</label>
					<div class="col-md-9">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
							</div>
							<input value="<?= set_value('alamat', $customer['alamat']); ?>" name="alamat" id="alamat"
								type="text" class="form-control" placeholder="Alamat Customer...">
						</div>
						<?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-9 offset-md-3">
						<button type="submit" class="btn btn-primary">Update</button>
						<button type="reset" class="btn btn-secondary">Reset</button>
					</div>
				</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
