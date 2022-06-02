$(function () {
    var url = base_url + 'admin/Admin/tampilAdmin' 
    table = $('#table_admin').DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        success: function(result) {
	    
            for (var i = 0; i < result.data.length; i++) {
                status = 'Aktif'

                if (result.data[i].aktif == 0) {
                    status = 'Non-aktif'
                }

                btn1 = base_url + 'admin/Admin/detailAdmin/' + result.data[i].id
                btn2 = base_url + 'admin/Admin/tampilEditAdmin/' + result.data[i].id
                btn3 = base_url + 'admin/Admin/hapusAdmin/' + result.data[i].id
		
		button = '<div class="btn-group btn-group-sm">'+
                          '<a data-toggle="tooltip" title="Detail Data" href="' + btn1 + '" class="btn btn-info"><i class="fas fa-eye"></i></a>'+
                          '<a data-toggle="tooltip" title="Edit Data" href="' + btn2 + '" class="btn btn-success"><i class="fas fa-edit "></i></a>'+
                          '<a data-toggle="tooltip" title="Hapus Data" href="' + btn3 + '" class="btn btn-danger"><i class="fas fa-trash"></i></a>'+
                            '</div>'

		table.row.add([
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
});

jQuery(document).ready(function () {
    $('#btn-add-admin').click(function () {
        var url = base_url + 'admin/Admin/addAdmin'
	var url2 = base_url + 'admin/Admin/manage_admin'
        var isiForm = $('#form-add-admin').serializeArray()

        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                alert(result.message)

                if (result.message == 'Data user admin berhasil disimpan') {
                    window.location.href = url2;
                }
            }
        })
    });

    $('#btn-edit-admin').click(function () {
	let id = $('#id').val();

        var url = base_url + 'admin/Admin/updateAdmin/' + id 
	var url2 = base_url + 'admin/Admin/manage_admin'
        var isiForm = $('#form-edit-admin').serializeArray()
//	console.log(id)
//	console.log(isiForm)
        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
//                console.log(result)
                alert(result.message)

                if (result.message == 'Data user admin berhasil diubah') {
                    window.location.href = url2;
                }

            }
        })

    });
   
        $('#btn-add-config').click(function () {
        var url = base_url + 'admin/Config/addConfig'
	var url2 = base_url + 'admin/Config'
        var isiForm = $('#form-add-config').serializeArray()

        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
//                console.log(result)
                alert(result.message)

                if (result.message == 'Konfigurasi berhasil disimpan') {
                    window.location.href = url2;
                }
            }
        })
    });

    $('#btn-edit-config').click(function () {
	let id = $('#id').val();

        var url = base_url + 'admin/Config/updateConfig/' + id 
	var url2 = base_url + 'admin/Config/poli'
        var isiForm = $('#form-edit-config').serializeArray()
//	console.log(id)
//	console.log(isiForm)
        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
//                console.log(result)
                alert(result.message)

                if (result.message == 'Konfigurasi berhasil diubah') {
                    window.location.href = url2;
                }

            }
        })

    });

	$('#btn-add-poli').click(function () {
	
        var url = base_url + 'admin/Config/addPoli'
	var url2 = base_url + 'admin/Config/poli'
        var isiForm = $('#form-add-poli').serializeArray()
//	console.log(isiForm)
        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
//                console.log(result)
                alert(result.message)

                if (result.message == 'Poli berhasil disimpan') {
                    window.location.href = url2;
                }
            }
        })
    });

    $('#btn-edit-poli').click(function () {
	let id = $('#id').val();

        var url = base_url + 'admin/Config/updatePoli/' + id 
	var url2 = base_url + 'admin/Config/poli'
        var isiForm = $('#form-edit-poli').serializeArray()
//	console.log(id)
//	console.log(isiForm)
        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
//                console.log(result)
                alert(result.message)

                if (result.message == 'Poli berhasil diubah') {
                    window.location.href = url2;
                }

            }
        })

    });


});