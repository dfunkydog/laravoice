<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-family: Ubuntu,  Roboto,'Segoe UI', Oxygen,  Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 16px;
            background: #e8fcf9;
            color: #515151;
            padding 20px 0;
        }
        .content{
            max-width: 600px;
            margin: 0 auto;
            padding: 20px 40px;
            border: 1px dashed #c5ece6;
        }
        table {
            border-collapse: collapse;
            margin: 20px;
        }
        th, td {
            padding: 5px 10px;
            text-align: left;
            border-bottom: 1px solid #515151;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>