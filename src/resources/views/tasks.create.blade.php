<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📝 Gestor de Tareas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body { font-family: "Roboto", sans-serif; background-color: #f3f4f6; }
        .view { display: none; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-500': '#4f46e5', // Indigo
                        'success-500': '#10b981', // Green
                        'danger-500': '#ef4444', // Red
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen p-4 sm:p-8">
    
</body>
</html>