# Aplikasi Inventori Barang

Dokumentasi ini menjelaskan pembuatan Projek Aplikasi Inventori Barang.

## Daftar Isi

- [Prasyarat](#prasyarat)
- [Langkah-langkah Konfigurasi](#langkah-langkah-konfigurasi)
  - [1. Inisialisasi Proyek](#1-inisialisasi-proyek)
  - [2. Instal Tailwind CSS dan PostCSS](#2-instal-tailwind-css-dan-postcss)
  - [3. Buat File Konfigurasi Tailwind](#3-buat-file-konfigurasi-tailwind)
  - [4. Buat Direktori dan File CSS](#4-buat-direktori-dan-file-css)
  - [5. Tambahkan Direktif Tailwind ke `input.css`](#5-tambahkan-direktif-tailwind-ke-inputcss)
  - [6. Buat File Konfigurasi PostCSS](#6-buat-file-konfigurasi-postcss)
  - [7. Tambahkan Script Build di `package.json`](#7-tambahkan-script-build-di-packagejson)
  - [8. Build CSS](#8-build-css)
  - [9. Sertakan `style.css` di HTML](#9-sertakan-stylecss-di-html)
- [Konfigurasi Koneksi Database](#konfigurasi-koneksi-database)
- [Halaman Registrasi](#halaman-registrasi)
- [Proses Registrasi](#proses-registrasi)
- [Referensi](#referensi)

## Prasyarat

Pastikan Node.js dan npm sudah terinstal di sistem Anda. Unduh dari [situs resmi Node.js](https://nodejs.org/).

## Langkah-langkah Konfigurasi

1. **Inisialisasi Proyek**

   ```bash
   mkdir my-project
   cd my-project
   npm init -y
   ```

2. **Instal Tailwind CSS**

   ```bash
   npm install -D tailwindcss
   ```

3. **Buat File Konfigurasi Tailwind**

   ```bash
   npx tailwindcss init
   ```

4. **Buat Direktori dan File CSS**

   ```bash
   mkdir css
   touch css/input.css
   ```

5. **Tambahkan Direktif Tailwind ke `input.css`**

   ```css
   /* css/input.css */
   @tailwind base;
   @tailwind components;
   @tailwind utilities;
   ```

6. **Tambahkan Script Build di `package.json`**

   ```json
   "scripts": {
     "tailwind": "npx tailwindcss -i ./css/input.css -o ./css/style.css --watch"
   }
   ```

7. **Build CSS**

   ```bash
   npm run tailwind
   ```

8. **Sertakan `style.css` di HTML**

   ```html
   <!DOCTYPE html>
   <html lang="en">
     <head>
       <meta charset="UTF-8" />
       <meta name="viewport" content="width=device-width, initial-scale=1.0" />
       <title>My Tailwind Project</title>
       <link href="css/style.css" rel="stylesheet" />
     </head>
     <body>
       <h1 class="text-3xl font-bold underline">Hello, Tailwind CSS!</h1>
     </body>
   </html>
   ```

## Konfigurasi Koneksi Database

File: `config/conn.php`

File ini berisi konfigurasi untuk menghubungkan aplikasi ke database MySQL.

### Source Code

```php
<?php

define('BASEURL', 'http://localhost/app_inventori_barang/src');

$host = "localhost";
$username = "mci";
$password = "mcipassword";
$database = "learn_mci_app_inventori";

// koneksi ke database
$connection = new mysqli($host, $username, $password, $database);

// cek koneksi database
if ($connection->connect_errno) {
    echo "Gagal terkoneksi ke database: " . $connection->connect_error;
    exit();
}
```

### Penjelasan:

- Konstanta `BASEURL`:

  ```php
  define('BASEURL', 'http://localhost/app_inventori_barang/src');
  ```

  Ini adalah alamat utama aplikasi kita. Bayangkan ini seperti alamat rumah kita di internet.

- Parameter Koneksi:

  ```php
  $host = "localhost";
  $username = "mci";
  $password = "mcipassword";
  $database = "learn_mci_app_inventori";
  ```

  Ini adalah detail yang diperlukan untuk menghubungkan aplikasi ke database. `Host` adalah tempat database berada, `username` dan `password` adalah kunci untuk masuk, dan `database` adalah nama buku besar tempat kita menyimpan data.

- Objek mysqli:

  ```php
  $connection = new mysqli($host, $username, $password, $database);
  ```

  Ini seperti kita menghubungkan kabel dari aplikasi kita ke database menggunakan detail yang sudah disebutkan.

- Pengecekan Koneksi:

  ```php
      if ($connection->connect_errno) {
      echo "Gagal terkoneksi ke database: " . $connection->connect_error;
      exit();
  }
  ```

  Ini adalah cara untuk memastikan kabel tadi terhubung dengan baik. Kalau tidak, kita menampilkan pesan error dan menghentikan program.

## Halaman Registrasi

File: `src/register.php`

File ini berisi form HTML untuk registrasi pengguna baru.

### Source Code

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Register</title>
  </head>

  <body>
    <h1>Register Akun</h1>
    <form action="services/register.php" method="post">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" /><br />
      <label for="email">Email</label>
      <input type="email" name="email" id="email" /><br />
      <label for="password">Password</label>
      <input type="password" name="password" id="password" /><br />
      <label for="password-konfirmasi">Password Konfirmasi</label>
      <input
        type="password"
        name="password-konfirmasi"
        id="password-konfirmasi"
      /><br />
      <label for="roles">Pilih Role</label>
      <select name="roles" id="roles">
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
        <option value="kasir">Kasir</option>
        <option value="user">User</option></select
      ><br />
      <button type="submit" name="register">Register</button>
    </form>
  </body>
</html>
```

### Penjelasan

Form Registrasi: Formulir untuk pengguna memasukkan informasi seperti nama, email, password, konfirmasi password, dan peran pengguna.

Aksi Form: Formulir ini mengarah ke `services/register.php` untuk memproses data yang diinputkan.

## Proses Registrasi

File: `services/register.php`

File ini berisi logika / bisnis logik untuk memproses data registrasi yang dikirimkan dari formulir di `src/register.php`

### Source code

```php
<?php

require_once '../config/conn.php';

// http://localhost/app_inventori_barang/src/register/
$href = "document.location.href = '" . BASEURL . "/register.php'";

// cek apakah tombol register ditekan
if (isset($_POST['register'])) {
    // ambil data dari inputan
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_konfirmasi = $_POST['password-konfirmasi'];
    $role = $_POST['roles'];

    // cek email apakah telah tersedia di database
    $sql = "SELECT email FROM users WHERE email = '$email'";
    $result = $connection->query($sql);
    if ($result->num_rows) {
        echo "
        <script>
            alert('Data email telah teregister')
            $href
        </script>";
        exit;
    }

    // cek password konfirmasi
    if ($password !== $password_konfirmasi) {
        echo "
        <script>
            alert('Password konfirmasi tidak sama')
            $href
        </script>";
        exit;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan data ke database
    $sql = "INSERT INTO users VALUES (
        NULL,
        '$name',
        '$email',
        '$password',
        '$role',
        NOW(),
        NOW())
    ";

    // cek apakah data berhasil masuk
    if ($connection->query($sql)) {
        echo "
        <script>
            alert('User berhasil registrasi')
            $href
        </script>";
        exit;
    } else {
        echo "
        <script>
            alert('User gagal registrasi')
            $href
        </script>";
        exit;
    }
}
```

### Penjelasan

- **Inklusi File Koneksi**:

  ```php
  <?php
  require_once '../config/conn.php';
  ```

  Baris ini memuat file `config/conn.php`. File ini berisi informasi koneksi ke database, yang diperlukan untuk menghubungkan aplikasi ke tempat penyimpanan data. Bayangkan file ini seperti buku besar berisi petunjuk untuk membuka peti harta karun rahasia (database).

- **Redirect URL:**

  ```php
  $href = "document.location.href = '" . BASEURL . "/register.php'";
  ```

  Baris ini membuat alamat khusus yang akan mengarahkan Anda kembali ke halaman `register.php` setelah Anda selesai menemukan mendapatkan peringatan. Alamat ini seperti petunjuk arah kembali setelah Anda selesai berpetualang.

- **Pengecekkan Form:**

  ```php
  if (isset($_POST['register']))
  ```

  Baris ini seperti pintu rahasia yang hanya terbuka ketika Anda menekan tombol `register`. Jika Anda tidak menekan tombol, pintu tetap tertutup dan komputer tidak melakukan apa pun. Bayangkan tombol `register` sebagai kunci untuk membuka pintu ini.

- **Masukkan data ke variabel:**

  ```php
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password_konfirmasi = $_POST['password-konfirmasi'];
  $role = $_POST['roles'];
  ```

  Baris-baris ini seperti kotak kecil (`variable`) tempat Anda menyimpan informasi yang dimasukkan pada formulir registrasi. Komputer mengambil informasi ini dan menyimpannya dalam kotak-kotak ini untuk digunakan nanti. Bayangkan kotak-kotak ini sebagai tempat penyimpanan data sementara.

- **Validasi Email:**

  ```php
    $sql = "SELECT email FROM users WHERE email = '$email'";

    $result = $connection->query($sql);
    if ($result->num_rows) {
    echo "
    <script>
    alert('Data email telah teregister')
    $href
    </script>";

    exit;
    }
  ```

  Bagian ini seperti memeriksa apakah email yang Anda masukkan sudah ada di peti harta karun (`Database`). Jika sudah, komputer akan menunjukkan pesan yang mengatakan bahwa email sudah digunakan dan membawa Anda kembali ke peta harta karun (`register.php`). Bayangkan email Anda seperti kunci unik untuk membuka peti harta karun, dan jika ada kunci duplikat, Anda tidak dapat membuka peti.

- **Validasi Password**:

  ```php
    if ($password !== $password_konfirmasi) {
        echo "
        <script>
            alert('Password konfirmasi tidak sama')
            $href
        </script>";
        exit;
    }
  ```

  Bagian ini seperti memeriksa apakah kata sandi yang Anda masukkan sama dengan kata sandi konfirmasi. Jika tidak sama, komputer akan menunjukkan pesan yang mengatakan bahwa kata sandi tidak cocok dan membawa Anda kembali ke peta harta karun. Bayangkan kata sandi dan konfirmasi kata sandi seperti dua kunci yang harus cocok untuk membuka pintu.

- **Enkripsi Password:**

  ```php
  $password = password_hash($password, PASSWORD_DEFAULT);
  ```

  Bagian ini seperti memasukkan kata sandi Anda ke dalam kunci khusus yang membuatnya tidak dapat dibaca oleh orang lain. Komputer menggunakan kunci rahasia ini untuk melindungi kata sandi Anda. Bayangkan kunci ini sebagai brankas aman untuk menyimpan kata sandi Anda.

- **Simpan Data:**

  ```php
  $sql = "INSERT INTO users VALUES (
      NULL,
      '$name',
      '$email',
      '$password',
      '$role',
      NOW(),
      NOW())
  ";

  if ($connection->query($sql)) {
      echo "
      <script>
          alert('User berhasil registrasi')
          $href
      </script>";
      exit;
  } else {
      echo "
      <script>
          alert('User gagal registrasi')
          $href
      </script>";
      exit;
  }
  ```

  Bagian ini seperti memasukkan informasi Anda (nama, email, kata sandi, peran) ke dalam peti harta karun (`Database`). Jika komputer berhasil memasukkan informasi Anda ke dalam peti, ia akan menunjukkan pesan yang mengatakan bahwa Anda telah terdaftar dan membawa Anda kembali ke peta harta karun. Jika gagal, ia akan menunjukkan pesan error dan membawa Anda kembali ke peta harta karun. Bayangkan peti harta karun ini sebagai tempat

## Referensi

Kunjungi dokumentasi resmi [Tailwind CSS](https://tailwindcss.com) untuk informasi lebih lanjut.

```

```
