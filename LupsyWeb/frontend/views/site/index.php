<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
</head>
<body>

<!-- Header Section -->
<header>
    <div class="logo">
        <h1>Cervejaria LUPSY</h1>
    </div>
    <div class="menu-icon">
        <button>&#9776;</button>
    </div>
</header>

<!-- Banner Section -->
<section class="banner">
    <div class="banner-content">
        <img src="CervejariaLupsy/ULupsyWeb/frontend/web/img/capaCEV.png" alt="Cervejaria Lupsy Banner" class="banner-img">
        <div class="overlay">
            <button>Descobrir</button>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="main-content">
    <div class="content-row">
        <img src="LupsyWeb\frontend\web\img\meioCEV.png" alt="Bar Scene" class="main-img">
        <div class="text-content">
            <h2>Your Title Here</h2>
            <p>Your description or text goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
    </div>

    <div class="grid">
        <div class="grid-item">
            <img src="your-second-image-path-here" alt="IBU" class="grid-img">
            <h3>IBU</h3>
            <p>Short description about IBU.</p>
            <a href="#">Learn More &raquo;</a>
        </div>
        <div class="grid-item">
            <img src="your-third-image-path-here" alt="Teor de Álcool" class="grid-img">
            <h3>Teor de Álcool</h3>
            <p>Short description about alcohol content.</p>
            <a href="#">Learn More &raquo;</a>
        </div>
    </div>
</section>

</body>

<style>* {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        background-color: #f5f5f5;
        }
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #000;
        color: #fff;
        padding: 10px 20px;
    }

    .logo h1 {
        font-size: 24px;
        font-weight: bold;
    }

    .menu-icon button {
        font-size: 24px;
        background: none;
        border: none;
        color: #fff;
        cursor: pointer;
    }

    .banner {
        position: relative;
        margin-top: 20px;
    }

    .banner img {
        width: 100%;
        height: auto;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .overlay h1 {
        font-size: 48px;
        margin-bottom: 10px;
    }

    .overlay p {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .overlay button {
        padding: 10px 20px;
        font-size: 18px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .main-content {
        padding: 20px;
    }

    .content-row {
        display: flex;
        align-items: center;
        margin-bottom: 40px;
    }

    .main-img {
        width: 50%;
        height: auto;
    }

    .text-content {
        width: 50%;
        padding: 20px;
    }

    .text-content h2 {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .text-content p {
        font-size: 16px;
        line-height: 1.5;
    }

    .grid {
        display: flex;
        justify-content: space-between;
    }

    .grid-item {
        width: 45%;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        text-align: center;
    }

    .grid-item img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .grid-item h3 {
        font-size: 22px;
        margin: 10px 0;
    }

    .grid-item p {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .grid-item a {
        font-size: 16px;
        color: #000;
        text-decoration: none;
    }

    .grid-item a:hover {
        text-decoration: underline;
    }</style>
</html>
