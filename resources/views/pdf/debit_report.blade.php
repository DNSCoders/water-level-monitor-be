
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Rekapitulasi Pantauan Waduk dan Bendung</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { 
            text-align: center;
            margin-bottom: 20px;
            display : flex;
            border-bottom: 4px solid black;
        }
        h3{ text-align:center;}
        p{ margin-top: 2px;font-size:14px;}
        .header img { height: 60px; }
        .table-body { width: 100%; border-collapse: collapse; }
        .table-body th, .table-body td { border: 1px solid #005f72; padding: 5px; text-align: left;vertical-align: text-top;font-size:14px; }
        th{ background-color:#A6A6A6;padding:10px;font-weight:normal;}
        td{ text-align:left;vertical-align: text-top;}
        .bg-blue { background-color: #63C1D4; color:white;padding:10px;margin-bottom:25px; }
        .bold { font-weight: bold; }
        .signature {
            text-align: center;
            margin-top: 50px;
            color: #005f72; /* Warna teks */
            position: absolute;
            font-weight:bold;
            font-size:16px;
            right:0;
        }

        /* Membuat div tanda tangan berada di bagian bawah halaman */
        .signature-container {
            width: 100%;
            position: relative;
            bottom: 20px;
        }
    </style>
</head>
<body>
    <table style="width: 100%;border-collapse:collapse;border:none;table-layout:fixed;">
        <tr>
            <td style="vertical-align:middle;width:15%;">
                <img src="{{ public_path('logo.png') }}" alt="Logo" style="height:90px;object-fit:contain;">
            </td>
            <td>
                <h4 style="margin-bottom:1px;text-align:center;">PEMERINTAH PROVINSI JAWA TENGAH <br/> DINAS PEKERJAAN UMUM SUMBER DAYA AIR<br/> BALAI PENGELOLAAN SUMBER DAYA AIR PEMALI COMAL</h4>
                <p style="text-align:center;">
                    Jl. Dr. Sutomo No 53, Telp: (0283) 351011 - 356259
                    <br>
                    Faksimile 02883-356259 Email : balaipsdapc53@gmail.com
                </p>
            </td>
            <td style="vertical-align:middle;width:15%;"></td>
        </tr>
    </table>
    <div class="header">
    <!-- <img src="{{asset('images/user.png')}}" alt="Logo" height="75px"> -->
       
    </div>

    <h4 style="color:#005f72;text-align:center;">REKAPITULASI PANTAUAN WADUK DAN BENDUNG KONTROL POINT<br>WILAYAH BALAI PSDA PEMALI COMAL</h4>
    <div style="padding:0 20% 0 20%;text-align:center;">
        <div class="bg-blue bold">Tanggal: {{ $date }}</div>
    </div>
    <table class='table-body'>
        <thead>
            <tr>
                <th>No</th>
                <th>Jam</th>
                <th>Nama Bendung</th>
                <th>Limpas</th>
                <th>Debit</th>
                <th>Cuaca</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            {{ $no =1;}}
            @foreach($data as $dam)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $dam->created_at->format('d F Y H:i')}}</td>
                    <td>{{ $dam->dam->dam_name }}({{ $dam->dam->river_name}})</td>
                    <td>{{ $dam->limpas ? $dam->limpas.' m' : '' }}</td>
                    <td>{{ $dam->debit ? $dam->debit.' m3/dtk' : '' }} </td>
                    <td>{{ $dam->cuaca ? $dam->cuaca : '' }}</td>
                    <td>{{ $dam->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="signature-container">
        <div class="signature">
            Tegal, {{ now()->format('d F Y') }}<br><br>
            Ttd<br>
            Koordinator Banjir
        </div>
    </div>
</body>
</html>
