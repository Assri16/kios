<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>APLIKASI DATA BARANG</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="lib/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="lib/css/bootstrap-theme.min.css">
</head>
<body>
	<div class="container">
	<h2>APLIKASI DATA BARANG</h2>
	<p><a href="index.php">Tambah Data</a></p>
	<p>
    <a href="logout.php">Logout</a></li>
    
	  </p>
	  </p>
      <a href="rekap.php">Rekap</a></li>
      </p>
      </p>
	<h3>DATA BARANG</h3>

	<form method="post" action="" class="form-inline">	
			  <div class="form-group">
	<select name="kategori" class="form-control">

	<option value="Id_barang">Id barang</option>
	<option value="nama_barang">Nama barang</option>
	</select>
	<input type="text" name="search" class="form-control"/>
	<input type="submit" name="cari" value="cari" class="btn btn-success">
	</div>
	</form><br>
	<table cellpadding="5" cellspacing="0" border="1" class="table table-bordered">
		<tr bgcolor="#CCCCCC">
			<th><center>No.</th>
			<th><center>Id barang</th>
			<th><center>Nama barang</th>
			<th><center>Satuan</th>
			<th><center>harga</th>
            <th><center>Delete</th>
            <th><center>Edit</th>
            </center>
    </tr>
		
		<?php
		//iclude file koneksi ke database
		include('koneksi.php');
		
		$query = mysql_query("SELECT * FROM tbarang ORDER BY tbarang.id_barang") or die(mysql_error());
		if (isset($_POST['cari'])) {
				   $search = $_POST['search'];
				   $kategori = $_POST['kategori'];
				   
				   $sql = "SELECT * FROM tbarang WHERE $kategori LIKE '%$search%'";
				   $result = mysql_query($sql) or die('Error, list obat failed. ' . mysql_error());
					
				   if (mysql_num_rows($result) == 0) {
					echo '<p></p><p>Pencarian tidak ditemukan</p>';
				   } else {
					echo '<p></p>';
					$no = 1;
					while ($row = mysql_fetch_array($result)) {
					 extract($row);
					  echo '<tr>';
					echo '<td>'.$no.'</td>';
					 echo '<td> '.$Id_barang.'</td>';
					 echo '<td> '.$nama_barang.'</td>';
					 echo '<td> '.$satuan.'</td>';
					 echo '<td> '.$harga.'</td>';
					 
					 echo '</tr>';
					 $no++;
					}
					
				   }
				  }
		//cek, apakakah hasil query di atas mendapatkan hasil atau tidak (data kosong atau tidak)
		 else if(mysql_num_rows($query) == 0){	//ini artinya jika data hasil query di atas kosong
			
			//jika data kosong, maka akan menampilkan row kosong
			echo '<tr><td colspan="6">Tidak ada data!</td></tr>';
			
		}else{	//else ini artinya jika data hasil query ada (data diu database tidak kosong)
			
			//jika data tidak kosong, maka akan melakukan perulangan while
			$no = 1;	//membuat variabel $no untuk membuat nomor urut
			while($data = mysql_fetch_assoc($query)){	//perulangan while dg membuat variabel $data yang akan mengambil data di database
				
				//menampilkan row dengan data di database
				echo "<tr>
					<td><center>$no</td>	
					<td><center>$data[Id_barang]</td>
					<td><center>$data[nama_barang]</td>	
					<td><center>$data[satuan]</td>	
					<td><center>$data[harga]</td>
					<td><center><a href='deletebarang.php?Id_barang=$data[Id_barang]'>Delete</a></td>
					<td><center><a href='formeditbarang.php?Id_barang=$data[Id_barang]'>Edit</a></td>
					</center>			
				</tr>";
				
				$no++;
				
			}
			
		}
		?>
	</table>
	</div>
</body>
<script src="lib/js/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="lib/js/bootstrap.min.js"></script>

</html>