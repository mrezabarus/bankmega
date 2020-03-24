adminmax
<table id="data" cellspacing="1" class="table table-striped  table-bordered table-hover table-hover-info">
  <tbody>
	<tr class="judul">
		<!--	
		<th class="center">id jadwal awal</th>
		<th class="center">id jadwal</th> -->
		<th class="center">kursus</th>
		<th class="center">nip</th>
		<th class="center">nama</th>
		<th class="center">posisi detail</th>
		<th class="center">regional</th>
		<th class="center">last activity</th>
		<th class="center">pre test</th>
		<th class="center">duration</th>
		<th class="center">post test</th>
		<th class="center">serial</th>
	</tr>

  <?php 
	$no=1;
	foreach ($rowdata as $result2) {
	  if(!empty($result2)){		
		foreach ($result2 as $result3) {
		
			$result3->user_name = ucwords(strtolower( $result3->user_name ));
		
		  // id_jadwal_awal,id_jadwal,id_kursus,ID_USER,USER_NAME,posisi_detail,org,organisasi_name,regional_name
		  echo '
		<tr class="data2">
			<td>'. $result3->kursus_name .'</td>
			<td>'. $result3->id_user .'</td>
			<td>'. $result3->user_name .'</td>
			<td>'. $result3->posisi_detail .'</td>
			<td>'. $result3->regional_name .'</td>		
			<td>'. $result3->activity .'</td>
			<td>'. $result3->pretest .'</td>		
			<td>'. $result3->duration .'</td>		
			<td>'. $result3->posttest .'</td>		
			<td>'. $result3->sertifikat .'</td>		
		</tr>	
		  ';
		  $no++;
		}
	
	  } 
	}	
  ?>	

  </tbody>
</table>

<script>	
	
//$(function () {
	$(".change1, .inner2").dblclick(function (e) {
		
			e.stopPropagation();
			var currentEle = $(this);
			var value = $(this).html();
			var idx = $(this).attr( "idx" );
			updateVal(currentEle, value, idx);
	});
//});

function updateVal(currentEle, value, idx) {
	var styleProps = $(currentEle).css(["width", "height"]);				
	console.log(styleProps);
	var width = parseInt(styleProps.width) + 20;
	//$(currentEle).html('<input class="thVal" type="text" value="' + value + '" />');
	$(currentEle).html('<textarea class="thVal" type="text" value="' + value + '" style="width: ' + width + 'px; height: ' + styleProps.height + '">'+ value +'</textarea>');
	$(".thVal").focus();
	$(".thVal").keyup(function (event) {
			if (event.keyCode == 13) {
					newVal = $(".thVal").val().trim();
					$(currentEle).html(newVal);
					if(value!=newVal){
						updateQuery(idx, newVal);
					}								
			}
	});

	$(currentEle).focusout(function () {
					newVal = $(".thVal").val().trim();
					$(currentEle).html(newVal);								
					if(value!=newVal){
						updateQuery(idx, newVal);
					}
	});
}

function updateQuery(idx, newVal){
	var data = {
		idx:idx,
		newVal:newVal
	};
	var url = '<?php echo base_url(); ?>index.php/Adminmax/updateIDjadwal';
	$('#receiver2').load(url,data, function(){
		//alert('heheh');
	});			
}
</script>
