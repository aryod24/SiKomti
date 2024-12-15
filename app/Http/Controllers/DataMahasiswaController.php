<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaAlpha;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class DataMahasiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Data Mahasiswa Alpha',
            'list'  => ['Home', 'Data Mahasiswa Alpha']
        ];
        $page = (object) [
            'title' => 'Daftar mahasiswa alpha yang terdaftar dalam sistem'
        ];
        $activeMenu = 'datamahasiswa';
        return view('datamahasiswa.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $mahasiswaAlpha = MahasiswaAlpha::select('id_alpha', 'ni', 'jam_alpha', 'nama', 'semester', 'jam_kompen');
        return DataTables::of($mahasiswaAlpha)
            ->addIndexColumn()
            ->addColumn('aksi', function ($mahasiswaAlpha) {
                $btn = '<a href="' . url('/datamahasiswa/' . $mahasiswaAlpha->id_alpha) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/datamahasiswa/' . $mahasiswaAlpha->id_alpha . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/datamahasiswa/' . $mahasiswaAlpha->id_alpha) . '">'
                    . csrf_field() . method_field('DELETE') . 
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Data Mahasiswa Alpha',
            'list'  => ['Home', 'Data Mahasiswa Alpha', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah data mahasiswa alpha baru'
        ];
        $activeMenu = 'datamahasiswa';
        return view('datamahasiswa.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ni' => 'required|string|max:20',
            'jam_alpha' => 'nullable|integer',
            'nama' => 'required|string|max:100',
            'semester' => 'nullable|integer',
            'jam_kompen' => 'nullable|integer',
        ]);

        MahasiswaAlpha::create($request->all());

        return redirect('/datamahasiswa')->with('success', 'Data mahasiswa alpha berhasil disimpan');
    }

    public function show($id_alpha)
    {
        $mahasiswaAlpha = MahasiswaAlpha::findOrFail($id_alpha);

        $breadcrumb = (object)[
            'title' => 'Detail Data Mahasiswa Alpha',
            'list' => ['Home', 'Data Mahasiswa Alpha', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail Data Mahasiswa Alpha'
        ];
        $activeMenu = 'datamahasiswa';
        return view('datamahasiswa.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'mahasiswaAlpha' => $mahasiswaAlpha, 'activeMenu' => $activeMenu]);
    }

    public function edit($id_alpha)
    {
        $mahasiswaAlpha = MahasiswaAlpha::findOrFail($id_alpha);
        $breadcrumb = (object) [
            'title' => 'Edit Data Mahasiswa Alpha',
            'list'  => ['Home', 'Data Mahasiswa Alpha', 'Edit']
        ];
        $page = (object) [
            'title' => 'Edit data mahasiswa alpha'
        ];
        $activeMenu = 'datamahasiswa';
        return view('datamahasiswa.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'mahasiswaAlpha' => $mahasiswaAlpha, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $id_alpha)
    {
        $request->validate([
            'ni' => 'nullable|string|max:20',
            'jam_alpha' => 'nullable|integer',
            'nama' => 'nullable|string|max:100',
            'semester' => 'nullable|integer',
            'jam_kompen' => 'nullable|integer',
        ]);

        $mahasiswaAlpha = MahasiswaAlpha::findOrFail($id_alpha);
        $mahasiswaAlpha->update($request->all());

        return redirect('/datamahasiswa')->with('success', 'Data mahasiswa alpha berhasil diubah');
    }

    public function destroy($id_alpha)
    {
        $mahasiswaAlpha = MahasiswaAlpha::findOrFail($id_alpha);
        $mahasiswaAlpha->delete();

        return redirect('/datamahasiswa')->with('success', 'Data mahasiswa alpha berhasil dihapus');
    }
    public function import_ajax(Request $request)
    {
        $rules = [
            'file_mahasiswa' => ['required', 'mimes:xlsx,xls', 'max:1024'], // Allow both .xlsx and .xls
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $file = $request->file('file_mahasiswa');
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, false, true, true);
    
        // Logging the data for debugging
        Log::info('Imported Data:', $data);
    
        $insert = [];
    
        if (count($data) > 1) {
            foreach ($data as $baris => $value) {
                if ($baris > 1) {
                    // Insert data, trimming extra spaces
                    $insert[] = [
                        'ni' => trim($value['A']),
                        'nama' => trim($value['B']),
                        'semester' => (int) trim($value['C']), // Ensure this is an integer
                        'jam_alpha' => (int) trim($value['D']), // Ensure this is an integer
                        'jam_kompen' => (int) trim($value['E']), // Ensure this is an integer
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        
            // Check if the insert array is populated
            Log::info('Data to be inserted:', $insert);
        
            // Insert data into the database
            if (count($insert) > 0) {
                try {
                    MahasiswaAlpha::insertOrIgnore($insert);
                } catch (\Exception $e) {
                    Log::error('Error inserting data: ', ['error' => $e->getMessage()]);
                }
            }
        
            return redirect('/datamahasiswa')->with('success', 'Data mahasiswa berhasil diimport');
        }
        
    }
 
    public function export_excel()
    {
        // Retrieve all data to be exported
        $data = MahasiswaAlpha::all();
    
        // Load Excel library
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();  // Get active sheet
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIM');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Semester');
        $sheet->setCellValue('E1', 'Jam Alpha');
        $sheet->setCellValue('F1', 'Jam Kompen');
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);  // Bold header
    
        $no = 1;  // Data row number starts from 1
        $row = 2;  // Data starts from the second row
        foreach ($data as $key => $value) {
            $sheet->setCellValue('A'.$row, $value->id_alpha);
            $sheet->setCellValue('B'.$row, $value->ni);
            $sheet->setCellValue('C'.$row, $value->nama);
            $sheet->setCellValue('D'.$row, $value->semester);
            $sheet->setCellValue('E'.$row, $value->jam_alpha);
            $sheet->setCellValue('F'.$row, $value->jam_kompen);
            $row++;
            $no++;
        }
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // Set auto size for columns
        }
    
        $sheet->setTitle('Data Mahasiswa Alpha'); // Set sheet title
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Mahasiswa Alpha ' . date('Y-m-d H:i:s') . '.xlsx';
    
        // Clear output buffer to avoid any extra content in the file
        if (ob_get_contents()) ob_end_clean();
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
    
        $writer->save('php://output');
        exit;
    }
    

public function export_pdf()
{
    $data = MahasiswaAlpha::all();

    // Ensure the 'datamahasiswa.pdf' view exists
    $pdf = PDF::loadView('datamahasiswa.pdf', ['data' => $data]);

    // Return PDF response to prompt file download
    return $pdf->download('Data Mahasiswa Alpha ' . now()->format('Y-m-d H:i:s') . '.pdf');
}
}