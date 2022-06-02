<?php
            $pdf = new Pdf('L','mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Data Prakerin');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(1);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->AddPage('P','A4');
            $pdf->SetFont('helvetica', '', 9);

            $i=0;
            $html='<img src="images/logo/kopssekolah.png" alt="" style="width:12000%"/>
            <h3 align="center">MEDICAL RECORD</h3>
                    <table cellspacing="1" bgcolor="#666666" cellpadding="">
                        <tr bgcolor="#ffffff">
                            <th width="10mm" align="center">No</th>
                            <th width="20%" align="center">Dokter</th>
                            <th width="15%" align="center"></th>
                            <th width="15%" align="center">Diagnosis</th>
                            <th width="15%" align="center">Resep</th>
                        </tr>';
            foreach ($prakerin as $row) 
                {
                    $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>
                            <td >'.$row['nama_pasien'].'</td>
                            <td >'.$row['tanggal_konsultasi'].'</td>
                            <td >'.$row['diagnosis'].'</td>
                            <td >'.$row['Resep'].'</td>
                        </tr>';
                }
            $html.='</table>

            <img src="images/logo/ttd.png" alt="" style="width:1500%;"/>
            ';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('MedicalRecordPasien.pdf', 'I');
?>