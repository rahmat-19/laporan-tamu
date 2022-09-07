<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTamuRequest;
use App\Models\HistoryAttendanceGuests;
use App\Models\UserTamu;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;

class UserTamuController extends Controller
{
    public function index()
    {
        return view('tamu.searchLogin');
    }

    public function create()
    {
        return view('tamu.create');
    }

    public function outGuestPage()
    {
        $datas = UserTamu::where('status', 1)->orderby('name', 'ASC')->get();
        return view('tamu.searchLogout', compact('datas'));
    }
    public function outGuest(UserTamu $userTamu)
    {
        $result = $userTamu->update([
            'status' => 0
        ]);

        $idSemenetara = $userTamu->id;
        if ($result) {
            $historyUpdate = HistoryAttendanceGuests::where('user_id', $idSemenetara)->latest()->first();
            $historyUpdate->update(['keluar' => new DateTime('now')]);

            return redirect(Route('masuk.tamu'));
        } else {

            return redirect(Route('masuk.tamu'));
        }
    }

    public function store(UserTamuRequest $request)
    {

        $validated = $request->validated();
        $img = $request->images;
        $folderPath = "public/uploads/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;

        $validated['images'] = $fileName;

        $result = UserTamu::create($validated);
        if ($result) {
            HistoryAttendanceGuests::create([
                'user_id' => $result->id,
                'keperluan' => $request->keperluan,
                'rak' => $request->rak,
                'masuk' => new DateTime('now')
            ]);


            Storage::put($file, $image_base64);
            return redirect(Route('create.tamu'));
        } else {
            return redirect(Route('create.tamu'));
        }
    }
    public function exportExcel(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'startColor' => [
                    'argb' => 'FFFF00',
                ],
                'endColor' => [
                    'argb' => 'FFFF00',
                ],
            ],
        ];

        $style_row_marge = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];
        $sheet->setCellValue('A1', "Laporan Buku Tamu");
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->applyFromArray($style_col);


        $sheet->setCellValue('A3', "NO");
        $sheet->setCellValue('B3', "Nama");
        $sheet->setCellValue('C3', "Perusahaan");
        $sheet->setCellValue('D3', "Email");
        $sheet->setCellValue('E3', "Keperluan");
        $sheet->setCellValue('F3', "Masuk");
        $sheet->setCellValue('G3', "Keluar");

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);


        $no = 1;
        $numrow = 4;
        $numrowSN = 4;





        $datas = HistoryAttendanceGuests::all();


        foreach ($datas as $data) {
            $sheet->setCellValue("A{$numrow}", $no);
            $sheet->mergeCells("A{$numrow}:A" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1));

            $sheet->setCellValue('B' . $numrow, $data->user_tamus->name);
            $sheet->mergeCells("B{$numrow}:B" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1));

            $sheet->setCellValue('C' . $numrow, $data->user_tamus->perusahaan);
            $sheet->mergeCells("C{$numrow}:C" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1));

            $sheet->setCellValue('D' . $numrow, $data->user_tamus->email);
            $sheet->mergeCells("D{$numrow}:D" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1));

            if (!empty($data->keperluan)) {
                foreach ($data->keperluan as $sn) {
                    $sheet->setCellValue('E' . $numrowSN, $sn);
                    $sheet->getStyle('E' . $numrowSN)->applyFromArray($style_row);
                    $numrowSN++;
                }
            } else {
                $sheet->setCellValue('E' . $numrowSN, "-");
                $numrowSN++;
            }

            $sheet->setCellValue('F' . $numrow, (new DateTime($data->masuk))->format('M d, Y H:i'));
            $sheet->mergeCells("F{$numrow}:F" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1));

            if ($data->keluar) {
                $sheet->setCellValue('G' . $numrow, $data->keluar);
            } else {
                $sheet->setCellValue('G' . $numrow, "Belum Keluar");
            }
            $sheet->mergeCells("G{$numrow}:G" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1));






            $sheet->getStyle("A{$numrow}:A" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1))->applyFromArray($style_row_marge);
            $sheet->getStyle("B{$numrow}:B" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1))->applyFromArray($style_row_marge);
            $sheet->getStyle("C{$numrow}:C" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1))->applyFromArray($style_row_marge);
            $sheet->getStyle("D{$numrow}:D" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1))->applyFromArray($style_row_marge);
            $sheet->getStyle("E{$numrow}:E" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1))->applyFromArray($style_row_marge);
            $sheet->getStyle("F{$numrow}:F" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1))->applyFromArray($style_row_marge);
            $sheet->getStyle("G{$numrow}:G" . ($numrow + (empty($data->keperluan) ? 1 : count($data->keperluan)) - 1))->applyFromArray($style_row_marge);




            $no++;
            $numrow = $numrow + (empty($data->keperluan) ? 1 : count($data->keperluan));
        };

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(30);

        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        $sheet->setTitle("Laporan Pengeluaran Barang");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan-Tamu.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }



    public function history()
    {
        return view('tamu.history', [
            'datas' => HistoryAttendanceGuests::latest()->get()
        ]);
    }
}
