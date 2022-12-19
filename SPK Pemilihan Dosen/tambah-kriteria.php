<?php  
include "header.php";
include "includes/config.php";

//code insert data
if ($_POST) {
	$nm = $_POST['nm'];
	$bbt = $_POST['bbt'];
        $tp = $_POST['tp'];

	$insert = mysqli_query($koneksi,"INSERT INTO kriteria 
								VALUES
								('','$nm','$tp','$bbt')");
	if ($insert) {
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
			<h4>Form Tambah Kriteria</h4>
		</div>
		<div class="col-md-6">
			
		</div>
	</div>
	<br><br>
	<form method="POST" action="">
	  <div class="form-group row">
	    <label for="nm" class="col-sm-2 col-form-label">Nama Kriteria</label>
	    <div class="col-sm-10">
                <input type="text" class="form-control" id="nm" name="nm">
	    </div>
	  </div>
          <div class="form-group row">
	    <label for="bbt" class="col-sm-2 col-form-label">Bobot Kriteria</label>
	    <div class="col-sm-10">
                <input type="text" class="form-control" id="bbt" name="bbt">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="tp" class="col-sm-2 col-form-label">Tipe Kriteria</label>
            <div class="col-sm-10">
		<select class="form-control" id="tp" name="tp">
				<option value='Benefit'>Benefit</option>
				<option value='Cost'>Cost</option>
		</select>
            </div>
	  </div>
	  <div class="form-group row">
	    <div class="col-sm-10">
	      <button type="submit" class="btn btn-primary">Tambah</button>
	      <button type="button" onclick="location.href='kriteria.php'" class="btn btn-success">Kembali</button>
	    </div>
	  </div>
	</form>
</div>