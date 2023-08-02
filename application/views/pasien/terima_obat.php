<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-12 col-12 ">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: transparent;">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard'); ?>" class="text-black">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/ResepDokter'); ?>" class="text-black">Resep Dokter</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Konfirmasi Penerimaan Obat</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-12 col-12">
                <h3 class="page-title">Konfirmasi Penerimaan Obat</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!--card diagnosa-->
                <div class="card card-5 p-2 px-4">
                    <form id="formKonsultasi_2">
                        <h3>Apakah anda yakin sudah menerima obat?</h3>
                        <p>Tekan tombol di bawah ini jika sudah menerima obat.</p>
                        <button type="button" id="btn-terima-obat" class="btn btn-primary">Ya, saya sudah menerimanya</button>
                    </form>
                    <p style="display: none;" id="id-jadwal-konsultasi"><?php echo $id_jadwal_konsultasi; ?></p>
                </div>
            </div>

            <!-- batas col-md-7 -->
        </div>
    </div>
</div>





<!-- <script type="text/javascript" src="<?php echo base_url('assets/js/conference.js'); ?>"></script> -->
<?php $foto_pasien = $pasien->foto ? base_url('assets/images/users/' . $pasien->foto) : base_url('assets/telemedicine/img/default.png'); ?>
<?php $foto_dokter = $user->foto ? base_url('assets/images/users/' . $user->foto) : base_url('assets/telemedicine/img/default.png'); ?>
<script>
    chat_locate = 'dokter';
    user_kategori = 'dokter';
    id_pasien = <?php echo $pasien->id ?>;
    id_dokter = <?php echo $user->id ?>;
    foto_pasien = '<?php echo $foto_pasien ?>';
    foto_dokter = '<?php echo $foto_dokter ?>';
</script>

<script>
    var btnTerimaObat = document.getElementById('btn-terima-obat');
    const id_jadwal_konsultasi = document.getElementById('id-jadwal-konsultasi').innerText;
    btnTerimaObat.addEventListener('click', function (e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: baseUrl + "pasien/ResepDokter/terima_obat",
            data: { id_jadwal_konsultasi: id_jadwal_konsultasi},
            success: function (data) {
                alert('Berhasil mengkonfirmasi penerimaan obat.');
                location.reload()
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
    });
});
</script>


<script>
    function resizeInput() {
        $(this).attr('size', $(this).val().length);
    }
    $('input[type="text"]')
        .keyup(resizeInput)
        .each(resizeInput);

    $('input[type="number"]')
        .keyup(resizeInput)
        .each(resizeInput);
</script>

<script>
    function obat_onchange() {
        var obat = document.getElementById('obat');
        var satuan = document.getElementById('obat-' + obat.value);
        var satuan_obat_hidden = document.getElementById('satuan_obat');

        var satuan_show = document.getElementById('unit');

        satuan_show.placeholder = "Jml (" + satuan.innerHTML + ")";
        satuan_obat_hidden.value = satuan.innerHTML;
    }
</script>
<div class="sidebar-overlay" data-reff=""></div>
<style>
    .images-upload>input {
        display: none;
    }

    .images-upload>img {
        cursor: pointer;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>