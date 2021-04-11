<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="col-md-12">
			<div class="page-header">
				<h1>Form Karyawan</h1>
			</div>
			<?= form_open(base_url('karyawan/save_karyawan')) ?>
				<div class="form-group">
					<label for="nik">Nik</label>
					<input type="text" class="form-control" id="nik" name="nik" placeholder="Your nik">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="text" class="form-control" id="password" name="password" placeholder="Your password">
				</div>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="Your name">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" id="email" name="email" placeholder="Your email">
				</div>
				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="text" class="form-control" id="phone" name="phone" placeholder="Your phone">
				</div>
				<div class="form-group">
					<label for="tgl_lahir">Tanggal Lahir</label>
					<input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
				</div>
				<div class="form-group">
					<label for="status_pernikahan">Status Pernikahan</label>
					<input type="text" class="form-control" id="status_pernikahan" name="status_pernikahan" placeholder="Your status_pernikahan">
				</div>
				<div class="form-group">
					<label for="pendidikan">Pendidikan</label>
					<input type="text" class="form-control" id="pendidikan" name="pendidikan" placeholder="Your pendidikan">
				</div>
				<div class="form-group">
					<label for="tgl_lahir">Mulai Bergabung</label>
					<input type="date" class="form-control" id="mulai_bergabung" name="mulai_bergabung">
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Your alamat">
				</div>
				<div class="form-group">
					<label for="status_karyawan">Status Karyawan</label>
					<input type="text" class="form-control" id="status_karyawan" name="status_karyawan" placeholder="Your status_karyawan">
				</div>
				<div class="form-group">
					<label for="divisi_id">Divisi</label>
					<?php echo form_dropdown('divisi_id', $divisi, '', 'class="select2 form-control"'); ?>
				</div>
				<div class="form-group">
					<label for="jabatan_id">Jabatan</label>
					<?php echo form_dropdown('jabatan_id', $jabatan, '', 'class="select2 form-control"'); ?>
				</div>
				<input type="hidden" name="author" value="<?= $this->session->userdata('user_id'); ?>">
				<input type="hidden" name="role_id" value="ec6a5f55-8fe6-4fcc-8879-6e610458c74e">
				
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Save">
				</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->