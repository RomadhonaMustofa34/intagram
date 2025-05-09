<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Archive PDF</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #007bff;
            color: white;
        }

        th, td {
            text-align: left;
            padding: 12px 10px;
            border: 1px solid #dee2e6;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        img {
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
                            <img src="{{ public_path('storage/' . $feed->media) }}" alt="Media" style="width: 100px;">
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
