<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sistem Informasi Administrasi Keuangan</title>

<link href="<?php echo base_url();?>assets/css/bootstrap.css?=<?=time()?>" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/datepicker3.css?=<?=time()?>" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/styles.css?=<?=time()?>" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/select2.min.css?=<?=time()?>" rel="stylesheet">
<link  href="<?=base_url();?>assets/font-awesome4.3.0/css/font-awesome.css?=<?=time()?>" rel="stylesheet">

<link href="<?=base_url();?>assets/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<!--Icons-->
<script src="<?php echo base_url();?>assets/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>SIADMINKEU</span></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?=$_SESSION['username']?> | <?=$_SESSION['nama']?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo base_url('auth/admin');?>"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="<?php echo base_url('login/logout');?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
							
							
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search" >
			<div class="form-group ">
				<h3 class="text-center">Menu Utama</h3>
			</div>
		</form>
		<ul class="nav menu">
			<li class="<?php if ($menu == "home") { echo "active"; } ?>"><a href="<?php echo base_url("home");?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<?php if ($this->session->userdata('level') == 'admin') { ?>	
			<li class="<?php if ($menu == "admin") { echo "active"; } ?>"><a href="<?php echo base_url("admin");?>"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Manajemen User</a></li>
			<?php } ?>
			<li class="<?php if ($menu == "kegiatan") { echo "active"; } ?>"><a href="<?php echo base_url("kegiatan");?>"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Data Kegiatan</a></li>
			<li class="<?php if ($menu == "instansi") { echo "active"; } ?>"><a href="<?php echo base_url("instansi");?>"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Data Instansi</a></li>
			<li class="<?php if ($menu == "rap") { echo "active"; } ?>"><a href="<?php echo base_url("rap");?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Data RAP</a></li>
			<li class="<?php if ($menu == "belanja") { echo "active"; } ?>"><a href="<?php echo base_url("belanja");?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Data Pembelanjaan</a></li>
			<li class="<?php if ($menu == "pendapatan") { echo "active"; } ?>"><a href="<?php echo base_url("pendapatan");?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Data Pendapatan</a></li>
			
		</ul>

	</div><!--/.sidebar-->
		
	<?php echo $contents ?> 

	<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
	
	<script> 
	$(document).ready(function(){
		$("#tidak").click(function(){
			$("#alasan").slideDown();
		});
		
		$("#reset").click(function(){
			$("#isi").val("");
			$("#alasan").slideUp();
		});
	});
	</script>
	
	
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/chart.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/chart-data.js"></script>
	<script src="<?php echo base_url();?>assets/js/easypiechart.js"></script>
	<script src="<?php echo base_url();?>assets/js/easypiechart-data.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
	
	<script>
	var tahun = new Date();
		$(".calendar").val(tahun.getFullYear());
		$('.calendar').datepicker({
			format: "yyyy",
			viewMode: "years", 
			minViewMode: "years"
		});
		
		$('#calendar2').datepicker({
		});
		
		$('#calendar3').datepicker({
		});
		
		$('#calendar4').datepicker({
		});
		
		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>

<script>
		document.getElementById("uploadBtn1").onchange = function () {
			document.getElementById("uploadFile1").value = this.value;
		};	
</script>
		
	
		<!-- Jquery DataTable Plugin Js -->
		<script  type="text/javascript" src="<?=base_url();?>assets/jquery-datatable/jquery.dataTables.js"></script>
		<script  type="text/javascript" src="<?=base_url();?>assets/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
		
		
<script type="text/javascript">
$(function () {
    $('.data').DataTable({
        responsive: true,
		"lengthMenu": [[50, 100, 200], [50, 100, 200]],
		 "order": [[ 0, "desc" ]],
    });
	 $('.data2').DataTable({
        responsive: true,
		"lengthMenu": [[50, 100, 200], [50, 100, 200]],
		 "order": [[ 3, "asc" ]],
    });
	 $('.data3').DataTable({
        responsive: true,
		"lengthMenu": [[10, 50, 100], [10, 50, 100]],
    });
	 $('.data4').DataTable({
        responsive: true,
		"lengthMenu": [[5, 10, 50], [5, 10, 50]],
    });
});
</script>		


<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>


<script> 
function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^.\d]/g, '').toString(),
			split	= number_string.split('.'),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{1,3}/g);
			
		if (ribuan) {
			separator = sisa ? ',' : '';
			rupiah += separator + ribuan.join(',');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : ',');
	}


	/* triwulan_1 */
	var triwulan_1 = document.getElementById('triwulan_1');
	if (triwulan_1 != null) { 
		triwulan_1.addEventListener('keyup', function(e)
		{
			triwulan_1.value = formatRupiah(this.value);
		});
	}
	
	/* triwulan_2 */
	var triwulan_2 = document.getElementById('triwulan_2');
	if (triwulan_2 != null) { 
		triwulan_2.addEventListener('keyup', function(e)
		{
			triwulan_2.value = formatRupiah(this.value);
		});
	}
	
	/* triwulan_3 */
	var triwulan_3 = document.getElementById('triwulan_3');
	if (triwulan_3 != null) { 
		triwulan_3.addEventListener('keyup', function(e)
		{
			triwulan_3.value = formatRupiah(this.value);
		});
	}
	
	/* triwulan_4 */
	var triwulan_4 = document.getElementById('triwulan_4');
	if (triwulan_4 != null) { 
		triwulan_4.addEventListener('keyup', function(e)
		{
			triwulan_4.value = formatRupiah(this.value);
		});
	}
	
	/* harga */
	var harga = document.getElementById('harga');
	if (harga != null) { 
		harga.addEventListener('keyup', function(e)
		{
			harga.value = formatRupiah(this.value);
		});
	}
	
	
	
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.form').submit(function() {
			var id_instansi	 = $('#id_instansi').val();			
 
			if (id_instansi == '-Pilih Instansi-') {				
				$("#pesan").css('display','block');
				return false;
			} else {
				$("#pesan").css('display','none');
			}
		});
		$('.form1').submit(function() {
			var id_instansi1	 = $('#id_instansi1').val();			
 
			if (id_instansi1 == '-Pilih Instansi-') {				
				$("#pesan1").css('display','block');
				return false;
			} else {
				$("#pesan1").css('display','none');
			}
		});
	});
</script>

</body>

</html>
