<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		
		
		
			<div class="col-lg-12">
				<div class="panel panel-default">
                        <div class="panel-heading">KELOLA DATA KEGIATAN</div>
                   
        
        <div class="panel-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('kegiatan/create'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-success btn-sm"'); ?>
		</div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('kegiatan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('kegiatan'); ?>" class="btn btn-default">Reset</a>
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
		<th>Kode Kegiatan</th>
		<th>Uraian Kegiatan</th>
		<th>Created By</th>
		<th>Action</th>
            </tr><?php
            foreach ($kegiatan_data as $kegiatan)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $kegiatan->kode_kegiatan ?></td>
			<td><?php echo $kegiatan->uraian_kegiatan ?></td>
			<td><?php echo $kegiatan->nama ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				
				echo anchor(site_url('kegiatan/update/'.$kegiatan->id_kegiatan),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit','class="btn btn-warning btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('kegiatan/delete/'.$kegiatan->id_kegiatan),'<i class="fa fa-trash-o" aria-hidden="true"></i> Delete','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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