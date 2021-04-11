<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Karyawan</h2>
		<div class="col-md-3">
			<?= form_open(base_url('karyawan/index')) ?>
      <div class="form-group">
			<input placeholder="keyword ...." value="<?= !empty($keyword) ? $keyword : ''; ?>" name="keyword" type="text" class="form-control">
			<input type="submit" class="btn btn-default" value="Cari" style="display: none;">
      </div>
      <?= form_close(); ?>

		</div>
    <div class="col-md-9 text-right">
			<a href="<?= base_url('karyawan/create_karyawan'); ?>" class="btn btn-primary" >Create Karyawan</a><br>
    </div>

			<table class="table table-bordered table-hover">
				<tr>
					<th>Nik</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Divisi</th>
					<th>Jabatan</th>
					<th>Aksi</th>
				</tr>
				<tbody>
					<?php 
					if (!empty($data)): ?>
						<?php foreach ($data as $key => $value): ?>
							<tr>
								<td><?= $value['nik']; ?></td>
								<td><?= $value['name']; ?></td>
								<td><?= $value['phone']; ?></td>
								<td><?= $value['email']; ?></td>
								<td><?= $value['divisi']['name']; ?></td>
								<td><?= $value['jabatan']['name']; ?></td>
								<td><button type="button" class="btn btn-primary" onclick="detail('<?= $value['karyawan_id']; ?>' )"> Detail </button></td>
							</tr>
						<?php endforeach ?>
					<?php endif ?>
				</tbody>
			</table>
		</div>
	</div><!-- .row -->
</div><!-- .container -->


<!-- Modal -->
<div class="modal fade" id="modalKaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
        
      </div>
      <div class="modal-body">
        Name : <b id="name"></b><br>
        Nik : <b id="nik"></b><br>
        No BPJS : <b id="no_bpjs"></b><br>
        No Ketenagakerjaan : <b id="no_ketenagakerjaan"></b><br>
        Pendidikan : <b id="pendidikan"></b><br>
        Phone : <b id="phone"></b><br>
        Status Karyawan : <b id="status_karyawan"></b><br>
        Status Pernikahan : <b id="status_pernikahan"></b><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
	
function detail(id){
	$.ajax({
        type: "POST",
        url: "<?php echo site_url('karyawan/detail/'); ?>" ,
        data: {"id" : id },
        cache: false,
        async: false,
        success: function (res) {
          let data = JSON.parse(res) 
          console.log(data)
          if (data.msg == 'SUCCESS') {
          	$("#name").text(data.name)
          	$("#nik").text(data.nik)
          	$("#no_bpjs").text(data.no_bpjs_kesehatan)
          	$("#no_ketenagakerjaan").text(data.no_bpjs_ketenagakerjaan)
          	$("#pendidikan").text(data.pendidikan)
          	$("#phone").text(data.phone)
          	$("#status_karyawan").text(data.status_karyawan)
          	$("#status_pernikahan").text(data.status_pernikahan)
          	$('#modalKaryawan').modal('toggle');
          }else{
          	$("#name").text('')
          	$("#nik").text('')
          	$("#no_bpjs").text('')
          	$("#no_ketenagakerjaan").text('')
          	$("#pendidikan").text('')
          	$("#phone").text('')
          	$("#status_karyawan").text('')
          	$("#status_pernikahan").text('')
          }
        },
        error: function (res) {

        },
     });
}
        
</script>