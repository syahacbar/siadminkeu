<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		
		
		
			<div class="col-lg-12">
				<div class="panel panel-default">
                 <div class="panel-heading">INPUT DATA PENDAPATAN</div>
            <div class="panel-body">
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table'> 

	   <tr><td width='200'>Pilih Instansi <?php echo form_error('id_instansi') ?></td>
		 <td>
		 <select class="form-control select2" name="id_instansi" id="id_instansi">
				<option>-Pilih Instansi-</option>
				<?php
				 foreach ($instansi as $r)
					{
				?>
				<option value="<?=$r->id_instansi?>" <?php if ($r->id_instansi == $id_instansi) echo 'selected'; ?> ><?=$r->nama_instansi." - ".$r->urusan_pemerintahan." - ".$r->organisasi." - ".$r->sub_unit_organisasi?></option>
					<?php } ?>
				
			  </select>
		 
		 </td></tr>
		 <tr><td width='200'>Tahun <?php echo form_error('tahun') ?></td><td><input type="text" class="form-control calendar" readonly name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" /></td></tr>
		  
	    <tr><td width='200'>Pilih Kegiatan <?php echo form_error('kode_kegiatan') ?></td><td>
		<select class="form-control select2" name="kode_kegiatan" id="kode_kegiatan">
				<option>-Pilih Kegiatan-</option>
				<?php
				 foreach ($kegiatan as $r)
					{
				?>
				<option value="<?=$r->kode_kegiatan?>" <?php if ($r->kode_kegiatan == $kode_kegiatan) echo 'selected'; ?> ><?=$r->kode_kegiatan." - ".$r->uraian_kegiatan ?></option>
					<?php } ?>
				
			  </select>
		
		</td></tr> 
	    <tr><td width='200'>Sumber Dana <?php echo form_error('sumber_dana') ?></td><td><input type="text" class="form-control" name="sumber_dana" id="sumber_dana" placeholder="Sumber Dana" value="<?php echo $sumber_dana; ?>" /></td></tr>
	    <tr><td width='200'>Triwulan 1 <?php echo form_error('triwulan_1') ?></td><td><input type="text" class="form-control" name="triwulan_1" id="triwulan_1" placeholder="Triwulan 1" value="<?php echo $triwulan_1; ?>" /></td></tr>
	    <tr><td width='200'>Triwulan 2 <?php echo form_error('triwulan_2') ?></td><td><input type="text" class="form-control" name="triwulan_2" id="triwulan_2" placeholder="Triwulan 2" value="<?php echo $triwulan_2; ?>" /></td></tr>
	    <tr><td width='200'>Triwulan 3 <?php echo form_error('triwulan_3') ?></td><td><input type="text" class="form-control" name="triwulan_3" id="triwulan_3" placeholder="Triwulan 3" value="<?php echo $triwulan_3; ?>" /></td></tr>
	    <tr><td width='200'>Triwulan 4 <?php echo form_error('triwulan_4') ?></td><td><input type="text" class="form-control" name="triwulan_4" id="triwulan_4" placeholder="Triwulan 4" value="<?php echo $triwulan_4; ?>" /></td></tr>
	    
	   
	    <tr><td></td><td><input type="hidden" name="id_pendapatan" value="<?php echo $id_pendapatan; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('pendapatan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>