$("#saveBiayaPengiriman").click((e) => {
    if(modal.find("textarea[name=alamat]").val()) {

    }else {

    }
});
$("#saveBiayaPengiriman").click(function(e){
    if(modal.find("textarea[name=alamat]").val()){
        $.ajax({
        method : "POST",
        url    : baseUrl+"admin/PengirimanObat/submit_biaya_pengiriman",
        data   : {
        biaya_pengiriman:modal.find("#biaya-pengiriman").val(),
        id_jadwal_konsultasi:modal.find("#id_jadwal_konsultasi").val(),
        alamat_kustom:modal.find("input[name=alamat_kustom]:checked").val(),
        alamat:modal.find("#alamat").val(),
        _csrf:modal.find("input[name=_csrf]").val()},
        success : function(data){
        console.log(data);
        data = JSON.parse(data);
        if(data.status == "OK"){
            var biaya_pengiriman_rp = formatRupiah(modal.find("#biaya-pengiriman").val(), "Rp. ");
            biaya_pengiriman_rp = biaya_pengiriman_rp.replace(",00","");
            var total_harga = parseInt(modal.find("#biaya-pengiriman").val())+parseInt(button.parent().find(".btnSubmit").data("harga-obat"));
            var total_harga_rp = formatRupiah(total_harga.toString(), "Rp. ");
            total_harga_rp = total_harga_rp.replace(",00","");
            document.getElementById("biaya-pengiriman-"+modal.find("#id_jadwal_konsultasi").val()).innerHTML = modal.find("#biayaPengirimanHelp").html()+",00";

            button.parent().find(".btnSubmit").data("biaya-pengiriman", modal.find("#biaya-pengiriman").val());
            button.parent().find(".btnEdit").data("biaya-pengiriman", modal.find("#biaya-pengiriman").val());

            button.parent().find(".btnSubmit").data("biaya-pengiriman-rp", biaya_pengiriman_rp);
            button.parent().find(".btnEdit").data("biaya-pengiriman-rp", biaya_pengiriman_rp);

            button.parent().find(".btnSubmit").data("alamat", modal.find("#alamat").val());

            if(modal.find("input[name=alamat_kustom]:checked").val() == 1){
            button.parent().find(".btnEdit").data("alamat-kustom", modal.find("#alamat").val());
            button.parent().find(".btnEdit").data("is-alamat-kustom", 1);
            }
            else{
            button.parent().find(".btnEdit").data("is-alamat-kustom", 0);
            }

            button.parent().find(".btnSubmit").data("total-harga", total_harga);
            button.parent().find(".btnSubmit").data("total-harga-rp", total_harga_rp);
            modal.modal("hide");
            if(data.jml_edit == 1){
            alert("SUKSES: Data berhasil disimpan!");
            }
            else{
            alert("SUKSES: Data telah disimpan "+data.jml_edit+"x!");
            }
        }else{
            alert("GAGAL: Pastikan data yang anda isi lengkap!");
            console.log(data);
        }
    },error : function(data){
        alert("Terjadi kesalahan sistem, silahkan hubungi administrator."+JSON.stringify(data));
    }});}
    else{
        alert("GAGAL: Data Tidak Lengkap!");
    }
});
