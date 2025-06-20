<h3 align="center">Toko Online Ikan Hias</h3>
<br><br><br>

<p align="center">
  <img src="LOGO-USB.png" width="250px" />
</p>

<br><br><br>

<p align="center"><strong>Shabir</strong><br/>
D0223306<br/><br/>
Framework Web Based<br/></p>

---

<h2>Role dan Fitur</h2>

<h3>1.1 Admin</h3>
<ul>
  <li><strong>Fokus:</strong><br> Mengelola sistem dan pengguna</li>
  <li><strong>Fitur:</strong>
    <ul>
      <li>Mengelola data pengguna (CRUD user)</li>
      <li>Mengelola role dan hak akses</li>
      <li>Mengelola semua produk</li>
      <li>Melihat semua pesanan dan status</li>
      <li>Melihat laporan transaksi</li>
    </ul>
  </li>
</ul>

<h3>1.2 Penjual (Seller)</h3>
<ul>
  <li><strong>Fokus:</strong><br> Mengelola produk & pesanan sendiri</li>
  <li><strong>Fitur:</strong>
    <ul>
      <li>CRUD produk milik sendiri (produks)</li>
      <li>Melihat pesanan masuk terkait produknya (pesanans, detail_pesanans)</li>
      <li>Update status pengiriman (pengirimans)</li>
      <li>Melihat pembayaran pesanan miliknya (pembayarans)</li>
    </ul>
  </li>
</ul>

<h3>1.3 Pembeli (Customer)</h3>
<ul>
  <li><strong>Fokus:</strong><br> Belanja dan melacak pesanan</li>
  <li><strong>Fitur:</strong>
    <ul>
      <li>Melihat daftar produk (produks)</li>
      <li>Checkout dan pembayaran (pesanans, detail_pesanans, pembayarans)</li>
      <li>Melihat riwayat pesanan (pesanans)</li>
      <li>Melacak status pengiriman (pengirimans)</li>
      <li>Mengelola keranjang belanja (keranjangs)</li>
      <li>Membuat ulasan produk (ulasans)</li>
    </ul>
  </li>
</ul>

---


<h2>Struktur Tabel Database</h2>

<h2>1. Tabel: penggunas</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Nama Field</th>
    <th>Tipe Data</th>
    <th>Keterangan</th>
  </tr>
  <tr><td>id</td><td>bigint, primary key</td><td>ID pengguna</td></tr>
  <tr><td>nama</td><td>string</td><td>Nama lengkap pengguna</td></tr>
  <tr><td>email</td><td>string, unique</td><td>Email unik</td></tr>
  <tr><td>password</td><td>string</td><td>Password terenkripsi</td></tr>
  <tr><td>role</td><td>enum('admin','penjual','pembeli')</td><td>Role user, default 'pembeli'</td></tr>
  <tr><td>verifikasi</td><td>enum('menunggu','disetujui','ditolak')</td><td>Status verifikasi penjual, default 'menunggu'</td></tr>
  <tr><td>nama_toko</td><td>string, nullable</td><td>Nama toko (untuk penjual)</td></tr>
  <tr><td>alamat</td><td>text, nullable</td><td>Alamat lengkap pengguna</td></tr>
  <tr><td>no_wa</td><td>string, nullable</td><td>Nomor WhatsApp pengguna</td></tr>
  <tr><td>remember_token</td><td>string, nullable</td><td>Token remember me</td></tr>
  <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
  <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
</table>

<h2>2. Tabel: produks</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Nama Field</th>
    <th>Tipe Data</th>
    <th>Keterangan</th>
  </tr>
  <tr><td>id</td><td>bigint, primary key</td><td>ID produk</td></tr>
  <tr><td>nama</td><td>string</td><td>Nama produk</td></tr>
  <tr><td>deskripsi</td><td>text, nullable</td><td>Deskripsi produk</td></tr>
  <tr><td>harga</td><td>decimal(10,2)</td><td>Harga produk</td></tr>
  <tr><td>stok</td><td>integer</td><td>Jumlah stok</td></tr>
  <tr><td>terjual</td><td>integer, default 0</td><td>Jumlah produk terjual</td></tr>
  <tr><td>gambar</td><td>string, nullable</td><td>Nama file gambar produk</td></tr>
  <tr><td>pengguna_id</td><td>bigint, foreign key</td><td>ID penjual (penggunas.id)</td></tr>
  <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
  <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
  <tr><td>deleted_at</td><td>timestamp, nullable</td><td>Soft delete</td></tr>
</table>

<h2>3. Tabel: pesanans</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Nama Field</th>
    <th>Tipe Data</th>
    <th>Keterangan</th>
  </tr>
  <tr><td>id</td><td>bigint, primary key</td><td>ID pesanan</td></tr>
  <tr><td>pengguna_id</td><td>bigint, foreign key</td><td>ID pembeli (penggunas.id)</td></tr>
  <tr><td>total_harga</td><td>decimal(10,2)</td><td>Total harga seluruh pesanan</td></tr>
  <tr><td>status</td><td>enum('menunggu','diproses','selesai')</td><td>Status pesanan</td></tr>
  <tr><td>alamat</td><td>text, nullable</td><td>Alamat pengiriman</td></tr>
  <tr><td>metode_pembayaran</td><td>string, nullable</td><td>Metode pembayaran</td></tr>
  <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
  <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
  <tr><td>deleted_at</td><td>timestamp, nullable</td><td>Soft delete</td></tr>
</table>

<h2>4. Tabel: detail_pesanans</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Nama Field</th>
    <th>Tipe Data</th>
    <th>Keterangan</th>
  </tr>
  <tr><td>id</td><td>bigint, primary key</td><td>ID detail pesanan</td></tr>
  <tr><td>pesanan_id</td><td>bigint, foreign key</td><td>ID pesanan</td></tr>
  <tr><td>produk_id</td><td>bigint, foreign key</td><td>ID produk</td></tr>
  <tr><td>jumlah</td><td>integer</td><td>Jumlah produk dipesan</td></tr>
  <tr><td>harga_satuan</td><td>decimal(10,2)</td><td>Harga per satuan</td></tr>
  <tr><td>subtotal</td><td>decimal(10,2)</td><td>Jumlah × harga satuan</td></tr>
  <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
  <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
</table>

<h2>5. Tabel: pembayarans</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Nama Field</th>
    <th>Tipe Data</th>
    <th>Keterangan</th>
  </tr>
  <tr><td>id</td><td>bigint, primary key</td><td>ID pembayaran</td></tr>
  <tr><td>pesanan_id</td><td>bigint, foreign key</td><td>ID pesanan</td></tr>
  <tr><td>jumlah</td><td>decimal(10,2)</td><td>Jumlah dibayar</td></tr>
  <tr><td>metode</td><td>string</td><td>Metode pembayaran</td></tr>
  <tr><td>status</td><td>enum('belum dibayar','sudah dibayar')</td><td>Status pembayaran</td></tr>
  <tr><td>bukti_pembayaran</td><td>string, nullable</td><td>File bukti pembayaran</td></tr>
  <tr><td>verifikasi_admin</td><td>enum('menunggu','disetujui','ditolak')</td><td>Status verifikasi admin</td></tr>
  <tr><td>verifikasi_at</td><td>timestamp, nullable</td><td>Waktu verifikasi</td></tr>
  <tr><td>diteruskan_ke_penjual</td><td>boolean, default false</td><td>Status diteruskan ke penjual</td></tr>
  <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
  <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
</table>

<h2>6. Tabel: pengirimans</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Nama Field</th>
    <th>Tipe Data</th>
    <th>Keterangan</th>
  </tr>
  <tr><td>id</td><td>bigint, primary key</td><td>ID pengiriman</td></tr>
  <tr><td>pesanan_id</td><td>bigint, foreign key</td><td>ID pesanan</td></tr>
  <tr><td>nama_penerima</td><td>string</td><td>Nama penerima paket</td></tr>
  <tr><td>alamat</td><td>string</td><td>Alamat lengkap pengiriman</td></tr>
  <tr><td>kota</td><td>string</td><td>Kota tujuan</td></tr>
  <tr><td>kode_pos</td><td>string</td><td>Kode pos</td></tr>
  <tr><td>kurir</td><td>string</td><td>Nama jasa kurir</td></tr>
  <tr><td>no_resi</td><td>string, nullable</td><td>Nomor resi pengiriman</td></tr>
  <tr><td>status</td><td>enum('belum dikirim','dikirim','diterima')</td><td>Status pengiriman</td></tr>
  <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
  <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
</table>

<h2>7. Tabel: ulasans</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Nama Field</th>
    <th>Tipe Data</th>
    <th>Keterangan</th>
  </tr>
  <tr><td>id</td><td>bigint, primary key</td><td>ID ulasan</td></tr>
  <tr><td>produk_id</td><td>bigint, foreign key</td><td>ID produk</td></tr>
  <tr><td>pengguna_id</td><td>bigint, foreign key</td><td>ID pengguna pemberi ulasan</td></tr>
  <tr><td>rating</td><td>integer</td><td>Rating (1-5)</td></tr>
  <tr><td>komentar</td><td>text, nullable</td><td>Komentar ulasan</td></tr>
  <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
  <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
</table>

<h2>8. Tabel: keranjangs</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Nama Field</th>
    <th>Tipe Data</th>
    <th>Keterangan</th>
  </tr>
  <tr><td>id</td><td>bigint, primary key</td><td>ID keranjang</td></tr>
  <tr><td>pengguna_id</td><td>bigint, foreign key</td><td>ID pengguna pemilik keranjang</td></tr>
  <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
  <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
</table>

<h2>9. Tabel: pesanan_produk (pivot)</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Nama Field</th>
    <th>Tipe Data</th>
    <th>Keterangan</th>
  </tr>
  <tr><td>id</td><td>bigint, primary key</td><td>ID record</td></tr>
  <tr><td>pesanan_id</td><td>bigint, foreign key</td><td>ID pesanan</td></tr>
  <tr><td>produk_id</td><td>bigint, foreign key</td><td>ID produk</td></tr>
  <tr><td>jumlah</td><td>integer</td><td>Jumlah produk dipesan</td></tr>
  <tr><td>harga_satuan</td><td>decimal(10,2)</td><td>Harga satuan produk</td></tr>
  <tr><td>subtotal</td><td>decimal(10,2)</td><td>Subtotal (jumlah × harga)</td></tr>
  <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
  <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
</table>

<br/>
<h2>Relasi Antar Tabel</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Tabel</th>
    <th>Kolom Relasi</th>
    <th>Tabel Referensi</th>
    <th>Relasi</th>
    <th>Keterangan</th>
  </tr>

  <tr>
    <td>penggunas</td>
    <td>–</td>
    <td>–</td>
    <td>–</td>
    <td>Tabel utama user</td>
  </tr>

  <tr>
    <td>produks</td>
    <td>pengguna_id</td>
    <td>penggunas(id)</td>
    <td>Many produk belong to one pengguna (penjual)</td>
    <td>Setiap produk dimiliki oleh satu pengguna (penjual)</td>
  </tr>

  <tr>
    <td>pesanans</td>
    <td>pengguna_id</td>
    <td>penggunas(id)</td>
    <td>Many pesanan belong to one pengguna (pembeli)</td>
    <td>Pesanan dibuat oleh satu pengguna pembeli</td>
  </tr>

  <tr>
    <td>detail_pesanans</td>
    <td>pesanan_id</td>
    <td>pesanans(id)</td>
    <td>Many detail_pesanans belong to one pesanan</td>
    <td>Satu pesanan bisa punya banyak detail produk</td>
  </tr>
  <tr>
    <td>detail_pesanans</td>
    <td>produk_id</td>
    <td>produks(id)</td>
    <td>Many detail_pesanans belong to one produk</td>
    <td>Setiap detail produk merujuk ke produk tertentu</td>
  </tr>

  <tr>
    <td>pembayarans</td>
    <td>pesanan_id</td>
    <td>pesanans(id)</td>
    <td>One pembayaran belongs to one pesanan</td>
    <td>Setiap pembayaran terkait dengan satu pesanan</td>
  </tr>

  <tr>
    <td>pengirimans</td>
    <td>pesanan_id</td>
    <td>pesanans(id)</td>
    <td>One pengiriman belongs to one pesanan</td>
    <td>Informasi pengiriman terkait pesanan</td>
  </tr>

  <tr>
    <td>ulasans</td>
    <td>produk_id</td>
    <td>produks(id)</td>
    <td>Many ulasan belong to one produk</td>
    <td>Ulasan diberikan untuk produk tertentu</td>
  </tr>
  <tr>
    <td>ulasans</td>
    <td>pengguna_id</td>
    <td>penggunas(id)</td>
    <td>Many ulasan belong to one pengguna</td>
    <td>Ulasan dibuat oleh pengguna tertentu</td>
  </tr>

  <tr>
    <td>keranjangs</td>
    <td>pengguna_id</td>
    <td>penggunas(id)</td>
    <td>One keranjang belongs to one pengguna</td>
    <td>Keranjang dimiliki oleh satu pengguna</td>
  </tr>

  <tr>
    <td>pesanan_produk</td>
    <td>pesanan_id</td>
    <td>pesanans(id)</td>
    <td>Many-to-Many dengan produk lewat pivot</td>
    <td>Relasi pesanan ke produk lewat pivot</td>
  </tr>
  <tr>
    <td>pesanan_produk</td>
    <td>produk_id</td>
    <td>produks(id)</td>
    <td>Many-to-Many dengan pesanan lewat pivot</td>
    <td>Relasi produk ke pesanan lewat pivot</td>
  </tr>
</table>
