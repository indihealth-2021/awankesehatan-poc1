$(function () {
    var url = '/admin/Dokter/tampilDokter';

    table1 = $('#table_dokter').DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        success: function(result) {
            // console.log(result)
	    // console.log(result.data.length)
	    
            for (var i = 0; i < result.data.length; i++) {
                status = 'Aktif'

                if (result.data[i].aktif == 0) {
                    status = 'Non-aktif'
                }

                btn1 = base_url + 'admin/Dokter/detailDokter/' + result.data[i].id
                btn2 = base_url + 'admin/Dokter/tampilEditDokter/' + result.data[i].id
                btn3 = base_url + 'admin/Dokter/hapusDokter/' + result.data[i].id
		
		button = '<div class="btn-group btn-group-sm">'+
                          '<a data-toggle="tooltip" title="Detail Data" href="' + btn1 + '" class="btn btn-info"><i class="fas fa-eye"></i></a>'+
                          '<a data-toggle="tooltip" title="Edit Data" href="' + btn2 + '" class="btn btn-success"><i class="fas fa-edit "></i></a>'+
                          '<a data-toggle="tooltip" title="Hapus Data" href="' + btn3 + '" class="btn btn-danger"><i class="fas fa-trash"></i></a>'+
                            '</div>'

		table1.row.add([
			(i+1),
			result.data[i].name,
			result.data[i].email,
			result.data[i].telp,
			status,
			button
		]).draw(false);
            }
        }
    });

    var urlJadwalDokter = base_url + 'admin/Dokter/tampil_jadwalDokter'
    
    tableJadwalDokter = $('#table_jadwal_dokter').DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $.ajax({
        url: urlJadwalDokter,
        type: 'GET',
        dataType: 'JSON',
        success: function(result) {
            // console.log(result)
	    // console.log(result.data.length)
	    
            for (var i = 0; i < result.data.length; i++) {
                status = 'Aktif'

                if (result.data[i].aktif == 0) {
                    status = 'Non-aktif'
                }

                btn1 = base_url + 'admin/Dokter/detail_jadwalDokter/' + result.data[i].id
                btn2 = base_url + 'admin/Dokter/tampilEdit_jadwalDokter/' + result.data[i].id
                btn3 = base_url + 'admin/Dokter/hapus_jadwalDokter/' + result.data[i].id
		
		button = '<div class="btn-group btn-group-sm">'+
                          '<a data-toggle="tooltip" title="Edit Jadwal" href="' + btn2 + '" class="btn btn-success"><i class="fas fa-edit "></i></a>'+
                          '<a data-toggle="tooltip" title="Hapus Jadwal" href="' + btn3 + '" class="btn btn-danger"><i class="fas fa-trash"></i></a>'+
                            '</div>'

		tableJadwalDokter.row.add([
			(i+1),
			result.data[i].name,
			result.data[i].poli,
			result.data[i].tanggal,
			result.data[i].waktu,
			button
		]).draw(false);
            }
        }
    });
});

jQuery(document).ready(function () {
    $('#btn-add-dokter').click(function () {
        var url = base_url + 'admin/Dokter/addDokter'
	var url2 = base_url + 'admin/Dokter'
        var isiForm = $('#form-add-dokter').serializeArray()

        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                // console.log(result)
                alert(result.message)

                if (result.message == 'Data user dokter berhasil disimpan') {
                    window.location.href = url2;
                }
            }
        })
    });

    $('#btn-edit-dokter').click(function () {
	let id = $('#id').val();

        var url = base_url + 'admin/Dokter/updateDokter/' + id 
	var url2 = base_url + 'admin/Dokter'
        var isiForm = $('#form-edit-dokter').serializeArray()
	// console.log(id)
	// console.log(isiForm)
        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                // console.log(result)
                alert(result.message)

                if (result.message == 'Data user dokter berhasil diubah') {
                    window.location.href = url2;
                }

            }
        })

    });

    $('#btn-add-jadwalDokter').click(function () {
        var url = base_url + 'admin/Dokter/addJadwalDokter'
	var url2 = base_url + 'admin/Dokter/jadwal_dokter'
        var isiForm = $('#form-add-jadwalDokter').serializeArray()
	// console.log(isiForm )
        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                // console.log(result)
                alert(result.message)

                if (result.message == 'Jadwal dokter berhasil disimpan') {
                    window.location.href = url2;
                }
            }
        })
    });

    $('#btn-edit-jadwalDokter').click(function () {
	let id = $('#id').val();

        var url = base_url + 'admin/Dokter/updateJadwalDokter/' + id 
	var url2 = base_url + 'admin/Dokter/jadwal_dokter'
        var isiForm = $('#form-edit-jadwalDokter').serializeArray()
	// console.log('id : ' + id)
	// console.log(isiForm)
        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                // console.log(result)
                alert(result.message)

                if (result.message == 'Jadwal dokter berhasil diubah') {
                    window.location.href = url2;
                }

            }
        })

    });

});

function setDay(number) {
        let tanggal = $('#tanggal').val();
	// console.log(tanggal)
	
	let dt = new Date(tanggal);
	let day = dt.getDay();
	
	if(day == 1){	
		document.getElementById("hari").value = "Senin";
	}else if(day == 2){	
		document.getElementById("hari").value = "Selasa";
	}else if(day == 3){	
		document.getElementById("hari").value = "Rabu";
	}else if(day == 4){	
		document.getElementById("hari").value = "Kamis";
	}else if(day == 5){	
		document.getElementById("hari").value = "Jum'at";
	}else if(day == 6){	
		document.getElementById("hari").value = "";
		alert("Jadwal tidak bisa dibuat pada hari Sabtu")
	}else{
		document.getElementById("hari").value = "";
		alert("Jadwal tidak bisa dibuat pada hari Minggu")
	}
    }