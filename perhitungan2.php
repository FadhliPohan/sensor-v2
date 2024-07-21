<?php
include "head.php";
?>
<?php
$sql=mysql_query("select * from node_1 where id='".$_GET['id']."'");
										while($row=mysql_fetch_array($sql)){
											
										
?>
<tr>
								<td>Temperature</td>
								<td>
								<input type="hidden" name="tanggal" value="<?php echo $row['time']; ?>" class="form-control" required>
								<input type="text" name="suhu" value="<?php echo $row['temperature']; ?>" class="form-control" required></td>
							</tr>
							<tr>
								<td>Soil Moisture</td>
								<td><input type="text" name="sm" value="<?php echo $row['soilmoisture']; ?>" class="form-control" required></td>
							</tr>
							<tr>
								<td>Humidity</td>
								<td><input type="text" name="hm" value="<?php echo $row['humidity']; ?>" class="form-control" required></td>
							</tr>
							<tr>
								<td>Intensity</td>
								<td><input type="text" name="li" value="<?php echo $row['intensity']; ?>" class="form-control" required></td>
							</tr>
						<?php
										}
						?>