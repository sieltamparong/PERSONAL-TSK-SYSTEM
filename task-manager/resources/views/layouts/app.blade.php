<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>
    <style>
        * { 
        margin: 0; 
        padding: 0; 
        box-sizing: border-box; 
        font-family: sans-serif; 
    }
        body { 
        background: #f4f4f9; 
        padding: 2rem; 
        max-width: 1000px; 
        margin: 0 auto; 
    }
        h1 { 
        color: #333; 
        margin-bottom: 2rem; 
        text-align: center; 
    }
        .btn { 
        display: inline-block; 
        padding: 0.5rem 1rem; 
        border-radius: 4px; 
        text-decoration: none; 
        margin: 0.25rem; 
        border: none; 
        cursor: pointer; 
    }
        .btn-primary { 
        background: #2563eb; 
        color: white; 
    }
        .btn-success { 
        background: #16a34a; 
        color: white; 
    }
        .btn-warning { 
        background: #f59e0b; 
        color: white; 
    }
        .btn-danger { 
        background: #dc2626; 
        color: white; 
    }
        .alert { 
        padding: 1rem; 
        margin-bottom: 1rem; 
        border-radius: 4px; 
        background: #dcfce7; 
        color: #166534; 
    }
        .card { 
        background: white; 
        padding: 1.5rem; 
        border-radius: 8px; 
        margin-bottom: 1rem; 
        box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
    }
        .form-group { 
        margin-bottom: 1rem; 
    }
        label { 
        display: block; 
        margin-bottom: 0.5rem; 
        font-weight: bold; 
    }
        input, textarea, select { 
            width: 100%; 
            padding: 0.75rem; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
        }
        .status-pending { 
            color: #d97706; 
            font-weight: bold; 
        }
        .status-completed { 
            color: #16a34a; 
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <h1>📋 Personal Task Manager</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @yield('content')
</body>
</html>
