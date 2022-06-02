function Jawab(){
	$.ajax({
              method : 'POST',
              url    : baseUrl+"Conference/jawab",
              data   : {id_dokter:loadData},
              success : function(data){                             	
                if(data){
                  location.href = baseUrl+"pasien/Telekonsultasi/konsultasi";
                }else{
                  console.log("tidak bisa menjawab");       
                }
              },
              error : function(data){
                 alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
              }
              

            });   
}