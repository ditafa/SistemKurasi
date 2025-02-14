<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(180deg, #1a47a0 0%, #3464c4 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .logo {
            color: white;
            padding: 10px;
            font-weight: bold;
        }

        .header {
            color: white;
            text-align: center;
            margin: 20px 0;
        }

        .header p {
            font-size: 14px;
            margin-top: 10px;
            opacity: 0.8;
        }

        .search-container {
            max-width: 800px;
            margin: 20px auto;
            display: flex;
            gap: 10px;
        }

        .search-box {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: white;
            display: flex;
            align-items: center;
        }

        .search-box input {
            flex: 1;
            border: none;
            outline: none;
            padding: 5px;
            margin-left: 10px;
        }

        .filter-button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background: white;
            cursor: pointer;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-info {
            margin-top: 10px;
        }

        .product-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-price {
            color: #666;
            font-size: 14px;
        }

        .buy-button {
            background: #1a47a0;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
        }

        .detail-section {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            border-radius: 15px;
            padding: 20px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 20px;
        }

        .detail-image {
            width: 100%;
            border-radius: 10px;
        }

        .size-tags {
            display: flex;
            gap: 10px;
            margin: 10px 0;
        }

        .size-tag {
            padding: 5px 15px;
            border-radius: 15px;
            background: #f0f0f0;
            font-size: 12px;
        }

        .timeline {
            margin-top: 30px;
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #ddd;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-dot {
            position: absolute;
            left: -30px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #1a47a0;
            top: 5px;
        }

        .footer {
            text-align: center;
            color: white;
            margin-top: 20px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="logo">LOGO</div>
    
    <div class="header">
        <h1>Daftar Produk</h1>
        <p>admin dapat menjaga setiap produk yang diupload serta memastikan kondisi pengiriman status pesanan konsumen.</p>
    </div>

    <div class="search-container">
        <div class="search-box">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" placeholder="Search...">
        </div>
        <button class="filter-button">Filter</button>
    </div>

    <div class="products-grid">
        <div class="product-card">
            <img src="https://www.consina.com/wp-content/uploads/2021/08/Trentino-DBL-2021-1600x1600.jpg" alt="Kemeja Salur" class="product-image">
            <div class="product-info">
                <div class="product-name">Kemeja Salur</div>
                <div class="product-price">Rp. 300.000</div>
                <button class="buy-button">Detail</button>
            </div>
        </div>
        <div class="product-card">
            <img src="https://www.consina.com/wp-content/uploads/2021/08/Trentino-DBL-2021-1600x1600.jpg" alt="Rok Cokelat" class="product-image">
            <div class="product-info">
                <div class="product-name">Rok Cokelat</div>
                <div class="product-price">Rp. 250.000</div>
                <button class="buy-button">Detail</button>
            </div>
        </div>
        <div class="product-card">
            <img src="https://www.consina.com/wp-content/uploads/2021/08/Trentino-DBL-2021-1600x1600.jpg" alt="Pashmina Polos" class="product-image">
            <div class="product-info">
                <div class="product-name">Pashmina Polos</div>
                <div class="product-price">Rp. 150.000</div>
                <button class="buy-button">Detail</button>
            </div>
        </div>
    </div>

    <div class="detail-section">
        <div class="detail-grid">
            <img src="https://www.consina.com/wp-content/uploads/2021/08/Trentino-DBL-2021-1600x1600.jpg" alt="Kemeja Salur Detail" class="detail-image">
            <div>
                <h2>Kemeja Salur</h2>
                <p>Fresh modern fit</p>
                <div class="size-tags">
                    <span class="size-tag">Size S</span>
                    <span class="size-tag">Size M</span>
                    <span class="size-tag">Size L</span>
                </div>
                <p>Deskripsi Produk:</p>
                <p>Kemeja dengan motif salur, bahan halus dan nyaman dipakai. Jahitan rapi, bahan tidak luntur, tersedia dalam berbagai ukuran.</p>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <h4>Pesanan</h4>
                        <p>Status diubah oleh pengurusi</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <h4>Kirim</h4>
                        <p>Admin memulai status untuk dikirimkan produk</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <h4>Selesai</h4>
                        <p>Produk telah di terkitim</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>