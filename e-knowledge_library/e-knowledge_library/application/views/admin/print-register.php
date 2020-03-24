adminmax
<table id="data" cellspacing="1" class="table table-striped  table-bordered table-hover table-hover-info">
  <tbody>
	<tr class="judul">
		<th class="center">id jadwal awal</th>
		<th class="center">id jadwal</th>
		<th class="center">id kursus</th>
		<th class="center">nip</th>
		<th class="center">nama</th>
		<th class="center">posisi detail</th>
		<th class="center">org</th>
		<th class="center">organisasi</th>
		<th class="center">regional</th>
	</tr>

  <?php 
	$no=1;
	foreach ($result as $data) {
	  $data->USER_NAME = ucwords(strtolower( $data->USER_NAME ));
	  
	  // id_jadwal_awal,id_jadwal,id_kursus,ID_USER,USER_NAME,posisi_detail,org,organisasi_name,regional_name
	  echo '
	<tr class="data2">
		<td>'. $data->id_jadwal_awal .'</td>
		<td idx="'. $data->id .'" title="Ganti Jadwal" class="change1">'. $data->id_jadwal .'</td>
		<td>'. $data->id_kursus .'</td>
		<td>'. $data->ID_USER .'</td>
		<td>'. $data->USER_NAME .'</td>
		<td>'. $data->posisi_detail .'</td>
		<td>'. $data->org .'</td>
		<td>'. $data->organisasi_name .'</td>
		<td>'. $data->regional_name .'</td>		
	</tr>	
	  ';
	  $no++;
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
