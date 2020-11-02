<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LAPORAN PENDAPATAN <?=$sub_unit_organisasi?></title>

<link href="<?php echo base_url();?>assets/css/print.css?=<?=time()?>" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<body class="print" onLoad="window.print()">  

<![endif]-->

</head>
<body class="print" onLoad="window.print()">   

<div style="width:1000px;" class="preview">
	
	<div class="title">
	<br>
	<b>DOKUMEN PENERIMAAN/PENDAPATAN  ANGGARAN SATUAN KERJA PERANGKAT DAERAH</b><br>
	<b><?=$nama_instansi?></b><br>
	<b>TAHUN <?=$tahun?> </b><br>
	
	<div class="border"></div>
	</div>
	
		
 <table class="table" style="margin-bottom: 10px">
            <tr >
                <th style="width:100px" rowspan="2">KODE <br>KEGIATAN</th>
				<th rowspan="2">URAIAN KEGIATAN</th>
				<th rowspan="2">SUMBER DANA</th>
				<th colspan="4">TRIWULAN</th>
				<th rowspan="2">JUMLAH</th>
            </tr>
			<tr >
				
				<th >I</th>
				<th >II</th>
				<th >III</th>
				<th >IV</th>
            </tr><?php
            foreach ($pendapatan_data as $pendapatan)
            {
                ?>
                <tr>
			<td ><?php echo $pendapatan->kode_kegiatan?></td>
			<td><?php echo $pendapatan->uraian_kegiatan ?></td>
			<td><?php echo $pendapatan->sumber_dana ?></td>
			<td><?php echo "Rp".number_format($pendapatan->triwulan_1) ?></td>
			<td><?php echo "Rp".number_format($pendapatan->triwulan_2) ?></td>
			<td><?php echo "Rp".number_format($pendapatan->triwulan_3) ?></td>
			<td><?php echo "Rp".number_format($pendapatan->triwulan_4) ?></td>
			<td><?php echo "Rp".number_format($pendapatan->jumlah_total) ?></td>
		</tr>
                <?php
            }
            ?>
        </table>							
	
			<table style="border:0px solid #000">		
		<tr  >
			
			<td class="ttd"  class="text-left">
				
			</td>
			<td class="ttd" style="width:50%" >
				
			</td>
			<td class="ttd" style="width:230px">
				<br>
				<br>
				<br>
				……………………………………….
				<br>
				<br>
				<br>
				
			</td>
			
		</tr>	
		<tr  >
			
			<td class="ttd"  class="text-left">
				Mengetahui,<br>
				<?=$pejabat_mengetahui?>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<?=$nama_pejabat?>
			</td>
			<td class="ttd"  >
				
			</td>
			<td class="ttd" >
				<br>Penanggung Jawab Penggunaan Dana
				<br>
				<br>
				<br>	
				<br>
				<br>
				<br>
				<?=$penanggung_jawab?>
				
			</td>
			
		</tr>					
	</table>	
	<br>
	<div class="footer">Sistem Informasi Administrasi Keuangan</div>				
</div>	

		
</body>

</html>		