<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		
		
		
			<div class="col-lg-12">
				<div class="panel panel-default">
                 <div class="panel-heading">INPUT DATA INSTANSI</div>
            <div class="panel-body">
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table'>        

	    <tr><td width='200'>Nama Instansi <?php echo form_error('nama_instansi') ?></td><td><input type="text" class="form-control" name="nama_instansi" id="nama_instansi" placeholder="Nama Instansi" value="<?php echo $nama_instansi; ?>" /></td></tr>
		
		<tr><td width='200'>Urusan Pemerintahan <?php echo form_error('urusan_pemerintahan') ?></td><td><input type="text" class="form-control" name="urusan_pemerintahan" id="urusan_pemerintahan" placeholder="Urusan Pemerintahan" value="<?php echo $urusan_pemerintahan; ?>" /></td></tr>
		
		<tr><td width='200'>Organisasi<?php echo form_error('organisasi') ?></td><td><input type="text" class="form-control" name="organisasi" id="organisasi" placeholder="Organisasi" value="<?php echo $organisasi; ?>" /></td></tr>
		
		<tr><td width='200'>Sub Unit Organisasi<?php echo form_error('sub_unit_organisasi') ?></td><td><input type="text" class="form-control" name="sub_unit_organisasi" id="sub_unit_organisasi" placeholder="Sub Unit Organisasi" value="<?php echo $sub_unit_organisasi; ?>" /></td></tr>
	    
		<tr><td width='200'>Pejabat Mengetahui <?php echo form_error('pejabat_mengetahui') ?></td><td><input type="text" class="form-control" name="pejabat_mengetahui" id="pejabat_mengetahui" placeholder="Pejabat Mengetahui" value="<?php echo $pejabat_mengetahui; ?>" /></td></tr>
	    <tr><td width='200'>Nama Pejabat <?php echo form_error('nama_pejabat') ?></td><td><input type="text" class="form-control" name="nama_pejabat" id="nama_pejabat" placeholder="Nama Pejabat" value="<?php echo $nama_pejabat; ?>" /></td></tr>
	    <tr><td width='200'>Penanggung Jawab <?php echo form_error('penanggung_jawab') ?></td><td><input type="text" class="form-control" name="penanggung_jawab" id="penanggung_jawab" placeholder="Penanggung Jawab" value="<?php echo $penanggung_jawab; ?>" /></td></tr>
	   
	    <tr><td></td><td><input type="hidden" name="id_instansi" value="<?php echo $id_instansi; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('instansi') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>