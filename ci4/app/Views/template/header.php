<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title . ' - ' : ''; ?>Artikel</title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
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
            background-color: #333;
            color: #fff;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        
        header h1 {
            margin-left: 2rem;
            font-size: 1.8rem;
        }
        
        nav {
            background-color: #555;
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
            background-color: #777;
            border-radius: 3px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .entry {
            background: white;
            padding: 2rem;
            margin-bottom: 2rem;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .entry h2 {
            margin-bottom: 1rem;
            color: #333;
        }
        
        .entry h2 a {
            color: #0066cc;
            text-decoration: none;
        }
        
        .entry h2 a:hover {
            text-decoration: underline;
        }
        
        .entry img {
            max-width: 100%;
            height: auto;
            margin-bottom: 1rem;
            border-radius: 5px;
        }
        
        .divider {
            border: none;
            border-top: 2px solid #ddd;
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    <div id="container">
        <header>
            <h1>Layout Sederhana</h1>
        </header>
        <nav>
            <a href="<?= base_url('/');?>" class="active">Home</a>
            <a href="<?= base_url('/artikel');?>">Artikel</a>
            <a href="<?= base_url('/about');?>">About</a>
            <a href="<?= base_url('/contact');?>">Kontak</a>
        </nav>
        <section id="wrapper">
            <section id="main">
                <div class="container">
