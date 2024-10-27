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
    <h2>Dam Report</h2>
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
            @foreach($dams as $dam)
                <tr>
                    <td>{{ $dam->dam_name }}({{ $dam->river_name}})</td>
                    <td>{{ $dam->latest_debit_report ? $dam->latest_debit_report->limpas : '' }}</td>
                    <td>{{ $dam->latest_debit_report ? $dam->latest_debit_report->debit : '' }}</td>
                    <td>{{ $dam->status }}</td>
                    <td>{{ $dam->latest_debit_report ? $dam->latest_debit_report->cuaca : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
