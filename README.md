SIMKEUMAS (Sistem Informasi Keuangan Masjid)

Features
-------------------
- Kas Masuk/Keluar
- Laporan Kas Masuk/Keluar
- Laporan Rekapitulasi

-------------------
Installation
>Pastikan sudah terintall composer

1. Buat database yang akan Anda gunakan untuk aplikasi Anda (Anda dapat menggunakan phpMyAdmin atau tool lain yang Anda suka).

2. Buka console dan ```cd``` ke web root directory Anda, Contoh: ``` cd /var/www/html/ ```

3. Jalankan perintah Composer ```update``` command:

   ``` composer update ```

4. Konfigurasi database .
Buka file config db.php di ```basic/_protected/config/db.php``` dan ubah sesuai konfigurasi database Anda.

5. Kembali ke console. Pindah ke folder _protected, ```cd``` to the ```_protected``` folder.

7. Jalankan perintah yii migration:

   ``` ./yii migrate ``` or if you are on Windows ``` yii migrate ```

8. Jalankan _rbac_ controller _init_ action :

   ``` ./yii rbac/init ``` or if you are on Windows ``` yii rbac/init ```


Selesai, jalankan aplikasi Anda di browser.

> Note: User pertama yang signup akan mendapatkan hak akses theCreator (super admin) role.  

Credits to
-------------------
https://github.com/nenad-zivkovic/yii2-basic-template
[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)
