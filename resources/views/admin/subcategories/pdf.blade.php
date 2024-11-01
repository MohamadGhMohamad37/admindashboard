<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sub Category PDF</title>
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
    <h1>Sub Category Details</h1>
    <table>
        <tr>
            <th>ID</th>
            <td>{{ $subcategory->id }}</td>
        </tr>
        <tr>
            <th>Name (En)</th>
            <td>{{ $subcategory->name_en }}</td>
        </tr>
        <tr>
            <th>Name (De)</th>
            <td>{{ $subcategory->name_de }}</td>
        </tr>
        <tr>
            <th>Name (Fr)</th>
            <td>{{ $subcategory->name_fr }}</td>
        </tr>
        <tr>
            <th>Name (Tr)</th>
            <td>{{ $subcategory->name_tr }}</td>
        </tr>
        <tr>
            <th>Name (Ar)</th>
            <td>{{ $subcategory->name_ar }}</td>
        </tr>
        <tr>
            <th>Name (Zh)</th>
            <td>{{ $subcategory->name_zh }}</td>
        </tr>
        <tr>
            <th>Description (En)</th>
            <td>{!! $subcategory->description_en !!}</td>
        </tr>
        <tr>
            <th>Description (De)</th>
            <td>{!! $subcategory->description_de !!}</td>
        </tr>
        <tr>
            <th>Description (Fr)</th>
            <td>{!! $subcategory->description_fr !!}</td>
        </tr>
        <tr>
            <th>Description (Tr)</th>
            <td>{!! $subcategory->description_tr !!}</td>
        </tr>
        <tr>
            <th>Description (Ar)</th>
            <td>{!! $subcategory->description_ar !!}</td>
        </tr>
        <tr>
            <th>Description (Zh)</th>
            <td>{!! $subcategory->description_zh !!}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $subcategory->category->name_en }}</td>
        </tr>
    </table>
</body>
</html>
