<?php
$sql = $koneksi->query("SELECT count(id_buku) as buku from tb_buku");
while ($data = $sql->fetch_assoc()) {

	$buku = $data['buku'];
}
?>

<?php
$sql = $koneksi->query("SELECT count(id_anggota) as agt from tb_anggota");
while ($data = $sql->fetch_assoc()) {

	$agt = $data['agt'];
}
?>

<?php
$sql = $koneksi->query("SELECT count(id_sk) as pin from tb_sirkulasi where status='PIN'");
while ($data = $sql->fetch_assoc()) {

	$pin = $data['pin'];
}
?>

<?php
$sql = $koneksi->query("SELECT count(id_sk) as kem from tb_sirkulasi where status='KEM'");
while ($data = $sql->fetch_assoc()) {

	$kem = $data['kem'];
}
?>

<?php
$sql = $koneksi->query("SELECT count(id_sk) as kem from tb_sirkulasi where status='KEM'");
while ($data = $sql->fetch_assoc()) {

	$kem = $data['kem'];
}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard Anggota <?php echo $_SESSION["ses_id"] ?>
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">

		<div class="col-lg-6 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-blue">
				<div class="inner">
					<h4>
						<?= $buku; ?>
					</h4>

					<p>Buku</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="?page=MyApp/data_buku" class="small-box-footer">More info
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>

		<div class="col-lg-6 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h4>
						<?= $buku; ?>
					</h4>

					<p>Riwayat Peminjaman</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="?page=data_sirkul" class="small-box-footer">More info
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>

		

		
	</div>
	<div class="card">
		<div class="card-header">

			<div class="row">
				<div class="col-sm-2"><img src="dist/img/smp.png" class="img" height="80" alt="User Image"></div>
				<div class="col-sm-8">
					<div class="school-info">
						<h4 class="text-center">KARTU ANGGOTA PERPUSTAKAAN</h4>
						<p>SMP Mohammadiyah 2 Boja</p>
						<small>Jl. Pramuka No.134, Getan Kidul, Boja, Kec. Boja, Kendal</small>
					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>

		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-stripped">
						<?php

						$sql = $koneksi->query("SELECT * FROM tb_anggota WHERE id_anggota='" . $_SESSION["ses_id"] . "'");
						while ($data = $sql->fetch_assoc()) {

						?>
							<tr>
								<td>ID Anggota</td>
								<td>:</td>
								<td>
									<?php echo $data['id_anggota']; ?>
								</td>
							</tr>
							<tr>
								<td>Nama</td>
								<td>:</td>
								<td>
									<?php echo $data['nama']; ?>
								</td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td>:</td>
								<td>
									<?php echo $data['jekel']; ?>
								</td>
							</tr>
							<tr>
								<td>Kelas</td>
								<td>:</td>
								<td>
									<?php echo $data['kelas']; ?>
								</td>
							</tr>
							<tr>
								<td>No HP</td>
								<td>:</td>
								<td>
									<?php echo $data['no_hp']; ?>
								</td>
							</tr>
							<tr>
								<td>Tempat/ Tanggal Lahir</td>
								<td>:</td>
								<td>
									<?php 
									$tanggal = $data['lahir'];
									$tanggal_baru = date("d-M-y", strtotime($tanggal));
									echo $data['tempat_lahir'].'/'.$tanggal_baru; ?>
								</td>								
							</tr>
							<tr>
								<td>Alamat</td>
								<td>:</td>
								<td>
									<?php echo $data['alamat']; ?>
								</td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>

			</div>
		</div>
	</div>
</section>