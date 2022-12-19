<?php
include "header.php";
include "includes/config.php";
$readK = mysqli_query($koneksi,"SELECT * FROM alternatif a, kriteria b, rangking c 
								WHERE a.id_alternatif=c.id_alternatif AND 
								b.id_kriteria=c.id_kriteria 
								ORDER BY a.id_alternatif ASC");
$readlAll = mysqli_query($koneksi,"SELECT * FROM rangking");
$readlAllkr = mysqli_query($koneksi,"SELECT * FROM kriteria ORDER BY id_kriteria ASC");
$readlAllalt = mysqli_query($koneksi,"SELECT * FROM alternatif ORDER BY id_alternatif ASC");
?>

<br>
<div class="container">
  <div class="row">
		<div class="col-md-6 text-left">
			<h4>Data Rangking</h4>
		</div>
		<div class="col-md-6 text-right">
			<button onclick="location.href='tambah-rangking.php'" class="btn btn-primary">Tambah Data</button>
		</div>
  </div>
  <br>
  <table id="tabeldata" width="100%" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Alternatif</th>
				<th>Kriteria</th>
				<th>Nilai</th>
				<th>Aksi</th>
			</tr>	
		</thead>

<tbody>

<?php
$no=1;
while ($row = mysqli_fetch_array($readK)){
?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['nama_alternatif'] ?></td>
		        <td><?php echo $row['nama_kriteria'] ?></td>
		        <td><?php echo $row['nilai_rangking'] ?></td>
                <td class="text-center">
					<a href="edit-rangking.php?ia=<?php echo $row['id_alternatif'] ?>&ik=<?php echo $row['id_kriteria'] ?>" class="btn btn-warning text-white"><i class="fas fa-pencil-alt"></i></a>
					<a href="hapus-rangking.php?ia=<?php echo $row['id_alternatif'] ?>&ik=<?php echo $row['id_kriteria'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="fas fa-trash-alt"></span></a>
			    </td>
            </tr>
<?php
}
?>

</tbody>

		<tfoot>
			<tr>
		    	<th>No</th>
		        <th>Alternatif</th>
		        <th>Kriteria</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
		</tfoot>
	</table>
    </div>

    <?php  
include "footer.php";
?>