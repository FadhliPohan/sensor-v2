<?php 
include "inc/koneksi.php";


	
	$content ='		
		<h5 style="text-align:center">Report  <br /> MONTH '.$_GET['bulan'].' YEAR '.$_GET['tahun'].'</h5>
			<table class=""  style="border-collapse:collapse;width:100%;" width="800px" border=1>
						<tr>
						
							<td style="height:30px;width:150px" >Time</td>
							<td style="height:30px;width:100px" >Temperature</td>
							<td style="height:30px;width:100px" >Soil Moisture</td>
							<td style="height:30px;width:100px" >Humidity</td>
							<td style="height:30px;width:100px" >Intensity</td>
							
							<td style="height:30px;width:150px" >Result</td>
							
						</tr>
						';
						
							$nomor=0;
							$tampil22 = mysql_query("SELECT * from tb_hasil_menit where MONTH(tanggal)='".$_GET['bulan']."' AND YEAR(tanggal)='".$_GET['tahun']."'");
							while ($data222 = mysql_fetch_array($tampil22)) {
								$content .="
							<tr>
							<td>
									".$data222['tanggal']."
								</td>
							
								
							
							<td>
							".$data222['suhu']."
							</td>
							
							<td>
							".$data222['sm']."
							</td>
							<td>
							".$data222['humidity']."
							</td>
							<td>
							".$data222['li']."
							</td>
							
							<td>
							".$data222['nilai']." Seconds
							</td>
							
							</tr>
							
							";	
							}
							$content .="
							</table>
							
							";
							  require_once('./html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF ('P','F4','en');
    $html2pdf->WriteHTML($content);
    ob_end_clean();
    $html2pdf->Output('LAPORAN.pdf');
   
								?>
						
					</table>

