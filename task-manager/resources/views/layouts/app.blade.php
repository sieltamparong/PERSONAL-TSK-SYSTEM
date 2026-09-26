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
        background: linear-gradient(135deg, #F7CAC9 0%, #D5D6EA 50%, #B3CEE5 100%);
        padding: 7rem; 
        max-width: 1000px; 
        margin: 0 auto; 
    }
        h1 { 
        color: #002f75; 
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
        background: #225ad4; 
        color: white; 
    }
        .btn-success { 
        background: #0f8797; 
        color: black; 
    }
        .btn-warning { 
        background: #a73c3c; 
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
        background: #d155d1,; 
        padding: 1.5rem; 
        border-box: 10px;
        border-color: black;
        margin-bottom: 1rem; 
        box-shadow: 5px 5px rgba(0,0,0,0.1); 
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
            color: #804edd; 
            font-weight: bold; 
        }
        .status-completed { 
            color: #412cff; 
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
