SELECT reg.id as registrasi_id, reg.keterangan, reg.id_status_pembayaran, reg.id_pasien, d.name as nama_dokter, p.poli, d.id as id_dokter, p.id as jadwal_id, nominal.biaya_adm as biaya_adm_poli, bukti_pembayaran.biaya_adm as biaya_adm_bukti, bukti_pembayaran.expired_date, bukti_pembayaran.id_payment, nominal.harga as biaya_konsultasi_poli,bukti_pembayaran.biaya_konsultasi as biaya_konsultasi_bukti, jk.tanggal as tanggal_konsultasi, jk.jam as waktu_konsultasi, bukti_pembayaran.va_number 
FROM data_registrasi reg 

INNER JOIN jadwal_dokter p ON reg.id_jadwal=p.id 
INNER JOIN master_user d ON p.id_dokter = d.id 
INNER JOIN detail_dokter ON d.id = detail_dokter.id_dokter 
INNER JOIN nominal ON nominal.id = detail_dokter.id_poli 
INNER JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = reg.id LEFT JOIN jadwal_konsultasi jk ON reg.id = jk.id_registrasi 

WHERE reg.id = "123456789-00023-20230726045523" AND reg.id_status_pembayaran = 0 AND bukti_pembayaran.status = 0 AND reg.id_pasien = 646 AND bukti_pembayaran.metode_pembayaran = 3

switch ($bank_id) {
            case 22:
                $bank_name = 'Permata';
                $bank_logo = 'permata.png';
                break;
            case 28:
                $bank_name = 'BNI';
                $bank_logo = 'bni.png';
                break;
            case 37:
                $bank_name = 'CIMB';
                $bank_logo = 'cimb.png';
                break;
            default:
                $bank_name = '';
                $bank_logo = '';
                show_404();
                break;
        }

        $data['data_bank'] = array(
            'nama_bank' => $bank_name,
            'logo_bank' => $bank_logo,
        );