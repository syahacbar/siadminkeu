<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LAPORAN RAP <?=$sub_unit_organisasi?></title>

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
	<b>DOKUMEN PENGGUNAAAN/PENGELUARAN, BELANJA  ANGGARAN SATUAN KERJA PERANGKAT DAERAH</b><br>
	<b><?=$nama_instansi?></b><br>
	<b>TAHUN <?=$tahun?> </b><br>
	
	<div class="border"></div>
	</div>
	
		<table class="table2" style="width:100%">
			<tr>
				<td rowspan="3" style="width:100px"></td>
				<td class="text-left" style="width:125px">Urusan Pemerintahan</td>
				<td style="width:1px;">:</td>
				<td><?=$urusan_pemerintahan?></td>
			</tr>
			<tr>
				<td class="text-left">Organisasi</td>
				<td >:</td>
				<td><?=$organisasi?></td>
			</tr>	
			<tr >
				<td style="padding-bottom:5px" class="text-left">Sub Unit Organisasi</td>
				<td style="padding-bottom:5px">:</td>
				<td style="padding-bottom:5px"><?=$sub_unit_organisasi?></td>
			</tr>	
		</table>
 <table class="table" style="margin-bottom: 10px">
            <tr class="next-table">
                <th style="width:100px" rowspan="2">KODE <br>KEGIATAN</th>
				<th rowspan="2">URAIAN KEGIATAN</th>
				<th rowspan="2">LOKASI <br>KEGIATAN</th>
				<th rowspan="2">TARGET <br>KEGIATAN</th>
				<th rowspan="2">SUMBER <br>DANA</th>
				<th colspan="4">TRIWULAN</th>
				<th rowspan="2">JUMLAH</th>
            </tr>
			<tr class="next-table">
				
				<th >I</th>
				<th >II</th>
				<th >III</th>
				<th >IV</th>
            </tr><?php
            foreach ($rap_data as $rap)
            {
                ?>
                <tr>
			<td ><?php echo $rap->kode_kegiatan?></td>
			<td><?php echo $rap->uraian_kegiatan ?></td>
			<td><?php echo $rap->lokasi_kegiatan ?></td>
			<td><?php echo $rap->target_kegiatan ?></td>
			<td><?php echo $rap->sumber_dana ?></td>
			<td><?php echo "Rp".number_format($rap->triwulan_1) ?></td>
			<td><?php echo "Rp".number_format($rap->triwulan_2) ?></td>
			<td><?php echo "Rp".number_format($rap->triwulan_3) ?></td>
			<td><?php echo "Rp".number_format($rap->triwulan_4) ?></td>
			<td><?php echo "Rp".number_format($rap->jumlah_total) ?></td>
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