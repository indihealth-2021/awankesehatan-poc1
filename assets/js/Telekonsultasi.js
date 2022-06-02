function call(){
	$.ajax({
		method : 'POST',
		url    : baseUrl+"Conference/call",
		data   : {reg:id},
		success : function(data){
			console.log(data);			
		},
		error : function(data){
			 alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
		}
		

	});
}