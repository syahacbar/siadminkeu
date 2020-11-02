<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		
		
		
			<div class="col-lg-12">
				<div class="panel panel-default">
                    <div class="panel-heading">KELOLA DATA INSTANSI
                    </div>
        
        <div class="panel-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('instansi/create'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-success btn-sm"'); ?>
		</div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('instansi/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('instansi'); ?>" class="btn btn-default">Reset</a>
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
		<th>Detail Instansi</th>
		<th>Created By</th>
		<th>Action</th>
            </tr><?php
            foreach ($instansi_data as $instansi)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td>
			
			<table class="table">
			<tr><th>Nama Instansi</th><td>: <?php echo $instansi->nama_instansi ?></td></tr>
			<tr><th>Urusan Pemerintahan</th><td>: <?php echo $instansi->urusan_pemerintahan ?></td></tr>
			<tr><th>Organisasi</th><td>: <?php echo $instansi->organisasi ?></td></tr>
			<tr><th>Sub Unit Organisasi</th><td>: <?php echo $instansi->sub_unit_organisasi ?></td></tr>
			<tr><th><?php echo $instansi->pejabat_mengetahui ?></th><td>: <?php echo $instansi->nama_pejabat ?></td></tr>
			<tr><th>Penanggung Jawab</th><td>: <?php echo $instansi->penanggung_jawab ?></td></tr>
			</table>
			
			</td>
			
			<td><?php echo $instansi->nama ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				
				echo anchor(site_url('instansi/update/'.$instansi->id_instansi),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit','class="btn btn-warning btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('instansi/delete/'.$instansi->id_instansi),'<i class="fa fa-trash-o" aria-hidden="true"></i> Delete','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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