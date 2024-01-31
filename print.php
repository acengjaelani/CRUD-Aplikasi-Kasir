<?php 
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	$hsl = $lihat -> penjualan();
?>
<html>
	<head>
		<title>print</title>
		<link rel="stylesheet" href="print.css">
	</head>
	<body>
		<script>window.print();</script>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
						<div class="logo_toko">
							<img src="logo.png" alt="" width="100px">
							<div class="nama_toko">
								<b><h2><?php echo $toko['nama_toko'];?></h2></b>	
							</div>
						</div>
						<p class="alamat_toko"><?php echo $toko['alamat_toko'];?></p>
						<hr>
						<p class="tanggal">Tanggal : <?php  echo date("j F Y, G:i");?></p>
						<p class="kasir">Kasir     : <?php  echo $_GET['nm_member'];?></p>
						<hr>
					<table class="table table-bordered" style="width:100%;">
						<tr>
							<td>No.</td>
							<td>Barang</td>
							<td>Jumlah</td>
							<td>Total</td>
						</tr>
						<?php $no=1; foreach($hsl as $isi){?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $isi['nama_barang'];?></td>
							<td><?php echo $isi['jumlah'];?></td>
							<td><?php echo $isi['total'];?></td>
						</tr>
						<?php $no++; }?>
					</table>
					<hr>
					<div class="pull-right">
						<?php $hasil = $lihat -> jumlah(); ?>
						Total 	: Rp.<?php echo number_format($hasil['bayar']);?>,-
						<br/>
						Bayar 	: Rp.<?php echo number_format($_GET['bayar']);?>,-
						<br/>
						Kembali : Rp.<?php echo number_format($_GET['kembali']);?>,-
					</div>
					<div class="clearfix"></div>
					<hr>
					<center>
						<p>~Terima Kasih Telah Berbelanja di Toko Kami~</p>
					</center>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
	</body>
</html>
