<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dokumentasi Toko Online Ikan Hias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px auto;
            max-width: 900px;
            color: #222;
            background-color: #f9f9f9;
            line-height: 1.6;
        }
        h1, h2, h3 {
            text-align: center;
            margin-bottom: 0.5rem;
            color: #004d40;
        }
        h2 {
            margin-top: 2rem;
            border-bottom: 2px solid #004d40;
            padding-bottom: 0.25rem;
        }
        p.subtitle {
            text-align: center;
            font-style: italic;
            margin-top: -1rem;
            margin-bottom: 2rem;
            color: #555;
        }
        img.logo {
            display: block;
            margin: 0 auto 1rem auto;
            width: 250px;
            height: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0 2rem 0;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #004d40;
            color: #fff;
        }
        ul {
            margin: 0 0 1rem 1.2rem;
        }
        code {
            background-color: #e0f2f1;
            padding: 2px 5px;
            border-radius: 3px;
            font-family: monospace;
        }
        .section {
            margin-bottom: 3rem;
        }
        .relasi-table th, .relasi-table td {
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Toko Online Ikan Hias</h1>
    <img src="LOGO-USB.png" alt="Logo USB" class="logo" />
    <p class="subtitle">
        <strong>Shabir</strong><br />
        D0223306<br />
        Framework Web Based
    </p>

    <section class="section">
        <h2>Role dan Fitur</h2>

        <h3>1. Admin</h3>
        <ul>
            <li><strong>Fokus:</strong> Mengelola sistem dan pengguna</li>
            <li><strong>Fitur:</strong>
                <ul>
                    <li>CRUD data pengguna (user)</li>
                    <li>Mengelola role dan hak akses</li>
                    <li>Mengelola semua produk dan koleksi</li>
                    <li>Melihat semua pesanan dan statusnya</li>
                    <li>Melihat laporan transaksi</li>
                </ul>
            </li>
        </ul>

        <h3>2. Seller (Penjual)</h3>
        <ul>
            <li><strong>Fokus:</strong> Mengelola produk dan pesanan miliknya sendiri</li>
            <li><strong>Fitur:</strong>
                <ul>
                    <li>CRUD produk milik sendiri</li>
                    <li>Mengelola koleksi produk</li>
                    <li>Melihat pesanan yang terkait produknya</li>
                    <li>Update status pengiriman pesanan</li>
                    <li>Melihat status pembayaran pesanan miliknya</li>
                </ul>
            </li>
        </ul>

        <h3>3. Customer (Pembeli)</h3>
        <ul>
            <li><strong>Fokus:</strong> Belanja dan melacak pesanan</li>
            <li><strong>Fitur:</strong>
                <ul>
                    <li>Melihat daftar produk</li>
                    <li>Checkout dan pembayaran</li>
                    <li>Melihat riwayat pesanan</li>
                    <li>Melacak status pengiriman</li>
                </ul>
            </li>
        </ul>
    </section>

    <section class="section">
        <h2>Struktur Tabel Database</h2>

        <h3>Tabel: <code>penggunas</code></h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Field</th>
                    <th>Tipe Data</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>id</td><td>bigint</td><td>Primary key, auto increment</td></tr>
                <tr><td>nama</td><td>string</td><td>Nama lengkap pengguna</td></tr>
                <tr><td>email</td><td>string</td><td>Email unik pengguna</td></tr>
                <tr><td>email_verified_at</td><td>timestamp</td><td>Boleh null, waktu verifikasi email</td></tr>
                <tr><td>password</td><td>string</td><td>Password terenkripsi</td></tr>
                <tr><td>telepon</td><td>string</td><td>Boleh null, nomor telepon pengguna</td></tr>
                <tr><td>role</td><td>enum</td><td>admin / penjual / pembeli (default: pembeli)</td></tr>
                <tr><td>remember_token</td><td>string</td><td>Token untuk remember me</td></tr>
                <tr><td>created_at</td><td>timestamp</td><td>Waktu data dibuat</td></tr>
                <tr><td>updated_at</td><td>timestamp</td><td>Waktu data diubah</td></tr>
            </tbody>
        </table>

        <h3>Tabel: <code>koleksis</code></h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Field</th>
                    <th>Tipe Data</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
                <tr><td>nama</td><td>string</td><td>Nama koleksi produk</td></tr>
                <tr><td>created_at</td><td>timestamp</td><td>Waktu data dibuat</td></tr>
                <tr><td>updated_at</td><td>timestamp</td><td>Waktu data diubah</td></tr>
            </tbody>
        </table>

        <h3>Tabel: <code>produks</code></h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Field</th>
                    <th>Tipe Data</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
                <tr><td>nama</td><td>string</td><td>Nama produk</td></tr>
                <tr><td>deskripsi</td><td>text</td><td>Boleh null</td></tr>
                <tr><td>harga</td><td>decimal(10,2)</td><td>Harga produk</td></tr>
                <tr><td>stok</td><td>integer</td><td>Jumlah stok</td></tr>
                <tr><td>terjual</td><td>integer</td><td>Default 0, jumlah produk terjual</td></tr>
                <tr><td>gambar</td><td>string</td><td>Path gambar, boleh null</td></tr>
                <tr><td>pengguna_id</td><td>foreignId</td><td>Relasi ke tabel <code>penggunas</code> (penjual)</td></tr>
                <tr><td>koleksi_id</td><td>foreignId</td><td>Boleh null, relasi ke tabel <code>koleksis</code></td></tr>
                <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
                <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
                <tr><td>deleted_at</td><td>timestamp</td><td>Soft delete</td></tr>
            </tbody>
        </table>

        <h3>Tabel: <code>pesanans</code></h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Field</th>
                    <th>Tipe Data</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
                <tr><td>pengguna_id</td><td>foreignId</td><td>Relasi ke <code>penggunas</code> (customer)</td></tr>
                <tr><td>total_harga</td><td>decimal(10,2)</td><td>Total harga pesanan</td></tr>
                <tr><td>status</td><td>enum</td><td>menunggu / diproses / selesai</td></tr>
                <tr><td>alamat</td><td>text</td><td>Boleh null</td></tr>
                <tr><td>metode_pembayaran</td><td>string</td><td>Boleh null</td></tr>
                <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
                <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
                <tr><td>deleted_at</td><td>timestamp</td><td>Soft delete</td></tr>
            </tbody>
        </table>

        <h3>Tabel: <code>detail_pesanans</code></h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Field</th>
                    <th>Tipe Data</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
                <tr><td>pesanan_id</td><td>foreignId</td><td>Relasi ke <code>pesanans</code></td></tr>
                <tr><td>produk_id</td><td>foreignId</td><td>Relasi ke <code>produks</code></td></tr>
                <tr><td>jumlah</td><td>integer</td><td>Jumlah produk dibeli</td></tr>
                <tr><td>harga_satuan</td><td>decimal(10,2)</td><td>Harga per unit produk</td></tr>
                <tr><td>subtotal</td><td>decimal(10,2)</td><td>harga_satuan × jumlah</td></tr>
                <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
                <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
            </tbody>
        </table>

        <h3>Tabel: <code>pembayarans</code></h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Field</th>
                    <th>Tipe Data</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
                <tr><td>pesanan_id</td><td>foreignId</td><td>Relasi ke <code>pesanans</code></td></tr>
                <tr><td>jumlah</td><td>decimal(10,2)</td><td>Jumlah pembayaran</td></tr>
                <tr><td>metode</td><td>string</td><td>Metode pembayaran</td></tr>
                <tr><td>status</td><td>enum</td><td>belum dibayar / sudah dibayar</td></tr>
                <tr><td>bukti_pembayaran</td><td>string</td><td>Boleh null</td></tr>
                <tr><td>verifikasi_admin</td><td>enum</td><td>menunggu / disetujui / ditolak (default: menunggu)</td></tr>
                <tr><td>verifikasi_at</td><td>timestamp</td><td>Boleh null</td></tr>
                <tr><td>diteruskan_ke_penjual</td><td>boolean</td><td>Default false, status diteruskan ke penjual</td></tr>
                <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
                <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
            </tbody>
        </table>

        <h3>Tabel: <code>pengirimans</code></h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Field</th>
                    <th>Tipe Data</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
                <tr><td>pesanan_id</td><td>foreignId</td><td>Relasi ke <code>pesanans</code></td></tr>
                <tr><td>nama_penerima</td><td>string</td><td>Nama penerima</td></tr>
                <tr><td>alamat</td><td>string</td><td>Alamat lengkap</td></tr>
                <tr><td>kota</td><td>string</td><td>Kota tujuan</td></tr>
                <tr><td>kode_pos</td><td>string</td><td>Kode pos</td></tr>
                <tr><td>kurir</td><td>string</td><td>Nama kurir</td></tr>
                <tr><td>no_resi</td><td>string</td><td>Boleh null</td></tr>
                <tr><td>status</td><td>enum</td><td>belum dikirim / dikirim / diterima</td></tr>
                <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
                <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
            </tbody>
        </table>
    </section>

    <section class="section">
        <h2>Relasi Antar Tabel</h2>
        <table class="relasi-table">
            <thead>
                <tr>
                    <th>Relasi Tabel</th>
                    <th>Jenis Relasi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>penggunas → produks</td><td>One to Many</td><td>Penjual bisa memiliki banyak produk</td></tr>
                <tr><td>penggunas → pesanans</td><td>One to Many</td><td>Customer bisa membuat banyak pesanan</td></tr>
                <tr><td>koleksis → produks</td><td>One to Many</td><td>Satu koleksi bisa memiliki banyak produk</td></tr>
                <tr><td>produks → detail_pesanans</td><td>One to Many</td><td>Satu produk bisa muncul di banyak item pesanan</td></tr>
                <tr><td>pesanans → detail_pesanans</td><td>One to Many</td><td>Satu pesanan bisa memiliki banyak item</td></tr>
                <tr><td>pesanans → pembayarans</td><td>One to One</td><td>Satu pesanan memiliki satu pembayaran</td></tr>
                <tr><td>pesanans → pengirimans</td><td>One to One</td><td>Satu pesanan memiliki satu pengiriman</td></tr>
            </tbody>
        </table>
    </section>

</body>
</html>
