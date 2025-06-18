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

<h3>1. Admin</h3>
<ul>
  <li><strong>Fokus:</strong> Mengelola sistem dan pengguna</li>
  <li><strong>Fitur:</strong>
    <ul>
      <li>Mengelola data pengguna (CRUD user)</li>
      <li>Mengelola role dan hak akses</li>
      <li>Mengelola semua produk dan koleksi</li>
      <li>Melihat semua pesanan dan status</li>
      <li>Melihat laporan transaksi</li>
    </ul>
  </li>
</ul>

<h3>2. Seller (Penjual)</h3>
<ul>
  <li><strong>Fokus:</strong> Mengelola produk & pesanan sendiri</li>
  <li><strong>Fitur:</strong>
    <ul>
      <li>CRUD produk milik sendiri</li>
      <li>Mengelola koleksi produk</li>
      <li>Melihat pesanan masuk terkait produknya</li>
      <li>Update status pengiriman</li>
      <li>Melihat pembayaran pesanan miliknya</li>
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

---


<h2>Struktur Tabel Database</h2>

<h3>Tabel: penggunas</h3>
<table>
  <thead>
    <tr><th>Nama Field</th><th>Tipe Data</th><th>Keterangan</th></tr>
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
    <tr><td>created_at</td><td>timestamp</td><td>Waktu saat data dibuat</td></tr>
    <tr><td>updated_at</td><td>timestamp</td><td>Waktu saat data diubah</td></tr>
  </tbody>
</table><br/>

<h3>Tabel: koleksis</h3>
<table>
  <thead>
    <tr><th>Nama Field</th><th>Tipe Data</th><th>Keterangan</th></tr>
  </thead>
  <tbody>
    <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
    <tr><td>nama</td><td>string</td><td>Nama koleksi produk</td></tr>
    <tr><td>created_at</td><td>timestamp</td><td>Waktu data dibuat</td></tr>
    <tr><td>updated_at</td><td>timestamp</td><td>Waktu data diubah</td></tr>
  </tbody>
</table><br/>

<h3>Tabel: produks</h3>
<table>
  <thead>
    <tr><th>Nama Field</th><th>Tipe Data</th><th>Keterangan</th></tr>
  </thead>
  <tbody>
    <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
    <tr><td>nama</td><td>string</td><td>Nama produk</td></tr>
    <tr><td>deskripsi</td><td>text</td><td>Boleh null</td></tr>
    <tr><td>harga</td><td>decimal(10,2)</td><td>Harga produk</td></tr>
    <tr><td>stok</td><td>integer</td><td>Jumlah stok</td></tr>
    <tr><td>gambar</td><td>string</td><td>Path gambar, boleh null</td></tr>
    <tr><td>pengguna_id</td><td>foreignId</td><td>Relasi ke tabel penggunas</td></tr>
    <tr><td>koleksi_id</td><td>foreignId</td><td>Boleh null, relasi ke koleksis</td></tr>
    <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
    <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
    <tr><td>deleted_at</td><td>timestamp</td><td>Soft delete</td></tr>
  </tbody>
</table><br/>

<h3>Tabel: pesanans</h3>
<table>
  <thead>
    <tr><th>Nama Field</th><th>Tipe Data</th><th>Keterangan</th></tr>
  </thead>
  <tbody>
    <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
    <tr><td>pengguna_id</td><td>foreignId</td><td>Relasi ke penggunas</td></tr>
    <tr><td>total_harga</td><td>decimal(10,2)</td><td>Total harga</td></tr>
    <tr><td>status</td><td>enum</td><td>menunggu / diproses / selesai</td></tr>
    <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
    <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
    <tr><td>deleted_at</td><td>timestamp</td><td>Soft delete</td></tr>
  </tbody>
</table><br/>

<h3>Tabel: detail_pesanans</h3>
<table>
  <thead>
    <tr><th>Nama Field</th><th>Tipe Data</th><th>Keterangan</th></tr>
  </thead>
  <tbody>
    <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
    <tr><td>pesanan_id</td><td>foreignId</td><td>Relasi ke pesanans</td></tr>
    <tr><td>produk_id</td><td>foreignId</td><td>Relasi ke produks</td></tr>
    <tr><td>jumlah</td><td>integer</td><td>Jumlah dibeli</td></tr>
    <tr><td>harga_satuan</td><td>decimal(10,2)</td><td>Harga per unit</td></tr>
    <tr><td>subtotal</td><td>decimal(10,2)</td><td>harga_satuan * jumlah</td></tr>
    <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
    <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
  </tbody>
</table><br/>

<h3>Tabel: pembayarans</h3>
<table>
  <thead>
    <tr><th>Nama Field</th><th>Tipe Data</th><th>Keterangan</th></tr>
  </thead>
  <tbody>
    <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
    <tr><td>pesanan_id</td><td>foreignId</td><td>Relasi ke pesanans</td></tr>
    <tr><td>jumlah</td><td>decimal(10,2)</td><td>Jumlah pembayaran</td></tr>
    <tr><td>metode</td><td>string</td><td>Metode pembayaran</td></tr>
    <tr><td>status</td><td>enum</td><td>belum dibayar / sudah dibayar</td></tr>
    <tr><td>created_at</td><td>timestamp</td><td>Waktu dibuat</td></tr>
    <tr><td>updated_at</td><td>timestamp</td><td>Waktu diubah</td></tr>
  </tbody>
</table><br/>

<h3>Tabel: pengirimans</h3>
<table>
  <thead>
    <tr><th>Nama Field</th><th>Tipe Data</th><th>Keterangan</th></tr>
  </thead>
  <tbody>
    <tr><td>id</td><td>bigint</td><td>Primary key</td></tr>
    <tr><td>pesanan_id</td><td>foreignId</td><td>Relasi ke pesanans</td></tr>
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
</table><br/>
<h3>🔗 Relasi Antar Tabel</h3>
<table>
  <thead>
    <tr>
      <th>Relasi Tabel</th>
      <th>Jenis Relasi</th>
      <th>Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>penggunas → produks</td>
      <td>One to Many</td>
      <td>Penjual bisa memiliki banyak produk</td>
    </tr>
    <tr>
      <td>penggunas → pesanans</td>
      <td>One to Many</td>
      <td>Customer bisa membuat banyak pesanan</td>
    </tr>
    <tr>
      <td>koleksis → produks</td>
      <td>One to Many</td>
      <td>Satu koleksi bisa memiliki banyak produk</td>
    </tr>
    <tr>
      <td>produks → detail_pesanans</td>
      <td>One to Many</td>
      <td>Satu produk bisa muncul di banyak item pesanan</td>
    </tr>
    <tr>
      <td>pesanans → detail_pesanans</td>
      <td>One to Many</td>
      <td>Satu pesanan bisa memiliki banyak item</td>
    </tr>
    <tr>
      <td>pesanans → pembayarans</td>
      <td>One to One</td>
      <td>Satu pesanan memiliki satu pembayaran</td>
    </tr>
    <tr>
      <td>pesanans → pengirimans</td>
      <td>One to One</td>
      <td>Satu pesanan memiliki satu pengiriman</td>
    </tr>
  </tbody>
</table>
