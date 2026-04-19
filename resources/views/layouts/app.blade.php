<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>STAGIO</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
        }

        header {
            background: #1e293b;
            color: white;
            padding: 15px;
        }

        .container {
            padding: 20px;
        }

        .card {
            background: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        button {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #2563eb;
        }

        .btn-danger {
            background: red;
        }

        .status {
            font-weight: bold;
        }

        .accepted { color: green; }
        .refused { color: red; }
        .pending { color: orange; }
    </style>
</head>

<body>

<header>
    <h2>STAGIO Platform</h2>
</header>

<div class="container">
    @yield('content')
</div>

</body>
</html>