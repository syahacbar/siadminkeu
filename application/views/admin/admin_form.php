<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		
		
		
			<div class="col-lg-12">
				<div class="panel panel-default">
                 <div class="panel-heading">INPUT DATA USER</div>
            <div class="panel-body">
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table'>        

	    <tr><td width='200'>Nama User <?php echo form_error('nama') ?></td><td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama User" value="<?php echo $nama; ?>" /></td></tr>
	    <tr><td width='200'>Username <?php echo form_error('username') ?></td><td><input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" /></td></tr>
	    <tr><td width='200'>Password <?php echo form_error('password') ?></td><td><input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" /></td></tr>
	    <tr><td width='200'>Level <?php echo form_error('level') ?></td><td>
			<select class="form-control" name="level" id="level">
				<option>-Level-</option>
				<option value="admin" <?php if ($level == "admin") echo 'selected'; ?> >Admin</option>
				<option value="siswa" <?php if ($level == "siswa") echo 'selected'; ?> >Siswa</option>
			  </select>
		
		</td></tr>
	   
	    <tr><td></td><td><input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('admin') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>