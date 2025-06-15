<?php

    //Koneksi
    include "../php/koneksi.php";

    // Ambil Variabel dikirim dari FORM
    $namaTim = $_POST['nama_tim'];
    $jumlahAnggota = $_POST['jumlah_anggota'];
    $jenjang = $_POST['jenjang_tim'];
    $kategori = $_POST['kategori_lomba'];
    $judul = $_POST['judul_lomba'];
    $asalInstansi = $_POST['asal_instansi'];
    $deskripsi = $_POST['deskripsi'];
    $syaratKetentuan = $_POST['syarat_ketentuan'];
    // Jika tidak dicentang, set ke 'tidak_perlu_ktm'
    $cekKTM = isset($_POST['cek_ktm']) ? $_POST['cek_ktm'] : 'tidak_perlu_ktm'; 
    $link = $_POST['link'];

    // Gabungkan nilai jenjang yang dipilih menjadi satu string dengan koma
    $jenjang = implode(",", $jenjang);  // Menggabungkan nilai checkbox menjadi string   

    // Perintah SQL Insert
    $sql = "INSERT INTO tim(nama_tim, jumlah_anggota, jenjang_tim, kategori_lomba, judul_lomba, asal_instansi, deskripsi, syarat_ketentuan, cek_ktm, link) VALUES ('$namaTim', '$jumlahAnggota', '$jenjang', '$kategori', '$judul', '$asalInstansi', '$deskripsi', '$syaratKetentuan', '$cekKTM', '$link')";

    // 3. Execute
    $hasil_query = mysqli_query($koneksi, $sql);

    // 4. Validasi
    if ($hasil_query) {
        // Kalau berhasil
        // header('Location: ../beasiswaAdmin.php');
        echo "<script>alert('Tim Anda Berhasil Dibuat'); window.location.href='../dashboard.php';</script>";
    } else {
        // Kalau Gagal
        echo "Data tidak tersimpan, Kembali";
    }

?>