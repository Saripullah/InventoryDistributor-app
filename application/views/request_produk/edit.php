<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card shadow-sm border-bottom-primary">
			<div class="card-header bg-white py-3">
				<div class="row">
					<div class="col">
						<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
							Form Edit Request Produk
						</h4>
					</div>
					<div class="col-auto">
						<?php if (is_admin()) : ?>
						<a href="<?= base_url('requestbarang/index_gudang') ?>"
							class="btn btn-sm btn-secondary btn-icon-split">
							<span class="icon">
								<i class="fa fa-arrow-left"></i>
							</span>
							<span class="text">
								Kembali
							</span>
						</a>
						<?php else : ?>
						<a href="<?= base_url('requestbarang/index_gudang') ?>"
							class="btn btn-sm btn-secondary btn-icon-split">
							<span class="icon">
								<i class="fa fa-arrow-left"></i>
							</span>
							<span class="text">
								Kembali
							</span>
						</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="card-body">
				<?= form_open('requestbarang/update'); ?>
				<?= form_hidden('<?= $this->security->get_csrf_token_name(); ?>', $this->security->get_csrf_hash()); ?>
				<input type="hidden" name="id" value="<?= $datas[0]->id ?>">
				<input type="hidden" name="user_id" value="<?= $datas[0]->user_id ?>">
				<input type="hidden" name="isPermit" value="<?= $datas[0]->isPermit ?>">

				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="nama_supplier">Pilih Supplier</label>
					<div class="col-md-9">
						<div class="input-group">
							<div class="input-group-prepend">
								<!-- <span class="input-group-text" id="basic-addon1"><i
											class="fa fa-fw fa-user"></i></span> -->
							</div>
							<select class="form-control single-select" id="supplier_id" name="supplier_id">
								<option value="">-- Pilih --</option>
								<!-- Buat pilihan dropdown berasal dari database -->
								<?php foreach($supplier as $s): ?>
								<option value="<?= $s['id_supplier'] ?>"
									<?= ($s['id_supplier'] == $datas[0]->supplier_id) ? 'selected' : '' ?>>
									<?= $s['nama_supplier'] ?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="nama_supplier">Pilih Barang</label>
					<div class="col-md-9">
						<div class="input-group">
							<div class="input-group-prepend">
							</div>
							<select class="form-control single-select" id="barang_id" name="barang_id">
								<option value="">-- Pilih --</option>
								<!-- Buat pilihan dropdown berasal dari database -->
								<?php foreach($barang as $b): ?>
								<option value="<?php echo $b['id_barang']; ?>"
									<?= ($b['id_barang'] == $datas[0]->barang_id) ? 'selected' : '' ?>>
									<?php echo $b['nama_barang']; ?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="nama_supplier">Masukkan Stok</label>
					<div class="col-md-9">
						<div class="input-group">
							<div class="input-group-prepend">
								<!-- <span class="input-group-text" id="basic-addon1"><i
											class="fa fa-fw fa-user"></i></span> -->
							</div>
							<input type="number" name="total" id="total" value="<?= $datas[0]->total ?>">
						</div>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-right" for="nama_supplier">Pilih Satuan</label>
					<div class="col-md-9">
						<div class="input-group">
							<div class="input-group-prepend">
								<!-- <span class="input-group-text" id="basic-addon1"><i
											class="fa fa-fw fa-user"></i></span> -->
							</div>
							<select class="form-control single-select" id="satuan_id" name="satuan_id">
								<option value="">-- Pilih --</option>
								<!-- Buat pilihan dropdown berasal dari database -->
								<?php foreach($satuan as $n): ?>
								<option value="<?php echo $n['id_satuan']; ?>"
									<?= ($n['id_satuan'] == $datas[0]->satuan_id) ? 'selected' : '' ?>>
									<?php echo $n['nama_satuan']; ?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-9 offset-md-3">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn btn-secondary">Reset</button>
					</div>
				</div>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
