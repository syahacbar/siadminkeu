<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		
		
		
			<div class="col-lg-12">
				<div class="panel panel-default">
                    <div class="panel-heading">KELOLA DATA RAP</div>
        
       <div class="panel-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('rap/create'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-success btn-sm"'); ?>
		
		<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel</button>
		
		<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cetak"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
		
		<!-- Modal -->
<div id="cetak" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cetak Laporan RAP</h4>
      </div>
	  <form  class="form" action="<?php echo site_url('rap/cetak'); ?>" method="post" target="_blank">
      <div class="modal-body">
        <h4>Pilih Instansi dan tahun terlebih dahulu!</h4>
		
					<div style="display:none" class="alert bg-danger" id="pesan" role="alert">
					<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg>
					Instansi harus dipilih!!	
					
					</div>
					
			  <div class="form-group row ">
			  <div class="col-lg-9">
			  <label for="id_instansi">Instansi:</label>
				<select required class="form-control select2 " style="width: 100%;" name="id_instansi" id="id_instansi">
				<option>-Pilih Instansi-</option>
				<?php
				 foreach ($instansi as $r)
					{
				?>
				<option value="<?=$r->id_instansi?>"  ><?=$r->nama_instansi." - ".$r->urusan_pemerintahan." - ".$r->organisasi." - ".$r->sub_unit_organisasi?></option>
					<?php } ?>
				
			  </select>
			  </div>
			 
			  <div class="col-lg-3">
			  <label for="tahun">Tahun:</label>
				<input type="text" style="width:100px" class="form-control calendar" readonly name="tahun" id="tahun" placeholder="Tahun" value="" />
			</div>
			</div>
			  
			   
			
      </div>
      <div class="modal-footer bg-primary">
			<button type="submit"  class="btn btn-warning"><i class="fa fa-check" aria-hidden="true"></i> Cetak</button>
			<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove" aria-hidden="true"></i> Close</button>
      </div>
	  </form>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="excel" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Export Excel Laporan RAP</h4>
      </div>
	  <form  class="form1" action="<?php echo site_url('rap/excel'); ?>" method="post" >
      <div class="modal-body">
        <h4>Pilih Instansi dan tahun terlebih dahulu!</h4>
		
					<div style="display:none" class="alert bg-danger" id="pesan1" role="alert">
					<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg>
					Instansi harus dipilih!!	
					
					</div>
					
			  <div class="form-group row ">
			  <div class="col-lg-9">
			  <label for="id_instansi">Instansi:</label>
				<select required class="form-control select2 " style="width: 100%;" name="id_instansi" id="id_instansi1">
				<option>-Pilih Instansi-</option>
				<?php
				 foreach ($instansi as $r)
					{
				?>
				<option value="<?=$r->id_instansi?>"  ><?=$r->nama_instansi." - ".$r->urusan_pemerintahan." - ".$r->organisasi." - ".$r->sub_unit_organisasi?></option>
					<?php } ?>
				
			  </select>
			  </div>
			 
			  <div class="col-lg-3">
			  <label for="tahun">Tahun:</label>
				<input type="text" style="width:100px" class="form-control calendar" readonly name="tahun" id="tahun" placeholder="Tahun" value="" />
			</div>
			</div>
			  
			   
			
      </div>
      <div class="modal-footer bg-primary">
			<button type="submit"  class="btn btn-warning"><i class="fa fa-check" aria-hidden="true"></i> Export Excel</button>
			<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove" aria-hidden="true"></i> Close</button>
      </div>
	  </form>
    </div>

  </div>
</div>
		
		
		</div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('rap/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('rap'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                        </span>
                    </div>
                </form>
            </div>
            </div>
        
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr class="tb-head">
                <th>No</th>
		<th >Detail Kegiatan</th>
		<th>Detail Dana</th>
		<th width="100px">Instansi</th>
		<th width="50px">Created By</th>
		<th>Action</th>
            </tr><?php
            foreach ($rap_data as $rap)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td>
			
			
			<table class="table1">
			<tr><th>Kode Kegiatan</th><td>: <?php echo $rap->kode_kegiatan?></td></tr>
			<tr><th>Uraian Kegiatan</th><td>: <?php echo $rap->uraian_kegiatan ?></td></tr>
			<tr><th>Lokasi </th><td>: <?php echo $rap->lokasi_kegiatan ?></td></tr>
			<tr><th>Target</th><td>: <?php echo $rap->target_kegiatan ?></td></tr>
			<tr><th>Sumber Dana</th><td>: <?php echo $rap->sumber_dana ?></td></tr>
			<tr><th>Tahun</th><td>: <?php echo $rap->tahun ?></td></tr>
			</table>
			</td>
			
			
			<td>
			
			<table class="table1">
			<tr><th>Triwulan 1</th><td style="text-align:right">: <?php echo "Rp".number_format($rap->triwulan_1) ?></td></tr>
			<tr><th>Triwulan 2</th><td style="text-align:right">: <?php echo "Rp".number_format($rap->triwulan_2) ?></td></tr>
			<tr><th>Triwulan 3</th><td style="text-align:right">: <?php echo "Rp".number_format($rap->triwulan_3) ?></td></tr>
			<tr><th>Triwulan 4</th><td style="text-align:right">: <?php echo "Rp".number_format($rap->triwulan_4) ?></td></tr>
			<tr style="border-top:2px solid #000"><th>Jumlah Total</th><td style="text-align:right">: <?php echo "Rp".number_format($rap->jumlah_total) ?></td></tr>
			</table>
			
			</td>
			<td>
			<?=$rap->nama_instansi." - ".$rap->urusan_pemerintahan." - ".$rap->organisasi." - ".$rap->sub_unit_organisasi?>
			</td>
			<td><?php echo $rap->nama ?></td>
			<td style="text-align:left" width="80px">
				<?php 
				
				echo anchor(site_url('rap/update/'.$rap->id_rap),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit','class="btn btn-warning btn-sm" style="margin-bottom:5px"'); 
				echo '  '; 
				echo anchor(site_url('rap/delete/'.$rap->id_rap),'<i class="fa fa-trash-o" aria-hidden="true"></i> Delete','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>