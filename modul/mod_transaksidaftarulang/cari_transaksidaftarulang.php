<br>
<?php
$caripendaftaran_param = false;
if(isset($_GET['act'])){
	$caripendaftaran_param = $_GET['act'];
}
switch($caripendaftaran_param){
	default:
	include "fungsi/class_paging.php";
	$Num_Rows = mysql_num_rows(mysql_query("SELECT * FROM pendaftaran"));
?>
	<h2><span>Informasi pendaftaran, Total pendaftaran : <?php echo $Num_Rows; ?> </span></h2>

	<div class="module-table-body">
		<form method="post" action="index.php?module=cari_pendaftaran">
		<table id="myTable" class="tablesorter">
			<tr>
				<th><?php echo "<input type='button' value='Entry Pendaftaran' onclick=\"window.location.href='?module=entry_pendaftaran';\">"; ?>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
					<img src="images/cari.png" border="0" style="padding-right:3px;" title="Cari"/><input type="text" name="search" id="search" size="20"> <input type="submit" name="submit" value="Cari">
				</th>
			</tr>
		</form>
			<tr>	
				<td>
					<div style="font-family: arial; overflow: scroll; width: 100%; height: 350px;">
						<div style="text-align: center; width: 100%; padding: 0 px; overflow: hidden;">
							<table>
								<tr>
									<th style="width:3%">No</th>
									<th style="width:8%">Nomor Induk</th>
									<th style="width:25%">Nama Lengkap</th>
									<th style="width:13%">Jenis Kelamin</th>
									<th style="width:15%">Kelas</th>
									<th style="width:15%">Aksi</th>
								</tr>
								
								<?php
								$p      = new PagingPendaftaran;
								$batas  = 10;
								$posisi = $p->cariPosisi($batas);
								
								if((isset($_POST['submit'])) AND ($_POST['search'] <> "")){
										$search = $_POST['search'];
										$sql = mysql_query("SELECT * FROM kelas,siswa,pendaftaran WHERE kelas.Kd_kelas = siswa.Kd_kelas and siswa.No_pendaftaran = pendaftaran.No_pendaftaran and pendaftaran.No_induk LIKE '%$search%' ORDER BY No_induk ASC LIMIT $posisi,$batas");
										$jumlah1 = mysql_num_rows($sql);
										if ($jumlah1 > 0)
											{
												$no = $posisi+1;
												$data = mysql_fetch_array($sql);
									?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $data['No_induk']; ?></td>
										<td><?php echo $data['Nm_lengkap']; ?></td>
										<td><?php echo $data['Jenkel']; ?></td>
										<td><?php echo $data['Nm_kelas']; ?></td>
										<td align="center"><a href="?module=edit_pendaftaran&No_induk=<?php echo $data[No_induk]; ?>"><img src="images/edit.png" border="0" style="padding-right:3px;" title="Edit"/></a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="?module=hapus_pendaftaran&No_induk=<?php echo $data[No_induk]; ?>&Nm_lengkap=<?php echo $data[Nm_lengkap]; ?>" onclick="return confirm('Anda yakin ingin menghapus pendaftaran <?php echo $data[Nm_lengkap]; ?>?');"><img src="images/delete.png" border="0" style="padding-right:3px;" title="Hapus"/></a> </td>
									</tr>
									<?php
									$no++;
									echo "</table>";
											}else{
													$sql2 = mysql_query("SELECT * FROM kelas,siswa,pendaftaran WHERE kelas.Kd_kelas = siswa.Kd_kelas and siswa.No_pendaftaran = pendaftaran.No_pendaftaran and pendaftaran.Nm_lengkap LIKE '%$search%' ORDER BY No_induk ASC LIMIT $posisi,$batas");
													$jumlah2 = mysql_num_rows($sql2);
													if ($jumlah2 > 0)
														{
														$no = $posisi+1;
														$data2 = mysql_fetch_array($sql2);
												?>
												<tr>
													<td><?php echo $no; ?></td>
													<td><?php echo $data2['No_induk']; ?></td>
													<td><?php echo $data2['Nm_lengkap']; ?></td>
													<td><?php echo $data2['Jenkel']; ?></td>
													<td><?php echo $data2['Nm_kelas']; ?></td>
													<td align="center"><a href="?module=edit_pendaftaran&No_induk=<?php echo $data2[No_induk]; ?>"><img src="images/edit.png" border="0" style="padding-right:3px;" title="Edit"/></a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="?module=hapus_pendaftaran&No_induk=<?php echo $data2[No_induk]; ?>&Nm_lengkap=<?php echo $data2[Nm_lengkap]; ?>" onclick="return confirm('Anda yakin ingin menghapus pendaftaran <?php echo $data2[Nm_lengkap]; ?>?');"><img src="images/delete.png" border="0" style="padding-right:3px;" title="Hapus"/></a> </td>
												</tr>
												<?php
											$no++;
															}else
																{
																	echo "<script>alert('Data Tidak Ada'); window.location = 'index.php?module=pendaftaran'</script>";
																}
												echo "</table>";
															}
								}else{
									  echo "<script>alert('Masukkan Kata Kunci untuk Cari'); window.location = 'index.php?module=pendaftaran'</script>";
									  }
								?>
								</div>
							</div>
						</td>
					</tr>
				</table>
			
				<table>
					<tr>
						<td>
							<?php
							$jmldata = mysql_num_rows(mysql_query("SELECT * FROM pendaftaran"));
							$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
							$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

							echo "<div id='paging'>Hal: $linkHalaman </div>";
							?>
						</td>
					</tr>
				</table>
			<div style="clear: both"></div>
		</div> <!-- End .module-table-body -->
<?php
}
?>