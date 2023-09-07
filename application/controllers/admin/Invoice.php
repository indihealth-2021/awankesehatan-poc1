<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    var $menu = 4;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->library('all_controllers');
        $this->load->library('my_pagination');
    }

    public function invoice_owlexa_konsultasi()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Laporan Faktur Konsultasi",
            $view = "admin/invoice_owlexa_konsultasi"
        );

        $from = $this->input->get('from');
        $to = $this->input->get('to');
        if (!$from || !$to) {
            $between = '';
        } else {
            $from = explode("/", $from);
            $from = implode("-", $from);
            $from = new DateTime($from);
            $from = $from->format("Y-m-d");
            $to = explode("/", $to);
            $to = implode("-", $to);
            $to = new DateTime($to);
            $to = $to->format('Y-m-d');
            $between = ' AND (bukti_pembayaran.created_at BETWEEN "' . $from . ' 00:00:00" AND "' . $to . ' 23:59:59")';
        }
        $data['list_pembayaran'] = $this->_get_pembayaran_konsultasi($between);
        $data['master_web'] = $this->db->query('SELECT * FROM master_web')->row();
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('https://code.jquery.com/jquery-3.5.1.js') . '"></script>
                                <script src="' . base_url('https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js') . '"></script>
                                
                                <script>
                                $(document).ready(function () {
                                  var table_faktur = $("#table_faktur").DataTable({
                                    "scrollX": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                  });
                                  $("#table_faktur_filter").remove();
								  $("#search").on("keyup", function(e){
									table_faktur.search($(this).val()).draw();
								  });

                                    $("#modalHapus").on("show.bs.modal", function(e) {
                                        var nama = $(e.relatedTarget).data("nama");
                                        $(e.currentTarget).find("#nama").html(nama);

                                        var href_input = $(e.relatedTarget).data("href");
                                        $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                    });
                                });
                              </script>';
        $this->load->view('template', $data);
    }

    public function export_to_pdf_owlexa_obat()
    {
        $this->all_controllers->check_user_admin();

        $from = $this->input->get('from');
        $to = $this->input->get('to');
        if (!$from || !$to) {
            $between = '';
            $tanggal = '';
        } else {
            $from = explode("/", $from);
            $from = implode("-", $from);
            $from = new DateTime($from);
            $fromIndo = $from->format('d/m/Y');
            $from = $from->format("Y-m-d");
            $to = explode("/", $to);
            $to = implode("-", $to);
            $to = new DateTime($to);
            $toIndo = $to->format('d/m/Y');
            $to = $to->format('Y-m-d');
            $tanggal = ' (' . $fromIndo . ' - ' . $toIndo . ' )';
            $between = ' AND (bpo.created_at BETWEEN "' . $from . ' 00:00:00" AND "' . $to . ' 23:59:59")';
        }

        $list_pembayaran = $this->_get_pembayaran_obat($between);
        if (!$list_pembayaran) {
            $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Data kosong tidak dapat diexport!');
            redirect(base_url('admin/Invoice/invoice_owlexa_obat'));
        }

        $data_view = array(
            "tanggal" => $tanggal,
            "list_pembayaran" => $list_pembayaran,
            "view" => "admin/pdf_invoice_owlexa_obat",
            "title" => "Laporan Obat Owlexa"
        );

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "Invoice Obat Dokter Owlexa Telemedicine Lintasarta" . implode('_', explode('/', $tanggal)) . ".pdf";
        $this->pdf->load_view('template_invoice', $data_view);
        // $this->load->view('admin/pdf_invoice_owlexa_obat');
    }
    public function export_to_pdf_owlexa_konsultasi()
    {
        $this->all_controllers->check_user_admin();

        $from = $this->input->get('from');
        $to = $this->input->get('to');
        if (!$from || !$to) {
            $between = '';
            $tanggal = '';
        } else {
            $from = explode("/", $from);
            $from = implode("-", $from);
            $from = new DateTime($from);
            $fromIndo = $from->format('d/m/Y');
            $from = $from->format("Y-m-d");
            $to = explode("/", $to);
            $to = implode("-", $to);
            $to = new DateTime($to);
            $toIndo = $to->format('d/m/Y');
            $to = $to->format('Y-m-d');
            $tanggal = ' ( ' . $fromIndo . ' - ' . $toIndo . ' )';
            $between = ' AND (bukti_pembayaran.created_at BETWEEN "' . $from . ' 00:00:00" AND "' . $to . ' 23:59:59")';
        }

        $list_pembayaran = $this->_get_pembayaran_konsultasi($between);
        $master_web = $this->db->query('SELECT * FROM master_web')->row();
        if (!$list_pembayaran) {
            $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Data kosong tidak dapat diexport!');
            redirect(base_url('admin/Invoice/invoice_owlexa_konsultasi'));
        }
        $data_view = array(
            "tanggal" => $tanggal,
            "list_pembayaran" => $list_pembayaran,
            "master_web" => $master_web,
            "view" => "admin/pdf_invoice_owlexa_konsultasi",
            "title" => "Laporan Konsultasi Owlexa"
        );

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "Invoice Konsultasi Dokter Owlexa Telemedicine Lintasarta" . implode('_', explode('/', $tanggal)) . ".pdf";
        $this->pdf->load_view('template_invoice', $data_view);
        // $this->load->view('admin/pdf_invoice_owlexa_konsultasi');
    }

    public function export_to_excel_owlexa_konsultasi()
    {
        $this->all_controllers->check_user_admin();

        $from = $this->input->get('from');
        $to = $this->input->get('to');
        if (!$from || !$to) {
            $between = '';
            $tanggal = '';
        } else {
            $from = explode("/", $from);
            $from = implode("-", $from);
            $from = new DateTime($from);
            $fromIndo = $from->format('d/m/Y');
            $from = $from->format("Y-m-d");
            $to = explode("/", $to);
            $to = implode("-", $to);
            $to = new DateTime($to);
            $toIndo = $to->format('d/m/Y');
            $to = $to->format('Y-m-d');
            $tanggal = ' ( ' . $fromIndo . ' - ' . $toIndo . ' )';
            $between = ' AND (bukti_pembayaran.created_at BETWEEN "' . $from . ' 00:00:00" AND "' . $to . ' 23:59:59")';
        }

        $list_pembayaran = $this->_get_pembayaran_konsultasi($between);
        $master_web = $this->db->query('SELECT * FROM master_web')->row();
        if (!$list_pembayaran) {
            $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Data kosong tidak dapat diexport!');
            redirect(base_url('admin/Invoice/invoice_owlexa_konsultasi'));
        }

        // ========================================== EXPORT TO EXCEL ===============================//
        require(APPPATH . 'helpers/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'helpers/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $excel = new PHPExcel();

        $style_header = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_body = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->getProperties()->setCreator('Telemedicine Lintasarta')
            ->setLastModifiedBy('Telemedicine Lintasarta')
            ->setTitle('Invoice Konsultasi Owlexa Telemedicine Lintasarta');

        $excel->setActiveSheetIndex(0)->setCellValue('A1', 'Invoice Konsultasi Owlexa Telemedicine Lintasarta' . $tanggal);
        $excel->getActiveSheet()->mergeCells('A1:W3');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A4', "No");
        $excel->setActiveSheetIndex(0)->setCellValue('B4', "Claim Number");
        $excel->setActiveSheetIndex(0)->setCellValue('C4', "Telemedicine Trans Number");
        $excel->setActiveSheetIndex(0)->setCellValue('D4', "Transaction Time");
        $excel->setActiveSheetIndex(0)->setCellValue('E4', "Card Number");
        $excel->setActiveSheetIndex(0)->setCellValue('F4', "Member Name");
        $excel->setActiveSheetIndex(0)->setCellValue('G4', "Diagnosis Code");
        $excel->setActiveSheetIndex(0)->setCellValue('H4', "Diagnosis Name");
        $excel->setActiveSheetIndex(0)->setCellValue('I4', "Admission Date");
        $excel->setActiveSheetIndex(0)->setCellValue('J4', "Charged Date");
        $excel->setActiveSheetIndex(0)->setCellValue('K4', "Type of Service");
        $excel->setActiveSheetIndex(0)->setCellValue('L4', "Provider Name");
        $excel->setActiveSheetIndex(0)->setCellValue('M4', "Doctor Name");
        $excel->setActiveSheetIndex(0)->setCellValue('N4', "Doctor Speciality");
        $excel->setActiveSheetIndex(0)->setCellValue('O4', "Claim Type");
        $excel->setActiveSheetIndex(0)->setCellValue('P4', "Benefit Description");
        $excel->setActiveSheetIndex(0)->setCellValue('Q4', "Charge Benefit Item");
        $excel->setActiveSheetIndex(0)->setCellValue('R4', "Approved Benefit Item");
        $excel->setActiveSheetIndex(0)->setCellValue('S4', "Excess Benefit Item");
        $excel->setActiveSheetIndex(0)->setCellValue('T4', "Pre Paid Excess Item");
        $excel->setActiveSheetIndex(0)->setCellValue('U4', "Paid To Provider Item");
        $excel->setActiveSheetIndex(0)->setCellValue('V4', "Claim Remarks");
        $excel->setActiveSheetIndex(0)->setCellValue('W4', "Status");

        $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('H4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('I4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('J4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('K4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('L4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('M4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('N4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('O4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('P4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('Q4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('R4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('S4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('T4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('U4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('V4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('W4')->applyFromArray($style_header);

        $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);

        $numrow = 5;
        foreach ($list_pembayaran as $idx => $pembayaran) {
            $pembayaran->tanggal_pembayaran = new DateTime($pembayaran->tanggal_pembayaran);
            $charged_date = $pembayaran->tanggal_pembayaran->format('d/m/Y');
            $admission_date = $pembayaran->tanggal_pembayaran->format('d/m/Y');
            $pembayaran->tanggal_pembayaran = $pembayaran->tanggal_pembayaran->format('d/m/Y H:i:s');

            $biaya_adm = $pembayaran->biaya_adm ? $pembayaran->biaya_adm : 0;
            $biaya_adm = 'Rp. ' . number_format($biaya_adm, 2, ',', '.');

            $biaya_konsultasi = $pembayaran->biaya_konsultasi ? $pembayaran->biaya_konsultasi : 0;
            $biaya_konsultasi = 'Rp. ' . number_format($biaya_konsultasi, 2, ',', '.');

            $pembayaran->harga_poli = 'Rp. ' . number_format($pembayaran->harga_poli, 2, '.', ',');
            $master_web->harga_adm = 'Rp. ' . number_format((float)$master_web->harga_adm, 2, '.', ',');

            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $idx + 1);
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('B' . $numrow, $pembayaran->claim_number, PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $pembayaran->id_registrasi);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $pembayaran->tanggal_pembayaran);
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('E' . $numrow, $pembayaran->card_number, PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $pembayaran->nama_pasien);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $pembayaran->diagnosis_code);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $pembayaran->diagnosis_name);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $admission_date);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $charged_date);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, 'OUTPATIENT');
            $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Azra Testing');
            $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $pembayaran->nama_dokter);
            $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $pembayaran->nama_poli);
            $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, 'CASHLESS');
            $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, 'Konsultasi Dokter');
            $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $biaya_konsultasi);
            $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, $biaya_konsultasi);
            $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, '0');
            $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, '0');
            $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $biaya_konsultasi);
            $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, ''); //'EXCESS DIBAYAR DI TEMPAT');
            $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, 'PAID');

            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_body);

            $numrow += 1;
            $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, 'Biaya Admin');
            $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $biaya_adm);
            $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, $biaya_adm);
            $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, '0');
            $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, '0');
            $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $biaya_adm);
            $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, '');
            $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, 'PAID');

            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_body);

            $numrow += 1;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle('Invoice Konsultasi Owlexa');
        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheethtml.sheet');
        header('Content-Disposition: attachment; filename="Invoice Konsultasi Dokter Owlexa Telemedicine Lintasarta' . $tanggal . '.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function invoice_owlexa_obat()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Laporan Faktur Obat",
            $view = "admin/invoice_owlexa_obat"
        );

        $from = $this->input->get('from');
        $to = $this->input->get('to');
        if (!$from || !$to) {
            $between = '';
            $tanggal = '';
        } else {
            $from = explode("/", $from);
            $from = implode("-", $from);
            $from = new DateTime($from);
            $fromIndo = $from->format('d/m/Y');
            $from = $from->format("Y-m-d");
            $to = explode("/", $to);
            $to = implode("-", $to);
            $to = new DateTime($to);
            $toIndo = $to->format('d/m/Y');
            $to = $to->format('Y-m-d');
            $tanggal = ' ( ' . $fromIndo . ' - ' . $toIndo . ' )';
            $between = ' AND (bpo.created_at BETWEEN "' . $from . ' 00:00:00" AND "' . $to . ' 23:59:59")';
        }
        $data['list_pembayaran'] = $this->_get_pembayaran_obat($between);
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('https://code.jquery.com/jquery-3.5.1.js') . '"></script>
                                <script src="' . base_url('https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js') . '"></script>
                                <script>
                                $(document).ready(function () {
                                var table_faktur = $("#table_faktur").DataTable({
                                    "scrollX": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                });
                                $("#table_faktur_filter").remove();
                                $("#search").on("keyup", function(e){
                                  table_faktur.search($(this).val()).draw();
                                });

                                    $("#modalHapus").on("show.bs.modal", function(e) {
                                        var nama = $(e.relatedTarget).data("nama");
                                        $(e.currentTarget).find("#nama").html(nama);

                                        var href_input = $(e.relatedTarget).data("href");
                                        $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                    });
                                });
                            </script>';
        $this->load->view('template', $data);
    }

    public function export_to_excel_owlexa_obat()
    {
        $this->all_controllers->check_user_admin();

        $from = $this->input->get('from');
        $to = $this->input->get('to');
        if (!$from || !$to) {
            $between = '';
            $tanggal = '';
        } else {
            $from = explode("/", $from);
            $from = implode("-", $from);
            $from = new DateTime($from);
            $fromIndo = $from->format('d/m/Y');
            $from = $from->format("Y-m-d");
            $to = explode("/", $to);
            $to = implode("-", $to);
            $to = new DateTime($to);
            $toIndo = $to->format('d/m/Y');
            $to = $to->format('Y-m-d');
            $tanggal = ' ( ' . $fromIndo . ' - ' . $toIndo . ' )';
            $between = ' AND (bpo.created_at BETWEEN "' . $from . ' 00:00:00" AND "' . $to . ' 23:59:59")';
        }

        $list_pembayaran = $this->_get_pembayaran_obat($between);
        if (!$list_pembayaran) {
            $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Data kosong tidak dapat diexport!');
            redirect(base_url('admin/Invoice/invoice_owlexa_obat'));
        }

        // ========================================== EXPORT TO EXCEL ===============================//
        require(APPPATH . 'helpers/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'helpers/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $excel = new PHPExcel();

        $style_header = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_body = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->getProperties()->setCreator('Telemedicine Lintasarta')
            ->setLastModifiedBy('Telemedicine Lintasarta')
            ->setTitle('Invoice Obat Owlexa Telemedicine Lintasarta');

        $excel->setActiveSheetIndex(0)->setCellValue('A1', 'Invoice Obat Owlexa Telemedicine Lintasarta' . $tanggal);
        $excel->getActiveSheet()->mergeCells('A1:X3');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A4', "No");
        $excel->setActiveSheetIndex(0)->setCellValue('B4', "Claim Number");
        $excel->setActiveSheetIndex(0)->setCellValue('C4', "Telemedicine Trans Number");
        $excel->setActiveSheetIndex(0)->setCellValue('D4', "Transaction Time");
        $excel->setActiveSheetIndex(0)->setCellValue('E4', "Card Number");
        $excel->setActiveSheetIndex(0)->setCellValue('F4', "Member Name");
        $excel->setActiveSheetIndex(0)->setCellValue('G4', "Diagnosis Code");
        $excel->setActiveSheetIndex(0)->setCellValue('H4', "Diagnosis Name");
        $excel->setActiveSheetIndex(0)->setCellValue('I4', "Admission Date");
        $excel->setActiveSheetIndex(0)->setCellValue('J4', "Charged Date");
        $excel->setActiveSheetIndex(0)->setCellValue('K4', "Type of Service");
        $excel->setActiveSheetIndex(0)->setCellValue('L4', "Provider Name");
        $excel->setActiveSheetIndex(0)->setCellValue('M4', "Claim Type");
        $excel->setActiveSheetIndex(0)->setCellValue('N4', "Shipping Address");
        $excel->setActiveSheetIndex(0)->setCellValue('O4', "Benefit Description");
        $excel->setActiveSheetIndex(0)->setCellValue('P4', "Charge Benefit Item");
        $excel->setActiveSheetIndex(0)->setCellValue('Q4', "Approved Benefit Item");
        $excel->setActiveSheetIndex(0)->setCellValue('R4', "Excess Benefit Item");
        $excel->setActiveSheetIndex(0)->setCellValue('S4', "Pre Paid Excess Item");
        $excel->setActiveSheetIndex(0)->setCellValue('T4', "Paid To Provider Item");
        $excel->setActiveSheetIndex(0)->setCellValue('U4', "Claim Remarks");
        $excel->setActiveSheetIndex(0)->setCellValue('V4', "Status");
        $excel->setActiveSheetIndex(0)->setCellValue('W4', "Order Status");

        $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('H4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('I4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('J4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('K4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('L4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('M4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('N4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('O4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('P4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('Q4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('R4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('S4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('T4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('U4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('V4')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('W4')->applyFromArray($style_header);

        $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);

        $numrow = 5;
        foreach ($list_pembayaran as $idx => $pembayaran) {
            $order_status = $pembayaran->order_status == 1 ? 'DELIVERED' : 'PENDING';

            $pembayaran->tanggal_pembayaran = new DateTime($pembayaran->tanggal_pembayaran);
            $charged_date = $pembayaran->tanggal_pembayaran->format('d/m/Y');
            $admission_date = $pembayaran->tanggal_pembayaran->format('d/m/Y');
            $pembayaran->tanggal_pembayaran = $pembayaran->tanggal_pembayaran->format('d/m/Y H:i:s');

            // HITUNG TOTAL HARGA
            $list_harga_obat = explode(',', $pembayaran->harga_obat);
            $list_harga_obat_per_n_unit = explode(',', $pembayaran->harga_obat_per_n_unit);
            $list_jumlah_obat = explode(',', $pembayaran->jumlah_obat);
            $jml_data = count($list_harga_obat);
            $list_total_harga = [];
            $total_harga = 0;
            for ($i = 0; $i < $jml_data; $i++) {
                $list_total_harga[$i] = ($list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i]) * $list_harga_obat[$i];
            }

            foreach ($list_total_harga as $tot_harga) {
                $total_harga += $tot_harga;
            }
            // -- //

            $list_nama_obat = explode('|', $pembayaran->nama_obat);
            $list_tipe_obat = explode(',', $pembayaran->tipe_obat);
            $list_jumlah_obat = explode(',', $pembayaran->jumlah_obat);

            $total_harga = 'Rp. ' . number_format($total_harga, 2, '.', ',');
            $pembayaran->biaya_pengiriman = 'Rp. ' . number_format((float)$pembayaran->biaya_pengiriman, 2, '.', ',');

            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $idx + 1);
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('B' . $numrow, $pembayaran->claim_number, PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $pembayaran->id_registrasi);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $pembayaran->tanggal_pembayaran);
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('E' . $numrow, $pembayaran->card_number, PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $pembayaran->nama_pasien);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $pembayaran->diagnosis_code);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $pembayaran->diagnosis_name);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $admission_date);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $charged_date);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, 'OUTPATIENT');
            $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Azra Testing');
            $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, 'CASHLESS');
            $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $pembayaran->alamat_pengiriman);
            $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, 'Obat-Obatan');
            $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, $total_harga);
            $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $total_harga);
            $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, '0');
            $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, '0');
            $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, $total_harga);
            $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, ''); //'EXCESS DIJAMINKAN DAHULU');
            $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, 'PAID');
            $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, $order_status);

            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_body);

            for ($i = 0; $i < $jml_data; $i++) {
                $numrow += 1;
                $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, '    ' . $list_nama_obat[$i] . ' ( ' . $list_jumlah_obat[$i] . ' ' . $list_tipe_obat[$i] . ' )');
                $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, 'Rp. ' . number_format($list_total_harga[$i], 2, '.', ','));
                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_body);
                $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_body);
            }
            $numrow += 1;

            $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, 'Biaya Pengiriman');
            $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, $pembayaran->biaya_pengiriman);
            $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $pembayaran->biaya_pengiriman);
            $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, '0');
            $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, '0');
            $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, $pembayaran->biaya_pengiriman);
            $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, ''); //'EXCESS DIJAMINKAN DAHULU');
            $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, 'PAID');
            $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, $order_status);

            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_body);

            $numrow += 1;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle('Invoice Obat Owlexa');
        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheethtml.sheet');
        header('Content-Disposition: attachment; filename="Invoice Obat Dokter Owlexa Telemedicine Lintasarta' . $tanggal . '.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function invoice_diagnosa_terbanyak()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Laporan 10 Diagnosa Terbanyak",
            $view = "admin/invoice_diagnosa_terbanyak"
        );

        if (isset($_GET['poli'])) {
            if (!empty(trim($_GET['poli']))) {
                $poli = '= ' . $_GET['poli'];
            } else {
                $poli = 'IS NOT NULL';
            }
        } else {
            $poli = 'IS NOT NULL';
        }

        if (isset($_GET['dokter'])) {
            if (!empty(trim($_GET['dokter']))) {
                $dokter = '= ' . $_GET['dokter'];
            } else {
                $dokter = 'IS NOT NULL';
            }
        } else {
            $dokter = 'IS NOT NULL';
        }

        if (isset($_GET['from'])) {
            if (!empty(trim($_GET['from'])) && !empty(trim($_GET['to']))) {
                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $from = (new DateTime($from))->format('Y-m-d');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $to = (new DateTime($to))->format('Y-m-d');
                $tanggal_konsultasi = 'BETWEEN "' . $from . ' 00:00:00" AND "' . $to . ' 23:59:59"';
            } else if (!empty(trim($_GET['from'])) && empty(trim($_GET['to']))) {
                $_GET['to'] = $_GET['from'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $from = (new DateTime($from))->format('Y-m-d');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $to = (new DateTime($to))->format('Y-m-d');
                $tanggal_konsultasi = 'BETWEEN "' . $_GET['from'] . ' 00:00:00" AND "' . $_GET['to'] . ' 23:59:59"';
            } else if (!empty(trim($_GET['to'])) && empty(trim($_GET['from']))) {
                $_GET['from'] = $_GET['to'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $from = (new DateTime($from))->format('Y-m-d');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $to = (new DateTime($to))->format('Y-m-d');
                $tanggal_konsultasi = 'BETWEEN "' . $_GET['from'] . ' 00:00:00" AND "' . $_GET['to'] . ' 23:59:59"';
            } else {
                $tanggal_konsultasi = 'IS NOT NULL';
            }
        } else {
            $tanggal_konsultasi = 'IS NOT NULL';
        }

        $data['list_diagnosa'] = $this->db->query('SELECT 
                                                    count(master_diagnosa.id) as jumlah_diagnosa, 
                                                    master_diagnosa.id, 
                                                    master_diagnosa.nama 
                                                    FROM diagnosis_dokter 
                                                        INNER JOIN master_diagnosa ON master_diagnosa.id = diagnosis_dokter.diagnosis 
                                                        INNER JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi 
                                                        INNER JOIN detail_dokter ON detail_dokter.id_dokter = diagnosis_dokter.id_dokter 
                                                        INNER JOIN nominal ON nominal.id = detail_dokter.id_poli 
                                                            WHERE 
                                                            nominal.id ' . $poli . ' AND 
                                                            diagnosis_dokter.id_dokter ' . $dokter . ' AND
                                                            (bukti_pembayaran.tanggal_konsultasi ' . $tanggal_konsultasi . ') 
                                                                GROUP BY diagnosis_dokter.diagnosis 
                                                                    ORDER BY jumlah_diagnosa DESC 
                                                                        LIMIT 0,10')->result();

        $data['list_poli'] = $this->db->query('SELECT DISTINCT 
                                                    nominal.poli, nominal.id 
                                                    FROM diagnosis_dokter 
                                                        INNER JOIN detail_dokter ON detail_dokter.id_dokter = diagnosis_dokter.id_dokter 
                                                        INNER JOIN nominal ON nominal.id = detail_dokter.id_poli')->result();

        $data['list_dokter'] = $this->db->query('SELECT DISTINCT 
                                                    diagnosis_dokter.id_dokter, 
                                                    dokter.name as nama_dokter 
                                                    FROM diagnosis_dokter 
                                                        INNER JOIN master_user dokter ON dokter.id = diagnosis_dokter.id_dokter')->result();

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('https://code.jquery.com/jquery-3.5.1.js') . '"></script>
                                <script src="' . base_url('https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js') . '"></script>
                                
                                <script>
                                $(document).ready(function () {
                                  if(filterby == "1"){
                                    $(".input-poli").show();
                                    $(".input-poli").find("select").prop("disabled",0);
                                    $(".input-dokter").hide();
                                    $(".input-dokter").find("select").prop("disabled",1);
                                  }else if(filterby == "2"){
                                    $(".input-poli").hide();
                                    $(".input-poli").find("select").prop("disabled",1);
                                    $(".input-dokter").show();
                                    $(".input-dokter").find("select").prop("disabled",0);
                                  }else{
                                    $(".input-poli").show();
                                    $(".input-poli").find("select").prop("disabled",0);
                                    $(".input-dokter").hide();
                                    $(".input-dokter").find("select").prop("disabled",1);
                                  }

                                  $("#table_diagnosa").DataTable({
                                    "autoWidth": true,
                                    "lengthChange": false,
                                    "paging": false,
                                    "searching": false,
                                    "pageLength": 10,
                                    "bInfo": false,
                                  });
                                  $("input[name=filterby]").change(function(e){
                                      if($(this).val() == "1"){
                                          $(".input-poli").show();
                                          $(".input-poli").find("select").prop("disabled",0);
                                          $(".input-dokter").hide();
                                          $(".input-dokter").find("select").prop("disabled",1);
                                      }else{
                                        $(".input-poli").hide();
                                        $(".input-poli").find("select").prop("disabled",1);
                                        $(".input-dokter").show();
                                        $(".input-dokter").find("select").prop("disabled",0);
                                      }
                                  });
                                });
                              </script>';

        $this->load->view('template', $data);
    }

    public function export_to_pdf_diagnosa_terbanyak()
    {
        $this->all_controllers->check_user_admin();

        if (isset($_GET['poli'])) {
            if (!empty(trim($_GET['poli']))) {
                $poli = '= ' . $_GET['poli'];
                $data['poli'] = $this->db->query('SELECT id, poli FROM nominal WHERE id = ' . $_GET['poli'])->row();
                if (!$data['poli']) {
                    $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Poli tidak ada!');
                    redirect(base_url('admin/Invoice/invoice_diagnosa_terbanyak'));
                }
            } else {
                $poli = 'IS NOT NULL';
                $data['poli'] = 'Semua';
            }
        } else {
            $poli = 'IS NOT NULL';
            $data['poli'] = 'Semua';
        }

        if (isset($_GET['dokter'])) {
            if (!empty(trim($_GET['dokter']))) {
                $dokter = '= ' . $_GET['dokter'];
                $data['dokter'] = $this->db->query('SELECT id, name FROM master_user WHERE id_user_kategori = 2 AND id = ' . $_GET['dokter'])->row();
                if (!$data['dokter']) {
                    $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Dokter tidak ada!');
                    redirect(base_url('admin/Invoice/invoice_diagnosa_terbanyak'));
                }
            } else {
                $dokter = 'IS NOT NULL';
                $data['dokter'] = 'Semua';
            }
        } else {
            $dokter = 'IS NOT NULL';
            $data['dokter'] = 'Semua';
        }

        if (isset($_GET['from'])) {
            if (!empty(trim($_GET['from'])) && !empty(trim($_GET['to']))) {
                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else if (!empty(trim($_GET['from'])) && empty(trim($_GET['to']))) {
                $_GET['to'] = $_GET['from'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else if (!empty(trim($_GET['to'])) && empty(trim($_GET['from']))) {
                $_GET['from'] = $_GET['to'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else {
                $tanggal_konsultasi = 'IS NOT NULL';

                $tanggal_konsultasi_id = '';
            }
        } else {
            $tanggal_konsultasi = 'IS NOT NULL';

            $tanggal_konsultasi_id = '';
        }
        $data['tanggal_konsultasi'] = $tanggal_konsultasi_id;

        $data['list_diagnosa'] = $this->db->query('SELECT 
                                                    count(master_diagnosa.id) as jumlah_diagnosa, 
                                                    master_diagnosa.id, 
                                                    master_diagnosa.nama 
                                                    FROM diagnosis_dokter 
                                                        INNER JOIN master_diagnosa ON master_diagnosa.id = diagnosis_dokter.diagnosis 
                                                        INNER JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi 
                                                        INNER JOIN detail_dokter ON detail_dokter.id_dokter = diagnosis_dokter.id_dokter 
                                                        INNER JOIN nominal ON nominal.id = detail_dokter.id_poli 
                                                            WHERE 
                                                            nominal.id ' . $poli . ' AND 
                                                            diagnosis_dokter.id_dokter ' . $dokter . ' AND
                                                            (bukti_pembayaran.tanggal_konsultasi ' . $tanggal_konsultasi . ') 
                                                                GROUP BY diagnosis_dokter.diagnosis 
                                                                    ORDER BY jumlah_diagnosa DESC 
                                                                        LIMIT 0,10')->result();

        $data['view'] = 'admin/pdf_invoice_diagnosa_terbanyak';
        $data['title'] = 'Laporan Diagnosa Terbanyak';
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "Invoice Diagnosa Terbanyak Telemedicine Lintasarta" . $tanggal_konsultasi_id . ".pdf";
        $this->pdf->load_view('template_invoice', $data);
    }

    public function export_to_excel_diagnosa_terbanyak()
    {
        $this->all_controllers->check_user_admin();

        if (isset($_GET['poli'])) {
            if (!empty(trim($_GET['poli']))) {
                $poli = '= ' . $_GET['poli'];
                $data['poli'] = $this->db->query('SELECT id, poli FROM nominal WHERE id = ' . $_GET['poli'])->row();
                if (!$data['poli']) {
                    $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Poli tidak ada!');
                    redirect(base_url('admin/Invoice/invoice_diagnosa_terbanyak'));
                }
            } else {
                $poli = 'IS NOT NULL';
                $data['poli'] = 'Semua';
            }
        } else {
            $poli = 'IS NOT NULL';
            $data['poli'] = 'Semua';
        }

        if (isset($_GET['dokter'])) {
            if (!empty(trim($_GET['dokter']))) {
                $dokter = '= ' . $_GET['dokter'];
                $data['dokter'] = $this->db->query('SELECT id, name FROM master_user WHERE id_user_kategori = 2 AND id = ' . $_GET['dokter'])->row();
                if (!$data['dokter']) {
                    $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Dokter tidak ada!');
                    redirect(base_url('admin/Invoice/invoice_diagnosa_terbanyak'));
                }
            } else {
                $dokter = 'IS NOT NULL';
                $data['dokter'] = 'Semua';
            }
        } else {
            $dokter = 'IS NOT NULL';
            $data['dokter'] = 'Semua';
        }

        if (isset($_GET['from'])) {
            if (!empty(trim($_GET['from'])) && !empty(trim($_GET['to']))) {
                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else if (!empty(trim($_GET['from'])) && empty(trim($_GET['to']))) {
                $_GET['to'] = $_GET['from'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else if (!empty(trim($_GET['to'])) && empty(trim($_GET['from']))) {
                $_GET['from'] = $_GET['to'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else {
                $tanggal_konsultasi = 'IS NOT NULL';

                $tanggal_konsultasi_id = '';
            }
        } else {
            $tanggal_konsultasi = 'IS NOT NULL';

            $tanggal_konsultasi_id = '';
        }
        $data['tanggal_konsultasi'] = $tanggal_konsultasi_id;

        $data['list_diagnosa'] = $this->db->query('SELECT 
                                                    count(master_diagnosa.id) as jumlah_diagnosa, 
                                                    master_diagnosa.id, 
                                                    master_diagnosa.nama 
                                                    FROM diagnosis_dokter 
                                                        INNER JOIN master_diagnosa ON master_diagnosa.id = diagnosis_dokter.diagnosis 
                                                        INNER JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi 
                                                        INNER JOIN detail_dokter ON detail_dokter.id_dokter = diagnosis_dokter.id_dokter 
                                                        INNER JOIN nominal ON nominal.id = detail_dokter.id_poli 
                                                            WHERE 
                                                            nominal.id ' . $poli . ' AND 
                                                            diagnosis_dokter.id_dokter ' . $dokter . ' AND
                                                            (bukti_pembayaran.tanggal_konsultasi ' . $tanggal_konsultasi . ') 
                                                                GROUP BY diagnosis_dokter.diagnosis 
                                                                    ORDER BY jumlah_diagnosa DESC 
                                                                        LIMIT 0,10')->result();
        // ========================================== EXPORT TO EXCEL ===============================//
        require(APPPATH . 'helpers/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'helpers/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $excel = new PHPExcel();

        $style_header = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_body = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->getProperties()->setCreator('Telemedicine Lintasarta')
            ->setLastModifiedBy('Telemedicine Lintasarta')
            ->setTitle('Invoice Diagnosa Terbanyak Telemedicine Lintasarta');

        $excel->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Diagnosa Terbanyak');
        $excel->getActiveSheet()->mergeCells('A1:D2');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', 'Telemedicine Lintasarta');
        $excel->getActiveSheet()->mergeCells('A3:D3');
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A5', 'Dokter: ' . ($data['dokter'] != 'Semua' ? $data['dokter']->name : $data['dokter']));
        $excel->getActiveSheet()->mergeCells('A5:D5');
        $excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE);

        $excel->setActiveSheetIndex(0)->setCellValue('A6', 'Poli: ' . ($data['poli'] != 'Semua' ? $data['poli']->poli : $data['poli']));
        $excel->getActiveSheet()->mergeCells('A6:D6');
        $excel->getActiveSheet()->getStyle('A6')->getFont()->setBold(TRUE);

        $excel->setActiveSheetIndex(0)->setCellValue('A7', 'Periode: ' . (!empty($data['tanggal_konsultasi']) ? $data['tanggal_konsultasi'] : 'Semua'));
        $excel->getActiveSheet()->mergeCells('A7:D7');
        $excel->getActiveSheet()->getStyle('A7')->getFont()->setBold(TRUE);

        $excel->setActiveSheetIndex(0)->setCellValue('A9', "No");
        $excel->setActiveSheetIndex(0)->setCellValue('B9', "Kode Diagnosa");
        $excel->setActiveSheetIndex(0)->setCellValue('C9', "Deskripsi");
        $excel->setActiveSheetIndex(0)->setCellValue('D9', "Jumlah");

        $excel->getActiveSheet()->getStyle('A9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('B9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('C9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('D9')->applyFromArray($style_header);

        $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);

        $total_diagnosa = 0;
        $numrow = 10;
        foreach ($data['list_diagnosa'] as $idx => $diagnosa) {

            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $idx + 1);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $diagnosa->id);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $diagnosa->nama);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $diagnosa->jumlah_diagnosa);
            $total_diagnosa += $diagnosa->jumlah_diagnosa;

            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_body);

            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_body);

            $numrow += 1;
        }

        $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, 'Total');
        $excel->getActiveSheet()->mergeCells('A' . $numrow . ':C' . $numrow);
        $excel->getActiveSheet()->getStyle('A' . $numrow)->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_body);

        $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $total_diagnosa);
        $excel->getActiveSheet()->getStyle('D' . $numrow)->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_body);



        $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle('Laporan Diagnosa Terbanyak');
        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheethtml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Diagnosa Terbanyak Telemedicine Lintasarta' . $data['tanggal_konsultasi'] . '.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function invoice_telekonsultasi()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Laporan Telekonsultasi",
            $view = "admin/invoice_telekonsultasi"
        );

        if (isset($_GET['poli'])) {
            if (!empty(trim($_GET['poli']))) {
                $poli = '= ' . (int)$_GET['poli'];
            } else {
                $poli = 'IS NOT NULL';
            }
        } else {
            $poli = 'IS NOT NULL';
        }

        if (isset($_GET['dokter'])) {
            if (!empty(trim($_GET['dokter']))) {
                $dokter = '= ' . $_GET['dokter'];
            } else {
                $dokter = 'IS NOT NULL';
            }
        } else {
            $dokter = 'IS NOT NULL';
        }

        if (isset($_GET['from'])) {
            if (!empty(trim($_GET['from'])) && !empty(trim($_GET['to']))) {
                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $from = (new DateTime($from))->format('Y-m-d');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $to = (new DateTime($to))->format('Y-m-d');
                $tanggal_konsultasi = 'BETWEEN "' . $from . ' 00:00:00" AND "' . $to . ' 23:59:59"';
            } else if (!empty(trim($_GET['from'])) && empty(trim($_GET['to']))) {
                $_GET['to'] = $_GET['from'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $from = (new DateTime($from))->format('Y-m-d');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $to = (new DateTime($to))->format('Y-m-d');
                $tanggal_konsultasi = 'BETWEEN "' . $_GET['from'] . ' 00:00:00" AND "' . $_GET['to'] . ' 23:59:59"';
            } else if (!empty(trim($_GET['to'])) && empty(trim($_GET['from']))) {
                $_GET['from'] = $_GET['to'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $from = (new DateTime($from))->format('Y-m-d');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $to = (new DateTime($to))->format('Y-m-d');
                $tanggal_konsultasi = 'BETWEEN "' . $_GET['from'] . ' 00:00:00" AND "' . $_GET['to'] . ' 23:59:59"';
            } else {
                $tanggal_konsultasi = 'IS NOT NULL';
            }
        } else {
            $tanggal_konsultasi = 'IS NOT NULL';
        }

        $config = $this->my_pagination->paginate(5, 4, count($this->_get_telekonsultasi($dokter, $poli, $tanggal_konsultasi)), base_url('admin/Invoice/invoice_telekonsultasi'));
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['uri_segment'] = $this->uri->segment(4);
        $limit = ' LIMIT ' . $config['per_page'] . ' OFFSET ' . $data['page'];

        $data['list_pembayaran_konsultasi'] = $this->_get_telekonsultasi($dokter, $poli, $tanggal_konsultasi, $limit);
        $data['pagination'] = $this->pagination->create_links();
        $data['list_poli'] = $this->db->query('SELECT DISTINCT 
                                                    nominal.poli, nominal.id 
                                                    FROM diagnosis_dokter 
                                                        INNER JOIN detail_dokter ON detail_dokter.id_dokter = diagnosis_dokter.id_dokter 
                                                        INNER JOIN nominal ON nominal.id = detail_dokter.id_poli')->result();

        $data['list_dokter'] = $this->db->query('SELECT DISTINCT 
                                                    diagnosis_dokter.id_dokter, 
                                                    dokter.name as nama_dokter 
                                                    FROM diagnosis_dokter 
                                                        INNER JOIN master_user dokter ON dokter.id = diagnosis_dokter.id_dokter')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('https://code.jquery.com/jquery-3.5.1.js') . '"></script>
                                <script src="' . base_url('https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js') . '"></script>
                                
                                <script>
                                $(document).ready(function () {
                                  if(filterby == "1"){
                                    $(".input-poli").show();
                                    $(".input-poli").find("select").prop("disabled",0);
                                    $(".input-dokter").hide();
                                    $(".input-dokter").find("select").prop("disabled",1);
                                  }else if(filterby == "2"){
                                    $(".input-poli").hide();
                                    $(".input-poli").find("select").prop("disabled",1);
                                    $(".input-dokter").show();
                                    $(".input-dokter").find("select").prop("disabled",0);
                                  }else{
                                    $(".input-poli").show();
                                    $(".input-poli").find("select").prop("disabled",0);
                                    $(".input-dokter").hide();
                                    $(".input-dokter").find("select").prop("disabled",1);
                                  }

                                  $("input[name=filterby]").change(function(e){
                                      if($(this).val() == "1"){
                                          $(".input-poli").show();
                                          $(".input-poli").find("select").prop("disabled",0);
                                          $(".input-dokter").hide();
                                          $(".input-dokter").find("select").prop("disabled",1);
                                      }else{
                                        $(".input-poli").hide();
                                        $(".input-poli").find("select").prop("disabled",1);
                                        $(".input-dokter").show();
                                        $(".input-dokter").find("select").prop("disabled",0);
                                      }
                                  });
                                });
                              </script>';
        $this->load->view('template', $data);
    }

    public function export_to_pdf_telekonsultasi()
    {
        $this->all_controllers->check_user_admin();

        if (isset($_GET['poli'])) {
            if (!empty(trim($_GET['poli']))) {
                $poli = '= ' . $_GET['poli'];
                $data['poli'] = $this->db->query('SELECT id, poli FROM nominal WHERE id = ' . $_GET['poli'])->row();
                if (!$data['poli']) {
                    $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Poli tidak ada!');
                    redirect(base_url('admin/Invoice/invoice_diagnosa_terbanyak'));
                }
            } else {
                $poli = 'IS NOT NULL';
                $data['poli'] = 'Semua';
            }
        } else {
            $poli = 'IS NOT NULL';
            $data['poli'] = 'Semua';
        }

        if (isset($_GET['dokter'])) {
            if (!empty(trim($_GET['dokter']))) {
                $dokter = '= ' . $_GET['dokter'];
                $data['dokter'] = $this->db->query('SELECT id, name FROM master_user WHERE id_user_kategori = 2 AND id = ' . $_GET['dokter'])->row();
                if (!$data['dokter']) {
                    $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Dokter tidak ada!');
                    redirect(base_url('admin/Invoice/invoice_diagnosa_terbanyak'));
                }
            } else {
                $dokter = 'IS NOT NULL';
                $data['dokter'] = 'Semua';
            }
        } else {
            $dokter = 'IS NOT NULL';
            $data['dokter'] = 'Semua';
        }

        if (isset($_GET['from'])) {
            if (!empty(trim($_GET['from'])) && !empty(trim($_GET['to']))) {
                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else if (!empty(trim($_GET['from'])) && empty(trim($_GET['to']))) {
                $_GET['to'] = $_GET['from'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else if (!empty(trim($_GET['to'])) && empty(trim($_GET['from']))) {
                $_GET['from'] = $_GET['to'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else {
                $tanggal_konsultasi = 'IS NOT NULL';

                $tanggal_konsultasi_id = '';
            }
        } else {
            $tanggal_konsultasi = 'IS NOT NULL';

            $tanggal_konsultasi_id = '';
        }
        $data['tanggal_konsultasi'] = $tanggal_konsultasi_id;

        $data['list_pembayaran_konsultasi'] = $this->_get_telekonsultasi($dokter, $poli, $tanggal_konsultasi);

        $data['view'] = 'admin/pdf_invoice_telekonsultasi';
        $data['title'] = 'Laporan Telekonsultasi';
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "Invoice Telekonsultasi Telemedicine Lintasarta" . $tanggal_konsultasi_id . ".pdf";
        $this->pdf->load_view('template_invoice', $data);
    }

    public function export_to_excel_telekonsultasi()
    {
        $this->all_controllers->check_user_admin();

        if (isset($_GET['poli'])) {
            if (!empty(trim($_GET['poli']))) {
                $poli = '= ' . $_GET['poli'];
                $data['poli'] = $this->db->query('SELECT id, poli FROM nominal WHERE id = ' . $_GET['poli'])->row();
                if (!$data['poli']) {
                    $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Poli tidak ada!');
                    redirect(base_url('admin/Invoice/invoice_diagnosa_terbanyak'));
                }
            } else {
                $poli = 'IS NOT NULL';
                $data['poli'] = 'Semua';
            }
        } else {
            $poli = 'IS NOT NULL';
            $data['poli'] = 'Semua';
        }

        if (isset($_GET['dokter'])) {
            if (!empty(trim($_GET['dokter']))) {
                $dokter = '= ' . $_GET['dokter'];
                $data['dokter'] = $this->db->query('SELECT id, name FROM master_user WHERE id_user_kategori = 2 AND id = ' . $_GET['dokter'])->row();
                if (!$data['dokter']) {
                    $this->session->set_flashdata('msg_export_invoice', 'GAGAL: Dokter tidak ada!');
                    redirect(base_url('admin/Invoice/invoice_diagnosa_terbanyak'));
                }
            } else {
                $dokter = 'IS NOT NULL';
                $data['dokter'] = 'Semua';
            }
        } else {
            $dokter = 'IS NOT NULL';
            $data['dokter'] = 'Semua';
        }

        if (isset($_GET['from'])) {
            if (!empty(trim($_GET['from'])) && !empty(trim($_GET['to']))) {
                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else if (!empty(trim($_GET['from'])) && empty(trim($_GET['to']))) {
                $_GET['to'] = $_GET['from'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else if (!empty(trim($_GET['to'])) && empty(trim($_GET['from']))) {
                $_GET['from'] = $_GET['to'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $fromEn = (new DateTime($from))->format('Y-m-d');
                $fromId = (new DateTime($from))->format('d-m-Y');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $toEn = (new DateTime($to))->format('Y-m-d');
                $toId = (new DateTime($to))->format('d-m-Y');

                $tanggal_konsultasi = 'BETWEEN "' . $fromEn . ' 00:00:00" AND "' . $toEn . ' 23:59:59"';

                $tanggal_konsultasi_id = '( ' . $fromId . ' - ' . $toId . ' )';
                $tanggal_konsultasi_id = implode('_', explode('/', $tanggal_konsultasi_id));
            } else {
                $tanggal_konsultasi = 'IS NOT NULL';

                $tanggal_konsultasi_id = '';
            }
        } else {
            $tanggal_konsultasi = 'IS NOT NULL';

            $tanggal_konsultasi_id = '';
        }
        $data['tanggal_konsultasi'] = $tanggal_konsultasi_id;

        $data['list_pembayaran_konsultasi'] = $this->_get_telekonsultasi($dokter, $poli, $tanggal_konsultasi);

        // ========================================== EXPORT TO EXCEL ===============================//
        require(APPPATH . 'helpers/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'helpers/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $excel = new PHPExcel();

        $style_header = array(
            'font' => array('bold' => true, 'size' => 7),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_body = array(
            'font' => array('size' => 7),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->getProperties()->setCreator('Telemedicine Lintasarta')
            ->setLastModifiedBy('Telemedicine Lintasarta')
            ->setTitle('Invoice Telekonsultasi Telemedicine Lintasarta');

        $excel->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Telekonsultasi');
        $excel->getActiveSheet()->mergeCells('A1:K2');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', 'Telemedicine Lintasarta');
        $excel->getActiveSheet()->mergeCells('A3:K3');
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A5', 'Dokter: ' . ($data['dokter'] != 'Semua' ? $data['dokter']->name : $data['dokter']));
        $excel->getActiveSheet()->mergeCells('A5:K5');
        $excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE);

        $excel->setActiveSheetIndex(0)->setCellValue('A6', 'Poli: ' . ($data['poli'] != 'Semua' ? $data['poli']->poli : $data['poli']));
        $excel->getActiveSheet()->mergeCells('A6:K6');
        $excel->getActiveSheet()->getStyle('A6')->getFont()->setBold(TRUE);

        $excel->setActiveSheetIndex(0)->setCellValue('A7', 'Periode: ' . (!empty($data['tanggal_konsultasi']) ? $data['tanggal_konsultasi'] : 'Semua'));
        $excel->getActiveSheet()->mergeCells('A7:K7');
        $excel->getActiveSheet()->getStyle('A7')->getFont()->setBold(TRUE);

        $excel->setActiveSheetIndex(0)->setCellValue('A9', "No");
        $excel->setActiveSheetIndex(0)->setCellValue('B9', "Tanggal");
        $excel->setActiveSheetIndex(0)->setCellValue('C9', "Mulai Konsultasi");
        $excel->setActiveSheetIndex(0)->setCellValue('D9', "Durasi");
        $excel->setActiveSheetIndex(0)->setCellValue('E9', "No RM");
        $excel->setActiveSheetIndex(0)->setCellValue('F9', "No Reg");
        $excel->setActiveSheetIndex(0)->setCellValue('G9', "Pasien");
        $excel->setActiveSheetIndex(0)->setCellValue('H9', "Poli");
        $excel->setActiveSheetIndex(0)->setCellValue('I9', "Dokter");
        $excel->setActiveSheetIndex(0)->setCellValue('J9', "Diagnosa");
        $excel->setActiveSheetIndex(0)->setCellValue('K9', "Obat");

        $excel->getActiveSheet()->getStyle('A9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('B9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('C9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('D9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('E9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('F9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('G9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('H9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('I9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('J9')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('K9')->applyFromArray($style_header);

        $numrow = 10;
        foreach ($data['list_pembayaran_konsultasi'] as $idx => $pembayaran_konsultasi) {
            if ($pembayaran_konsultasi->selesai_konsultasi != null) {
                $awal_konsultasi = (new DateTime($pembayaran_konsultasi->tanggal_konsultasi))->format('H:i');
                $awal_konsultasi = new DateTime($awal_konsultasi);

                $akhir_konsultasi = (new DateTime($pembayaran_konsultasi->selesai_konsultasi))->format('H:i');
                $akhir_konsultasi = new DateTime($akhir_konsultasi);

                $diff = $awal_konsultasi->diff($akhir_konsultasi);

                if ($diff->h < 1) {
                    $durasi = $diff->i . ' Menit';
                } else {
                    $jam_menit = $diff->h * 60;
                    $durasi = ($diff->i + $jam_menit) . ' Menit';
                }
            } else {
                $durasi = 'NOT SET';
            }

            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $idx + 1);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, (new DateTime($pembayaran_konsultasi->tanggal_konsultasi))->format('d-m-Y'));
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, (new DateTime($pembayaran_konsultasi->tanggal_konsultasi))->format('H:i'));
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $durasi);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $pembayaran_konsultasi->no_medrec);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $pembayaran_konsultasi->id_registrasi);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $pembayaran_konsultasi->nama_pasien);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $pembayaran_konsultasi->poli);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $pembayaran_konsultasi->nama_dokter);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, '( ' . $pembayaran_konsultasi->kode_diagnosa . ' ) ' . $pembayaran_konsultasi->nama_diagnosa);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $pembayaran_konsultasi->nama_obat);

            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_body);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_body);

            $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(-1);

            $numrow += 1;
        }

        $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('9')->setRowHeight(10);

        // $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        // $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        // $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        // $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        // $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        // $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        // $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        // $excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        // $excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        // $excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        // $excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

        $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle('Laporan Telekonsultasi');
        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheethtml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Telekonsultasi Telemedicine Lintasarta' . $data['tanggal_konsultasi'] . '.xlsx"');
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function invoice_pengeluaran_obat()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Laporan Pengeluaran Obat",
            $view = "admin/invoice_pengeluaran_obat"
        );

        if (isset($_GET['from'])) {
            if (!empty(trim($_GET['from'])) && !empty(trim($_GET['to']))) {
                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $from = (new DateTime($from))->format('Y-m-d');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $to = (new DateTime($to))->format('Y-m-d');
                $tanggal_konsultasi = 'BETWEEN "' . $from . ' 00:00:00" AND "' . $to . ' 23:59:59"';
            } else if (!empty(trim($_GET['from'])) && empty(trim($_GET['to']))) {
                $_GET['to'] = $_GET['from'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $from = (new DateTime($from))->format('Y-m-d');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $to = (new DateTime($to))->format('Y-m-d');
                $tanggal_konsultasi = 'BETWEEN "' . $_GET['from'] . ' 00:00:00" AND "' . $_GET['to'] . ' 23:59:59"';
            } else if (!empty(trim($_GET['to'])) && empty(trim($_GET['from']))) {
                $_GET['from'] = $_GET['to'];

                $from = explode("/", $_GET['from']);
                $from = implode("-", $from);
                $from = (new DateTime($from))->format('Y-m-d');

                $to = explode("/", $_GET['to']);
                $to = implode("-", $to);
                $to = (new DateTime($to))->format('Y-m-d');
                $tanggal_konsultasi = 'BETWEEN "' . $_GET['from'] . ' 00:00:00" AND "' . $_GET['to'] . ' 23:59:59"';
            } else {
                $tanggal_konsultasi = 'IS NOT NULL';
            }
        } else {
            $tanggal_konsultasi = 'IS NOT NULL';
        }

        $data['list_obat'] = $this->db->query('SELECT 
                                                GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ",") as jml_obat,
                                                master_obat.name,
                                                master_obat.id 
                                                FROM bukti_pembayaran_obat 
                                                    INNER JOIN resep_dokter ON resep_dokter.id_jadwal_konsultasi = bukti_pembayaran_obat.id_jadwal_konsultasi 
                                                    INNER JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi 
                                                    INNER JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi 
                                                    INNER JOIN master_obat ON master_obat.id = resep_dokter.id_obat
                                                WHERE 
                                                    bukti_pembayaran_obat.order_status = 1 AND
                                                    (bukti_pembayaran.tanggal_konsultasi ' . $tanggal_konsultasi . ')
                                                GROUP BY master_obat.id
        ')->result();

        $data['total_obat'] = 0;
        foreach ($data['list_obat'] as $idx => $obat) {
            $list_jml_obat = explode(',', $obat->jml_obat);
            $obat->total_jml_obat = 0;
            foreach ($list_jml_obat as $jml_obat) {
                $obat->total_jml_obat += $jml_obat;
                $data['total_obat'] += $jml_obat;
            }
        }

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('https://code.jquery.com/jquery-3.5.1.js') . '"></script>
                                <script src="' . base_url('https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js') . '"></script>
                                
                                <script>
                                $(document).ready(function () {
                                  $("#table_obat").DataTable({
                                    "autoWidth": true,
                                    "lengthChange": false,
                                    "paging": true,
                                    "searching": true,
                                    "pageLength": 10,
                                    "bInfo": false,
                                  });
                                });
                              </script>';

        $this->load->view('template', $data);
    }

    private function _get_telekonsultasi($dokter, $poli, $tanggal_konsultasi, $limit = '')
    {
        return $this->db->query('SELECT 
                                    bukti_pembayaran.id_registrasi, 
                                    bukti_pembayaran.metode_pembayaran, 
                                    bukti_pembayaran.tanggal_konsultasi, 
                                    bukti_pembayaran.selesai_konsultasi, 
                                    nominal.poli, 
                                    diagnosis_dokter.diagnosis as kode_diagnosa, 
                                    master_diagnosa.nama as nama_diagnosa, 
                                    detail_pasien.no_medrec, 
                                    dokter.name as nama_dokter, 
                                    pasien.name as nama_pasien, 
                                    GROUP_CONCAT(master_obat.name SEPARATOR ", ") as nama_obat 
                                    FROM bukti_pembayaran 
                                        INNER JOIN master_user pasien ON pasien.id = bukti_pembayaran.id_pasien 
                                        INNER JOIN detail_pasien ON pasien.id = detail_pasien.id_pasien 
                                        INNER JOIN master_user dokter ON dokter.id = bukti_pembayaran.id_dokter 
                                        INNER JOIN detail_dokter ON detail_dokter.id_dokter = dokter.id 
                                        INNER JOIN nominal ON detail_dokter.id_poli = nominal.id 
                                        INNER JOIN diagnosis_dokter ON diagnosis_dokter.id_registrasi = bukti_pembayaran.id_registrasi 
                                        INNER JOIN master_diagnosa ON master_diagnosa.id = diagnosis_dokter.diagnosis 
                                        INNER JOIN resep_dokter ON resep_dokter.id_jadwal_konsultasi = diagnosis_dokter.id_jadwal_konsultasi 
                                        INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id 
                                            WHERE 
                                            dokter.id ' . $dokter . ' AND 
                                            nominal.id ' . $poli . ' AND 
                                            (bukti_pembayaran.tanggal_konsultasi ' . $tanggal_konsultasi . ') 
                                                GROUP BY diagnosis_dokter.id_registrasi
                                                    ORDER BY bukti_pembayaran.tanggal_konsultasi DESC' . $limit)->result();
    }

    private function _get_pembayaran_obat($between)
    {
        $data = $this->db->query("SELECT 
                                        biaya_pengiriman_obat.alamat as alamat_pengiriman, 
                                        diagnosis_dokter.id_registrasi, 
                                        nominal.poli as nama_poli, 
                                        resep_dokter.id, 
                                        bpo.order_status, 
                                        bpo.status as status_bukti, 
                                        bpo.id as id_bukti, 
                                        bpo.created_at as tanggal_pembayaran, 
                                        bpo.metode_pembayaran, 
                                        bpo.claim_number, 
                                        resep_dokter.id_jadwal_konsultasi, 
                                        d.name as nama_dokter, 
                                        p.name as nama_pasien, 
                                        master_diagnosa.id as diagnosis_code, 
                                        master_diagnosa.nama as diagnosis_name, 
                                        bpo.card_number, 
                                        biaya_pengiriman_obat.biaya_pengiriman, 
                                        GROUP_CONCAT(master_obat.name SEPARATOR '|') as nama_obat, 
                                        GROUP_CONCAT(master_obat.unit SEPARATOR ',') as tipe_obat, 
                                        GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, 
                                        GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, 
                                        GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat 
                                            FROM (resep_dokter) 
                                                LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi 
                                                INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id 
                                                INNER JOIN master_user d ON resep_dokter.id_dokter = d.id 
                                                INNER JOIN detail_dokter ON detail_dokter.id_dokter = d.id 
                                                INNER JOIN nominal ON nominal.id = detail_dokter.id_poli 
                                                INNER JOIN master_user p ON resep_dokter.id_pasien = p.id 
                                                INNER JOIN bukti_pembayaran_obat bpo ON resep_dokter.id_jadwal_konsultasi = bpo.id_jadwal_konsultasi 
                                                LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id 
                                                INNER JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi 
                                                INNER JOIN master_diagnosa ON master_diagnosa.id = diagnosis_dokter.diagnosis 
                                                    WHERE bpo.status != 0 
                                                        AND bpo.metode_pembayaran = 2 " . $between . " 
                                                            GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY bpo.created_at DESC")->result();
        return $data;
    }

    private function _get_pembayaran_konsultasi($between)
    {
        $data = $this->db->query(
            'SELECT bukti_pembayaran.id_registrasi as id_registrasi, 
            bukti_pembayaran.created_at as tanggal_pembayaran, 
            diagnosis_dokter.diagnosis as diagnosis_code, 
            master_diagnosa.nama as diagnosis_name, 
            d.name as nama_dokter, 
            p.name as nama_pasien, 
            bukti_pembayaran.status, 
            bukti_pembayaran.claim_number, 
            bukti_pembayaran.card_number, 
            nominal.harga as harga_poli, 
            nominal.poli as nama_poli, 
            bukti_pembayaran.biaya_adm, 
            bukti_pembayaran.biaya_konsultasi 
                FROM bukti_pembayaran 
                    LEFT JOIN master_user p ON bukti_pembayaran.id_pasien = p.id 
                    LEFT JOIN master_user d ON bukti_pembayaran.id_dokter = d.id 
                    LEFT JOIN detail_dokter ON detail_dokter.id_dokter = d.id 
                    LEFT JOIN nominal ON detail_dokter.id_poli = nominal.id 
                    LEFT JOIN jadwal_konsultasi ON jadwal_konsultasi.id_registrasi = bukti_pembayaran.id_registrasi 
                    LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_registrasi = bukti_pembayaran.id_registrasi 
                    LEFT JOIN master_diagnosa ON master_diagnosa.id = diagnosis_dokter.diagnosis WHERE bukti_pembayaran.status != 0 AND bukti_pembayaran.metode_pembayaran = 2 ' . $between . ' ORDER BY bukti_pembayaran.created_at DESC'
        )->result();
        return $data;
    }
}
