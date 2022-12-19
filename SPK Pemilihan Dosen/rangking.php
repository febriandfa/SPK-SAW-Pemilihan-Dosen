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

//membaca nilai max nilai alternatif

//membaca nilai min nilai alternatif
?>
<br>
<div class="container">
  <div class="row">
		<div class="col-md-6 text-left">
			<h4>Data Rangking</h4>
		</div>
  </div>
  <br>
    <table class="table table-striped table-bordered">
      	<thead>
      		<tr>
      			<th rowspan="2" style="vertical-align: middle" class="text-center">Alternatif</th>
      			<th colspan="<?php echo mysqli_num_rows($readlAllkr); ?>" class="text-center">Kriteria</th>
      			<th rowspan="2" style="vertical-align: middle" class="text-center">Hasil</th>
      		</tr>
      		<tr>
      			<?php  
      			while ($row1 = mysqli_fetch_assoc($readlAllkr)) {
      			?>
      				<th><?php echo $row1['nama_kriteria'] ?></th>
      			<?php
      			}
      			?>
      			</tr>
      		</thead>
      		<tbody>
      			<?php 
				while ($row2 = mysqli_fetch_assoc($readlAllalt)) {
      			?>
	      		<tr>
	      			<th><?php echo $row2['nama_alternatif'] ?></th>
	      			<?php  
	      			$a = $row2['id_alternatif'];
	      			$readR = mysqli_query($koneksi,"SELECT * FROM alternatif a, kriteria b, rangking c WHERE a.id_alternatif=c.id_alternatif AND b.id_kriteria=c.id_kriteria AND c.id_alternatif='$a'");
	      			while ($rowR = mysqli_fetch_assoc($readR)) {
	      				$b = $rowR['id_kriteria'];
						$tipe = $rowR['tipe_kriteria'];
						$bobot = $rowR['bobot_kriteria']/100;
	      			?>
	      			<td>
	      				<?php 
		                if($tipe=='Benefit'){
		                	$max = mysqli_query($koneksi,"SELECT MAX(nilai_rangking) as mnr1 FROM rangking WHERE id_kriteria='$b' LIMIT 0,1");
							$maxnr = mysqli_fetch_assoc($max);
							$nor = round($rowR['nilai_rangking']/$maxnr['mnr1'], 4);
							echo round($nor, 4);
						}else {
							$min = mysqli_query($koneksi,"SELECT min(nilai_rangking) as mnr2 FROM rangking WHERE id_kriteria='$b' LIMIT 0,1");
							$minnr = mysqli_fetch_array($min);
							$nor = round($minnr['mnr2']/$rowR['nilai_rangking'], 4);
							echo round($nor, 4);
						}
						$v = round($bobot*$nor, 4);
						$normalisasi = mysqli_query($koneksi,"UPDATE rangking
															SET 
																nilai_normalisasi = '$nor',
																bobot_normalisasi = '$v'
															WHERE id_alternatif = '$a' 
															AND id_kriteria = '$b'");
		                ?>
	      			</td>
	      			<?php  
	      			}
	      			?>
	      			<td>
	      				<?php  
	      				$readHasil = mysqli_query($koneksi,"SELECT SUM(bobot_normalisasi) as bbn FROM rangking WHERE id_alternatif='$a' LIMIT 0,1");
	      				$hasil = mysqli_fetch_assoc($readHasil);
	      				echo round($hasil['bbn'], 4);
	      				$has = round($hasil['bbn'], 4);
	      				$query = mysqli_query($koneksi,"UPDATE alternatif
							SET hasil_alternatif = '$has'
							WHERE id_alternatif = '$a'");
	      				?>
	      			</td>
	      		</tr>
	      		<tr>
	      			<td></td>
	      		</tr>
      		<?php	
      		} 
      		?>
      	</tbody>
      	</table>
    </div>
  </div>
</div>

<?php  
include "footer.php";
?>