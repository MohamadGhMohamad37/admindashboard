<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product PDF</title>
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
    <h1>Product Details</h1>
    <table>
        <tr>
            <th>ID</th>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>Name (En)</th>
            <td>{{ $product->name_en }}</td>
        </tr>
        <tr>
            <th>Name (De)</th>
            <td>{{ $product->name_de }}</td>
        </tr>
        <tr>
            <th>Name (Fr)</th>
            <td>{{ $product->name_fr }}</td>
        </tr>
        <tr>
            <th>Name (Tr)</th>
            <td>{{ $product->name_tr }}</td>
        </tr>
        <tr>
            <th>Name (Ar)</th>
            <td>{{ $product->name_ar }}</td>
        </tr>
        <tr>
            <th>Name (Zh)</th>
            <td>{{ $product->name_zh }}</td>
        </tr>
        <tr>
            <th>Description (En)</th>
            <td>{!! $product->description_en !!}</td>
        </tr>
        <tr>
            <th>Description (De)</th>
            <td>{!! $product->description_de !!}</td>
        </tr>
        <tr>
            <th>Description (Fr)</th>
            <td>{!! $product->description_fr !!}</td>
        </tr>
        <tr>
            <th>Description (Tr)</th>
            <td>{!! $product->description_tr !!}</td>
        </tr>
        <tr>
            <th>Description (Ar)</th>
            <td>{!! $product->description_ar !!}</td>
        </tr>
        <tr>
            <th>Description (Zh)</th>
            <td>{!! $product->description_zh !!}</td>
        </tr>
        <tr>
            <th>Sub Category</th>
            <td>{{ $product->subCategory->name_en }}</td>
        </tr>
        <tr>
            <th>price</th>
            <td>{{ $product->price }}</td>
        </tr>
    </table>
</body>
</html>
