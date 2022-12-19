<?php  
include "header.php";
include "includes/config.php";
//code edit data
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$query = mysqli_query($koneksi,"SELECT * FROM kriteria WHERE id_kriteria='$id'");
$getRow = mysqli_fetch_array($query);
$query2 = mysqli_query($koneksi,"SELECT * FROM kriteria WHERE id_kriteria='$id'");
$getRow2 = mysqli_fetch_array($query2);
$query3 = mysqli_query($koneksi,"SELECT * FROM kriteria WHERE id_kriteria='$id'");
$getRow3 = mysqli_fetch_array($query3);
$readlAllket = mysqli_query($koneksi,"SELECT * FROM nilai_kriteria ORDER BY id_nilai_kriteria ASC");
$readlAllnk = mysqli_query($koneksi,"SELECT * FROM nilai_kriteria ORDER BY id_nilai_kriteria ASC");

//code update data
if ($_POST) {
	$nm = $_POST['nm'];
	$tp = $_POST['tp'];
	$bbt = $_POST['bbt'];

	$update = mysqli_query($koneksi,"UPDATE kriteria 
						SET nama_kriteria='$nm',tipe_kriteria='$tp',bobot_kriteria='$bbt'
						WHERE id_kriteria ='$id'");
	if ($update) {
		echo "<script>location.href='kriteria.php'</script>";
	}else {
		echo "Gagal";
	}
}
?>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-6 text-left">
			<h4>Form Ubah Kriteria</h4>
		</div>
		<div class="col-md-6">
			
		</div>
	</div>
	<br><br>
	<form method="POST" action="">
	  <div class="form-group">
	    <label for="id">Id Kriteria</label>
	    <div>
	      <input type="text" class="form-control" id="id" name="id" value="<?php echo $getRow['id_kriteria'] ?>" disabled>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="nm">Nama Kriteria</label>
	    <div>
			<input type="text" class="form-control" id="nm" name="nm" value="<?php echo $getRow2['nama_kriteria'] ?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="tp">Tipe Kriteria</label>
	    <div>
	      <select class="form-control" id="tp" name="tp">
				<option><?php echo $getRow['tipe_kriteria']; ?></option>
				<?php  
					if ($getRow['tipe_kriteria'] == "Cost") {
						echo"<option value='Benefit'>Benefit</option>";
					}else {
						echo "<option value='Cost'>Cost</option>";
					}
				?>
		  </select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="bbt">Bobot Kriteria</label>
	    <div>
			<input type="text" class="form-control" id="bbt" name="bbt" value="<?php echo $getRow3['bobot_kriteria'] ?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <div>
	      <button type="submit" class="btn btn-primary">Ubah</button>
	      <button type="button" onclick="location.href='kriteria.php'" class="btn btn-success">Kembali</button>
	    </div>
	  </div>
	</form>
</div>