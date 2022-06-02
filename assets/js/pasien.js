$(function () {
    var url = base_url + 'admin/Pasien/tampilPasien' 
    table2 = $('#table_pasien').DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        success: function(result) {
            console.log(result)
        console.log(result.data.length)
        
            for (var i = 0; i < result.data.length; i++) {
                status = 'Aktif'

                if (result.data[i].aktif == 0) {
                    status = 'Non-aktif'
                }

                btn1 = base_url + 'admin/Pasien/detailPasien/' + result.data[i].id
                btn2 = base_url + 'admin/Pasien/tampilEditPasien/' + result.data[i].id
                btn3 = base_url + 'admin/Pasien/hapusPasien/' + result.data[i].id
        
        button = '<div class="btn-group btn-group-sm">'+
                          '<a data-toggle="tooltip" title="Detail Data" href="' + btn1 + '" class="btn btn-info"><i class="fas fa-eye"></i></a>'+
                          '<a data-toggle="tooltip" title="Edit Data" href="' + btn2 + '" class="btn btn-success"><i class="fas fa-edit "></i></a>'+
                          '<a data-toggle="tooltip" title="Hapus Data" href="' + btn3 + '" class="btn btn-danger"><i class="fas fa-trash"></i></a>'+
                            '</div>'

        table2.row.add([
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
    $('#btn-add-pasien').click(function () {
        var url = base_url + 'admin/Pasien/addPasien'
    var url2 = base_url + 'admin/Pasien'
        var isiForm = $('#form-add-pasien').serializeArray()

        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                console.log(result)
                alert(result.message)

                if (result.message == 'Data user pasien berhasil disimpan') {
                    window.location.href = url2;
                }
            }
        })
    });

    $('#btn-edit-pasien').click(function () {
    let id = $('#id').val();

        var url = base_url + 'admin/Pasien/updatePasien/' + id 
    var url2 = base_url + 'admin/Pasien'
        var isiForm = $('#form-edit-pasien').serializeArray()
    console.log(id)
    console.log(isiForm)
        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                console.log(result)
                alert(result.message)

                if (result.message == 'Data user pasien berhasil diubah') {
                    window.location.href = url2;
                }

            }
        })

    });
    
    $('#btn-add-antrian').click(function () {
        var url = base_url + 'admin/Pasien/create_antrian_pasien'
    var url2 = base_url + 'admin/Pasien/antrian_pasien'
        var isiForm = $('#form-add-antrian').serializeArray()

        $.ajax({
            url: url,
            data: isiForm,
            type: 'POST',
            dataType: 'json',
            success: function (result) {
                console.log(result)
                alert(result.message)

                if (result.message == 'Data user pasien berhasil disimpan') {
                    window.location.href = url2;
                }
            }
        })
    });

});