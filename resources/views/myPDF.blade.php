<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Date: {{ $date }}</p>
    <p>This is a PDF generated with Laravel using the DomPDF library.</p>
</body>
</html>
