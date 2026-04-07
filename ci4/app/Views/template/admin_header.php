<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : ''; ?>Admin Panel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }
        
        header {
            background-color: #dc3545;
            color: #fff;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        
        header h1 {
            margin-left: 2rem;
            font-size: 1.8rem;
        }
        
        nav {
            background-color: #c82333;
            padding: 0.5rem 0;
            margin-bottom: 1rem;
        }
        
        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 2rem;
            padding: 0.5rem;
            display: inline-block;
        }
        
        nav a:hover {
            background-color: #bd2130;
            border-radius: 3px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 3px;
            border: none;
            cursor: pointer;
            margin-bottom: 1rem;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
        
        .btn-danger {
            background-color: #dc3545;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
        }
        
        .btn-large {
            padding: 1rem 2rem;
            font-size: 1.1rem;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .table thead {
            background-color: #dc3545;
            color: white;
        }
        
        .table th {
            padding: 1rem;
            text-align: left;
            font-weight: bold;
        }
        
        .table td {
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }
        
        .table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        form p {
            margin-bottom: 1rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-family: Arial, sans-serif;
            font-size: 1rem;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        
        textarea {
            resize: vertical;
            min-height: 200px;
        }
        
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 3px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <header>
        <h1>🔐 Admin Panel - Manajemen Artikel</h1>
    </header>
    
    <nav>
        <a href="<?= base_url('/'); ?>">Home</a>
        <a href="<?= base_url('/artikel'); ?>">Artikel</a>
        <a href="<?= base_url('/admin/artikel'); ?>">Admin</a>
        
        <?php if(session()->get('logged_in')): ?>
            <div class="user-info" style="float: right; margin-right: 2rem;">
                <span style="color: #fff; margin-right: 1rem;">
                    Welcome, <strong><?= session()->get('user_name'); ?></strong>
                </span>
                <a href="<?= base_url('/user/dashboard'); ?>" class="btn-small">Dashboard</a>
                <a href="<?= base_url('/user/logout'); ?>" class="btn-small btn-danger">Logout</a>
            </div>
        <?php endif; ?>
    </nav>
    
    <div class="container">
