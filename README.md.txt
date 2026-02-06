# SIAKAD MHS - Academic Management System

SIAKAD MHS adalah aplikasi manajemen akademik berbasis web yang dirancang untuk mengelola data mahasiswa, jadwal perkuliahan, dan absensi secara real-time. Sistem ini mengutamakan integritas data dengan arsitektur database relasional yang kuat dan antarmuka pengguna yang responsif.

## 🚀 Key Features

* **Role-Based Access Control (RBAC):** Hak akses yang dibedakan untuk Admin, Dosen, dan Mahasiswa.
* **Interactive Dashboard:** Visualisasi data statistik menggunakan Chart.js (Doughnut Chart) untuk pemantauan kehadiran.
* **Active Semester Tracking:** Sistem otomatis yang mengenali periode akademik berjalan tanpa mengubah struktur database.
* **Real-time Attendance Activity:** Log aktivitas terbaru yang menampilkan riwayat absensi mahasiswa dengan status badge yang intuitif.
* **Relational Integrity:** Implementasi Foreign Key dan Indexing yang ketat untuk mencegah data anomali.

## 🛠️ Technical Stack

* **Backend:** PHP CodeIgniter 3 (MVC Architecture)
* **Database:** MySQL (Relational)
* **Frontend:** Bootstrap 5, Chart.js, Bootstrap Icons
* **Server:** Apache (XAMPP/Laragon)

## 📊 Database Architecture

Sistem ini menggunakan arsitektur RDBMS dengan normalisasi data untuk efisiensi penyimpanan. Relasi antar tabel meliputi:
- **Master Data:** `users`, `dosen`, `kelas`, `semester`.
- **Operational Data:** `mahasiswa` (Linked to `kelas`), `matkul` (Linked to `dosen` & `kelas`).
- **Transactional Data:** `absen` (Multi-relational link to `mahasiswa`, `matkul`, `semester`, and `dosen`).


## 📸 Dashboard Preview

Dashboard Admin dilengkapi dengan:
- **Statistik Cards:** Total Mahasiswa, Dosen, Kelas, dan Matkul.
- **Information Board:** Untuk pengumuman internal sistem.
- **Attendance Analytics:** Grafik doughnut yang membagi status Hadir, Sakit, Izin, dan Alpha.


## ⚙️ Installation

1.  Clone repository ini:
    ```bash
    git clone [https://github.com/username/siakad-mhs.git](https://github.com/username/siakad-mhs.git)
    ```
2.  Import database `siakad.sql` ke phpMyAdmin.
3.  Konfigurasi database di `application/config/database.php`.
4.  Sesuaikan `base_url` di `application/config/config.php`.
5.  Login default:
    - User: `admin`
    - Pass: `admin123`

## 📝 Contact
Shakila Amalia Pratiwi - https://www.linkedin.com/in/shakila-amalia-pratiwi/ - shakilapratiwi673@gmail.com
---

copyright: link template bootsrap 5: https://bootstrapmade.com/college-bootstrap-education-template/
CI3 bisa didownload di website resmi.