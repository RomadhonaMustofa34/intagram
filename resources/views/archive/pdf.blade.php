<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archive PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Archive Post</h2>
    <table>
        <thead>
            <tr>
                <th>Media</th>
                <th>Tanggal Post</th>
                <th>Caption</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feeds as $feed)
                <tr>
                    <td>
                        @if (Str::contains($feed->media, ['.mp4', '.mov']))
                            Video: {{ $feed->media }}
                        @else
                            <img src="{{ public_path('storage/' . $feed->media) }}" 
                                alt="Media" style="width: 100px; height: auto;">
                        @endif
                    </td>
                    <td>{{ $feed->created_at->format('d M Y') }}</td>
                    <td>{{ $feed->caption }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
