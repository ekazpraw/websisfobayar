<html>
<head>
<title>Ubah Formulir Calon Siswa</title>
<link rel="stylesheet" href="css/calendar.css" type="text/css">
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/calendar2.js"></script>

<style>
.tulisan:link,.tulisan:visited
{ color:black; text-decoration:none;}

.tulisan:hover,.tulisan:active{
color:blue;}
</style>
<script type="text/javascript">
function angka(e){
	var el=e.target;
	if(el.value.toString().match(/^[0-9]+$/)==null){
		el.value=el.value.substring(0,el.value.length-1);
	}
}

function ubah(edit){
var check = (edit=="a") ? true : false;
if(check){
	if(document.forms[0].Nm_pembeli.value==""){
			alert ("Nama Pembeli belum di isi!");
			document.forms[0].Nm_pembeli.focus();
		}
	else if(document.forms[0].Nm_calonsiswa.value==""){
			alert ("Nama Calon Siswa belum di isi!");
			document.forms[0].Nm_calonsiswa.focus();
		}
	else if(document.forms[0].Jenkel.value==""){
			alert ("No Telepon belum di isi!");
			document.forms[0].Jenkel.focus();
		}
	}
}
</script>

</head>
<body>

<?php
$No_calonsiswa = $_GET['No_calonsiswa'];
$hasil = mysql_query("select * from calon_siswa where No_calonsiswa='$No_calonsiswa'");
$row = mysql_fetch_array($hasil);
//list($thn,$bln,$tgl) = explode ("-",$row['Tgl_lhr']);
?>
<br><h2><span>Ubah Formulir Calon Siswa</span></h2>
<div><?php include 'Proses_Edit_Siswa.php'; ?></div>
<form method="POST" action="">
<input type="hidden" name="No_calonsiswa" value="<?php echo $No_calonsiswa; ?>">
	<div class="module-table-body" align="center">
		<table border="1">
			<tr>
				<td><img src="images/Header2.png" align="center" width="800px"></img></td>
			</tr>
			<tr class="alts" align="center">
				<th scope="col" colspan="9">
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					Tahun Ajaran : <input name="Thn_ajaran" id="Thn_ajaran" type="text" size="10" value="<?php echo $row['Thn_ajaran'] ;?>" title="Harap Di isi!" > *)
				</th>
			</tr>
		</table>
		<table id="myTable" class="tablesorter">
                  <tr>
                    <td width='150'> Nomor Calon Siswa </td>
					<td width='15'>:</td>
                    <td>
                        <input type="text" name="No_calonsiswa" value="<?php echo $row['No_calonsiswa']; ?>" size="8" maxlength="10" title="Harap Di isi!" disabled="disabled"/>
                    *)</td>
                  </tr>
                  <tr>
                    <td> Nama Pembeli </td>
					<td>:</td>
                    <td>
                        <input type="text" name="Nm_pembeli" maxlength="100" size="40" value="<?php echo $row['Nm_pembeli'] ;?>" title="Harap Di isi!">
                    *)</td>
                  </tr>
				 <tr>
                    <td> Nama Calon Siswa </td>
					<td>:</td>
                    <td>
                        <input type="text" name="Nm_calonsiswa" maxlength="100" size="40" value="<?php echo $row['Nm_calonsiswa'] ;?>" title="Harap Di isi!">
                    *)</td>
                  </tr>
                  <tr>
                    <td> Jenis Kelamin </td>
                    <td>:</td>
                    <td><input type='radio' name='Jenkel' value="LAKI" <?php echo ($row['Jenkel']=='LAKI')?"checked":""; ?> title="Harap Di isi!">Laki-Laki /<input type='radio' name='Jenkel' value="Perempuan" <?php echo ($row['Jenkel']=='Perempuan')?"checked":""; ?> title="Harap Di isi!">Perempuan *)</td>
                </tr>
				<tr>
					<td colspan=3>*) Isikan secara lengkap </td>
				</tr>
                  <tr>
                    <th colspan='6'><input name="edit" type="submit" value="Ubah" onFocus="return ubah('a')" onclick="return confirm('Anda yakin ingin mengubah data ini?');">&nbsp;<a href="index.php?module=masterdata_siswa" class="tulisan"><img src="images/home.png" border="0" style="padding-right:3px;" align="right" title="Back"/></a>
                    </th>
                  </tr>
                </table>
				</form><br/>
        	<div style="clear: both"></div>
		</div> <!-- End .module-table-body -->
</body>
</html>	