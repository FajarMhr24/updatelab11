## penjelasan file index.php

* Pencarian (`$sql_where`): Skrip mengecek apakah ada kata kunci yang dikirim melalui URL (`$_GET['q']`). Jika ada, variabel `$sql_where` diisi dengan perintah SQL `WHERE` `judul LIKE...` untuk memfilter hasil berdasarkan judul.
* Pengaturan Pagination:
    * `$per_page = 5`: Menentukan hanya 5 data yang muncul per halaman.
    * `$page`: Menentukan halaman mana yang sedang dibuka (default adalah halaman 1).
    * `$offset`: Menghitung baris keberapa di database yang harus mulai diambil.
* Menghitung Total Halaman: Skrip melakukan query `COUNT(*)` untuk tahu total semua artikel. Total ini dibagi dengan `$per_page` lalu dibulatkan ke atas menggunakan `ceil()` untuk mendapatkan jumlah total halaman (`$num_page`).
* Mengambil Data: Query terakhir menggunakan LIMIT $offset, $per_page. Inilah yang membatasi data yang muncul di tabel agar tidak keluar semua sekaligus.

Bagian HTML dan CSS memberikan struktur dan gaya agar tabel terlihat rapi dan modern (menggunakan font Segoe UI, bayangan/shadow, dan warna biru).

* Form Pencarian: Menggunakan `method="get"`. Artinya, saat kamu klik "Cari", kata kuncinya akan muncul di URL, contoh: `index.php?q=belajar`.
* Tabel Data: Menggunakan perulangan `while ($row = $data->fetch_assoc())`. Selama data ada di database, PHP akan terus mencetak baris `<tr>` baru.

Di bagian bawah, terdapat logika untuk memunculkan tombol angka halaman:
* Tombol Previous: Hanya muncul jika kita tidak sedang di halaman 1.
* Looping Angka: Mencetak angka 1, 2, 3, dst. Jika angka tersebut adalah halaman yang sedang dibuka, ia akan mendapat class `active` (berwarna biru).
* URL Parameter: Perhatikan bahwa setiap link menyertakan `&q=<?= $q; ?>`. Ini sangat penting agar ketika kamu pindah halaman, hasil pencarianmu tidak hilang.

