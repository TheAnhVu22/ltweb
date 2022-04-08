var mangtien = [0];
var Tongsp = 0;
$(document).ready(function (){
	$.post("demsp.php",function(data){
		Tongsp = data;
		for(i=1;i<=Tongsp;i++){
		mangtien[i] = 0;
		}
	});
});
$('.soluong').keyup(function(){
	var tongtien = 0;
	var masp = $(this).attr('id');
	var soluong = $('#'+masp).val();
	if($.trim(soluong).length == 0){
		mangtien[masp] = 0;
		$('#thanhtien'+masp).html("");
	}
	else{
		if(soluong.match(/^\d+(?:\.\d+)?$/)){
			$.ajax({
				type: 'POST',
				async: false,  //xử lý không đồng bộ
				url: 'calTotal.php',
				data: 'soluong='+soluong+"&current_id="+masp,
				success: function(data){
					$('#thanhtien'+masp).html(data);
					mangtien[masp] = parseFloat(data);
				}
			});
		}
		else{
			$('#thanhtien'+masp).html("chỉ được nhập số");
		}
	}
	for(i=1;i<=Tongsp;i++){
		tongtien = parseFloat(tongtien + mangtien[i]);
	}

	//set tổng tiền vào #, chuyển về string vs 2 số sau dấu phẩy
	$('#txtFinalAmount').val(tongtien.toFixed(2));
});