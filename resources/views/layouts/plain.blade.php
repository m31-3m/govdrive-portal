<!DOCTYPE html>
<html>
<head>
    <title>GovDrive - Logic Test</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .form-group { margin-bottom: 15px; border: 1px solid #ddd; padding: 15px; }
        button { cursor: pointer; padding: 5px 10px; background: #e1e1e1; border: 1px solid #999; }
        .btn-delete { color: white; background: red; border: none; }
        .btn-submit { background: green; color: white; padding: 10px; border: none; }
    </style>
</head>
<body>
    <nav>
        <strong>Logged in as: {{ Auth::user()->name }}</strong> | 
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
    <hr>
    @yield('content')
</body>
</html>