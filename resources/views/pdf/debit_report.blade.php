<!DOCTYPE html>
<html>
<head>
    <title>Dam Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Bendung</th>
                <th>Limpas</th>
                <th>Debit</th>
                <th>Status</th>
                <th>Cuaca</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $dt)
                <tr>
                    <td>{{ $dt->dam->dam_name }}({{ $dt->dam->river_name}})</td>
                    <td>{{ $dt->limpas }}</td>
                    <td>{{ $dt->debit }}</td>
                    <td>{{ $dt->status }}</td>
                    <td>{{ $dt->cuaca }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
