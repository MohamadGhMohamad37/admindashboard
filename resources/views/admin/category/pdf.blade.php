<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Category PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Category Details</h1>
    <table>
        <tr>
            <th>ID</th>
            <td>{{ $category->id }}</td>
        </tr>
        <tr>
            <th>Name (En)</th>
            <td>{{ $category->name_en }}</td>
        </tr>
        <tr>
            <th>Name (De)</th>
            <td>{{ $category->name_de }}</td>
        </tr>
        <tr>
            <th>Name (Fr)</th>
            <td>{{ $category->name_fr }}</td>
        </tr>
        <tr>
            <th>Name (Tr)</th>
            <td>{{ $category->name_tr }}</td>
        </tr>
        <tr>
            <th>Name (Ar)</th>
            <td>{{ $category->name_ar }}</td>
        </tr>
        <tr>
            <th>Name (Zh)</th>
            <td>{{ $category->name_zh }}</td>
        </tr>
        <tr>
            <th>Description (En)</th>
            <td>{!! $category->description_en !!}</td>
        </tr>
        <tr>
            <th>Description (De)</th>
            <td>{!! $category->description_de !!}</td>
        </tr>
        <tr>
            <th>Description (Fr)</th>
            <td>{!! $category->description_fr !!}</td>
        </tr>
        <tr>
            <th>Description (Tr)</th>
            <td>{!! $category->description_tr !!}</td>
        </tr>
        <tr>
            <th>Description (Ar)</th>
            <td>{!! $category->description_ar !!}</td>
        </tr>
        <tr>
            <th>Description (Zh)</th>
            <td>{!! $category->description_zh !!}</td>
        </tr>
    </table>
</body>
</html>
