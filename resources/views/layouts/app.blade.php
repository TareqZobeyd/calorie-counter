<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>کالری شمار</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nutrition-item {
            text-align: center;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
        }
        .nutrition-value {
            font-size: 1.2em;
            font-weight: bold;
            color: #007bff;
        }
        .results-section {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
        .error-section {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #dc3545;
            border-radius: 8px;
            background-color: #f8d7da;
        }
        .loading {
            display: none;
        }
        .loading.show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        @yield('content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // CSRF Token برای AJAX
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
    </script>
    @yield('scripts')
</body>
</html>
