<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		
		<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Dashboard</div>
					<div class="panel-body">
					<?php if ($this->session->flashdata('status') != null) { ?>
					<div class="alert bg-success" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"/></svg>
					<?php echo $this->session->flashdata('status') ?>	
					<a  class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
					<?php } ?>
		<div class="row">		
		<div class="col-md-12">
		<?php if ($this->session->userdata('level') == 'admin') { ?>	
			<h4>Selamat Datang <?=$_SESSION['nama']?>!</h4>
			<p>Anda login sebagai Admin. Berikut adalah menu-menu dan fitur-fiturnya</p><br>
		<?php } else { ?>
			<h4>Selamat Datang <?=$_SESSION['nama']?>!</h4>
			<p>Anda login sebagai Siswa. Berikut adalah data yang bisa anda kelola. Pastikan anda sudah menginput kegiatan pada Data Kegiatan, baru menginput Data Instansi, dan menginput data yang lainnya. Selamat mengerjakan! </p><br>
		
		<?php } ?>	
		</div>	
					
			
		<?php if ($this->session->userdata('level') == 'admin') { ?>			
			<p>
			<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-3 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-9 widget-right">
							<div class="large"><?=$admin?> 
							<a href="<?php echo base_url('admin');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selengkapnya</a>
							</div>
							<div class="text-muted">Data User</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
			<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-3 widget-left">
							<svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg>
						</div>
						<div class="col-sm-9 col-lg-9 widget-right">
							<div class="large"><?=$kegiatan?>
							<a href="<?php echo base_url('kegiatan');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selengkapnya</a>
							</div>
							<div class="text-muted">Uraian Kegiatan</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-3 widget-left">
							<svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg>
						</div>
						<div class="col-sm-9 col-lg-9 widget-right">
							<div class="large"><?=$instansi?>
							<a href="<?php echo base_url('instansi');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selengkapnya</a>
							</div>
							<div class="text-muted">Data Instansi</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
					
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-orange panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-3 widget-left">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg>
						</div>
						<div class="col-sm-9 col-lg-9 widget-right">
							<div class="large"><?=$rap?> 
							<a href="<?php echo base_url('rap');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selengkapnya</a>
							</div>
							<div class="text-muted">Data RAP</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-3 widget-left">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg>
						</div>
						<div class="col-sm-9 col-lg-9 widget-right">
							<div class="large"><?=$belanja?>
							<a href="<?php echo base_url('belanja');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selengkapnya</a>
							</div>
							<div class="text-muted">Data Pembelanjaan</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-3 widget-left">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg>
						</div>
						<div class="col-sm-9 col-lg-9 widget-right">
							<div class="large"><?=$pendapatan?>
							<a href="<?php echo base_url('pendapatan');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selengkapnya</a>
							</div>
							<div class="text-muted">Data Pendapatan</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->				
					</div>
					
				</div>
			</div>
		
		
		
	</div>	<!--/.main-->