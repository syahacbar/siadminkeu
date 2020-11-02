<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		
		
		
			<div class="col-lg-12">
				<div class="panel panel-default">
                 <div class="panel-heading">INPUT DATA KEGIATAN</div>
				   <div class="panel-body">
           
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table'>        

	    <tr><td width='200'>Kode Kegiatan <?php echo form_error('kode_kegiatan') ?></td><td><input type="text" readonly class="form-control" name="kode_kegiatan" id="kode_kegiatan" placeholder="Kode Kegiatan" value="<?php echo $kode_kegiatan; ?>" /></td></tr>
	    <tr><td width='200'>Uraian Kegiatan <?php echo form_error('uraian_kegiatan') ?></td><td><input type="text" class="form-control" name="uraian_kegiatan" id="uraian_kegiatan" placeholder="Uraian Kegiatan" value="<?php echo $uraian_kegiatan; ?>" /></td></tr>
		
	    <tr><td></td><td><input type="hidden" name="id_kegiatan" value="<?php echo $id_kegiatan; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('kegiatan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>