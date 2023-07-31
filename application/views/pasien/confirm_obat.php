<!-- Main content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row mb-3">
            <div class="col-sm-12 col-12 ">
                <nav aria-label="">
                    <ol class="breadcrumb" style="background-color: transparent;">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('dokter/Dashboard'); ?>" class="text-black">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url('pasien/ResepDokter'); ?>" class="text-black">Resep Dokter</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="" class="text-black font-bold-7">Konfirmasi Pembelian Obat</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-12 col-12">
                <h3 class="page-title">Konfirmasi Pembelian Obat</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!--card diagnosa-->
                <div class="card card-5 p-2 px-4">
                    <form id="formKonsultasi_2">
                        <div class="row">
                            <div class="col-md-9">
                                <p class="font-12">Resep</p>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive p-3">
                                <table class="table table-border table-hover custom-table mb-0" id="table-obat">
                                    <thead class="font-12">
                                        <tr class="text-abu">
                                            <td>Nama Obat</td>
                                            <td>Jumlah</td>
                                            <td>Harga</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody id="listResep">
                                            <?php for ($i = 0; $i < count($list_obat); $i++) { ?>
                                            <tr>
                                                <td><?php echo $list_obat[$i]['nama_obat'] ?></td>
                                                <td><?php echo $list_obat[$i]['jumlah'] ?></td>
                                                <td><?php echo $list_obat[$i]['harga'] ?></td>
                                            </tr> 
                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="resepDokter">
                            </div>
                        </div>
                        <button type="button" id="btn-konfirmasi-obat" class="btn btn-primary">Konfirmasi</button>
                    </form>
                    <p id="total">Total Biaya: <?php echo $total_biaya; ?></p>
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
    var btnKonfirmasiObat = $('#btn-konfirmasi-obat');
    const id_jadwal_konsultasi = <?php $data['id_jadwal_konsultasi'];
    btnKonfirmasiObat.click(function (e) {
        $.ajax({
        method: 'POST',
        url: baseUrl + "ResepDokter/batalkan_pembelian_obat",
        data: { id_obat: id_obat, id_jadwal_konsultasi: id_jadwal_konsultasi},
        success: function (data) {
        console.log(data);
        },
        error: function (data) {
            console.log(data)
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