<?php
class koneksi_db
{
    private $koneksi;
    function __construct()
    {
        $server     = 'localhost';
        $username   = 'root';
        $password   = '';
        $database   = 'arsip_phpnative';

        $this->koneksi = new mysqli($server, $username, $password, $database);
        if ($this->koneksi->connect_error) {
            die("Koneksi database gagal: " . $this->koneksi->connect_error);
        }
    }
    function login($username)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    //USERS
    function get_data_user()
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_users");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function total_user()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM tb_users");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function foreignkey_user($id)
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM tb_surat WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'] > 0;
    }
    function select_user($id)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function cek_username($username)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function cek_email($email)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function tambah_user($username, $nama, $email, $password, $level, $gambar)
    {
        $stmt = $this->koneksi->prepare("INSERT INTO tb_users (username, nama, email, password, level, gambar) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $username, $nama, $email, $password, $level, $gambar);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function edit_user($id, $username, $nama, $email, $password, $level, $gambar)
    {
        $stmt = $this->koneksi->prepare("UPDATE tb_users SET username = ?, nama = ?, email = ?, password = ?, level = ?, gambar = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $username, $nama, $email, $password, $level, $gambar, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function hapus_user($id)
    {
        $stmt = $this->koneksi->prepare("DELETE FROM tb_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    //tb_kategori
    function get_data_kategori()
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_kategori");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function total_kategori()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM tb_kategori");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function tambah_kategori($nama)
    {
        $stmt = $this->koneksi->prepare("INSERT INTO tb_kategori (nama) VALUES (?)");
        $stmt->bind_param("s", $nama);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function foreignkey_kategori($id)
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM tb_surat WHERE kategori_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'] > 0;
    }
    function select_kategori($id)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_kategori WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function edit_kategori($id, $nama)
    {
        $stmt = $this->koneksi->prepare("UPDATE tb_kategori SET nama = ? WHERE id = ?");
        $stmt->bind_param("si", $nama, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function cek_nama_kategori($nama)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_kategori WHERE nama = ?");
        $stmt->bind_param("s", $nama);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function hapus_kategori($id)
    {
        $stmt = $this->koneksi->prepare("DELETE FROM tb_kategori WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    //INSTANSI
    function get_data_instansi()
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_instansi ORDER BY nama ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function total_instansi()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM tb_instansi");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function foreignkey_instansi($id)
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM tb_surat WHERE instansi_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'] > 0;
    }
    function select_instansi($id)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_instansi WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function cek_nama_instansi($nama)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_instansi WHERE nama = ?");
        $stmt->bind_param("s", $nama);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function tambah_instansi($nama, $alamat, $telepon)
    {
        $stmt = $this->koneksi->prepare("INSERT INTO tb_instansi (nama, alamat, telepon) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $alamat, $telepon);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function edit_instansi($id, $nama, $alamat, $telepon)
    {
        $stmt = $this->koneksi->prepare("UPDATE tb_instansi SET nama = ?, alamat = ?, telepon = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nama, $alamat, $telepon, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function hapus_instansi($id)
    {
        $stmt = $this->koneksi->prepare("DELETE FROM tb_instansi WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    //SURAT MASUK / KELUAR
    function get_all_surat()
    {
        $stmt = $this->koneksi->prepare("SELECT 
        tb_surat.*, 
        tb_users.username AS user_nama, 
        tb_kategori.nama AS kategori_nama,
        tb_instansi.nama AS instansi_nama
        FROM tb_surat 
        JOIN tb_users ON tb_users.id = tb_surat.user_id 
        JOIN tb_kategori ON tb_kategori.id = tb_surat.kategori_id 
        JOIN tb_instansi ON tb_instansi.id = tb_surat.instansi_id 
        ORDER BY tanggal DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function total_surat_masuk()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM tb_surat WHERE tipe_surat = '1'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function total_surat_keluar()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM tb_surat WHERE tipe_surat = '2'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function total_surat_pending()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM tb_surat WHERE status = '1'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function total_surat_valid()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM tb_surat WHERE status = '2'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function total_surat_tidak_valid()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM tb_surat WHERE status = '3'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function get_data_surat_masuk()
    {
        $stmt = $this->koneksi->prepare("SELECT 
        tb_surat.*, 
        tb_users.username AS user_nama, 
        tb_kategori.nama AS kategori_nama,
        tb_instansi.nama AS instansi_nama
        FROM tb_surat 
        JOIN tb_users ON tb_users.id = tb_surat.user_id 
        JOIN tb_kategori ON tb_kategori.id = tb_surat.kategori_id 
        JOIN tb_instansi ON tb_instansi.id = tb_surat.instansi_id 
        WHERE tb_surat.tipe_surat = '1' 
        ORDER BY tanggal DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function get_data_surat_keluar()
    {
        $stmt = $this->koneksi->prepare("SELECT 
        tb_surat.*, 
        tb_users.username AS user_nama, 
        tb_kategori.nama AS kategori_nama,
        tb_instansi.nama AS instansi_nama
        FROM tb_surat 
        JOIN tb_users ON tb_users.id = tb_surat.user_id 
        JOIN tb_kategori ON tb_kategori.id = tb_surat.kategori_id 
        JOIN tb_instansi ON tb_instansi.id = tb_surat.instansi_id 
        WHERE tb_surat.tipe_surat = '2' 
        ORDER BY tanggal DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function get_data_surat_pending()
    {
        $stmt = $this->koneksi->prepare("SELECT 
        tb_surat.*, 
        tb_users.username AS user_nama, 
        tb_kategori.nama AS kategori_nama,
        tb_instansi.nama AS instansi_nama
        FROM tb_surat 
        JOIN tb_users ON tb_users.id = tb_surat.user_id 
        JOIN tb_kategori ON tb_kategori.id = tb_surat.kategori_id 
        JOIN tb_instansi ON tb_instansi.id = tb_surat.instansi_id 
        WHERE tb_surat.status = '1' 
        ORDER BY tanggal DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function get_data_surat_valid()
    {
        $stmt = $this->koneksi->prepare("SELECT 
        tb_surat.*, 
        tb_users.username AS user_nama, 
        tb_kategori.nama AS kategori_nama,
        tb_instansi.nama AS instansi_nama
        FROM tb_surat 
        JOIN tb_users ON tb_users.id = tb_surat.user_id 
        JOIN tb_kategori ON tb_kategori.id = tb_surat.kategori_id 
        JOIN tb_instansi ON tb_instansi.id = tb_surat.instansi_id 
        WHERE tb_surat.status = '2' 
        ORDER BY tanggal DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function get_data_surat_tidak_valid()
    {
        $stmt = $this->koneksi->prepare("SELECT 
        tb_surat.*, 
        tb_users.username AS user_nama, 
        tb_kategori.nama AS kategori_nama,
        tb_instansi.nama AS instansi_nama
        FROM tb_surat 
        JOIN tb_users ON tb_users.id = tb_surat.user_id 
        JOIN tb_kategori ON tb_kategori.id = tb_surat.kategori_id 
        JOIN tb_instansi ON tb_instansi.id = tb_surat.instansi_id 
        WHERE tb_surat.status = '3' 
        ORDER BY tanggal DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function select_surat($id)
    {
        $stmt = $this->koneksi->prepare("SELECT 
        tb_surat.*, 
        tb_users.username AS user_nama, 
        tb_kategori.nama AS kategori_nama,
        tb_instansi.nama AS instansi_nama
        FROM tb_surat 
        JOIN tb_users ON tb_users.id = tb_surat.user_id 
        JOIN tb_kategori ON tb_kategori.id = tb_surat.kategori_id 
        JOIN tb_instansi ON tb_instansi.id = tb_surat.instansi_id 
        WHERE tb_surat.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function tambah_surat($kategori_id, $user_id, $instansi_id, $nama, $nomor, $tanggal, $deskripsi, $file, $status, $tipe_surat)
    {
        $stmt = $this->koneksi->prepare("INSERT INTO tb_surat (kategori_id, user_id, instansi_id, nama, nomor, tanggal, deskripsi, file, status, tipe_surat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisssssss", $kategori_id, $user_id, $instansi_id, $nama, $nomor, $tanggal, $deskripsi, $file, $status, $tipe_surat);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function edit_surat($id, $kategori_id, $user_id, $instansi_id, $nama, $nomor, $tanggal, $deskripsi, $file, $status, $tipe_surat)
    {
        $stmt = $this->koneksi->prepare("UPDATE tb_surat SET kategori_id = ?, user_id = ?, instansi_id = ?, nama = ?, nomor = ?, tanggal = ?, deskripsi = ?, file = ?, status = ?, tipe_surat = ? WHERE id = ?");
        $stmt->bind_param("iiisssssssi", $kategori_id, $user_id, $instansi_id, $nama, $nomor, $tanggal, $deskripsi, $file, $status, $tipe_surat, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function cek_nomor_surat($nomor)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_surat WHERE nomor = ?");
        $stmt->bind_param("s", $nomor);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function hapus_surat($id)
    {
        $stmt = $this->koneksi->prepare("DELETE FROM tb_surat WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    //CETAK DOKUMEN
    function cetak_semua_surat($tanggal_awal, $tanggal_akhir)
    {
        $stmt = $this->koneksi->prepare("SELECT 
        tb_surat.*, 
        tb_users.username AS user_nama, 
        tb_kategori.nama AS kategori_nama,
        tb_instansi.nama AS instansi_nama
        FROM tb_surat 
        JOIN tb_users ON tb_users.id = tb_surat.user_id 
        JOIN tb_kategori ON tb_kategori.id = tb_surat.kategori_id 
        JOIN tb_instansi ON tb_instansi.id = tb_surat.instansi_id 
        WHERE tanggal BETWEEN ? AND ?
        ORDER BY tanggal DESC");
        $stmt->bind_param("ss", $tanggal_awal, $tanggal_akhir);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function cetak_semua_surat_masuk($tipe_surat, $tanggal_awal, $tanggal_akhir)
    {
        $stmt = $this->koneksi->prepare("SELECT 
        tb_surat.*, 
        tb_users.username AS user_nama, 
        tb_kategori.nama AS kategori_nama,
        tb_instansi.nama AS instansi_nama
        FROM tb_surat 
        JOIN tb_users ON tb_users.id = tb_surat.user_id 
        JOIN tb_kategori ON tb_kategori.id = tb_surat.kategori_id 
        JOIN tb_instansi ON tb_instansi.id = tb_surat.instansi_id 
        WHERE tipe_surat = ? AND tanggal BETWEEN ? AND ?
        ORDER BY tanggal DESC");
        $stmt->bind_param("sss", $tipe_surat, $tanggal_awal, $tanggal_akhir);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function cetak_semua_surat_keluar($tipe_surat, $tanggal_awal, $tanggal_akhir)
    {
        $stmt = $this->koneksi->prepare("SELECT 
        tb_surat.*, 
        tb_users.username AS user_nama, 
        tb_kategori.nama AS kategori_nama,
        tb_instansi.nama AS instansi_nama
        FROM tb_surat 
        JOIN tb_users ON tb_users.id = tb_surat.user_id 
        JOIN tb_kategori ON tb_kategori.id = tb_surat.kategori_id 
        JOIN tb_instansi ON tb_instansi.id = tb_surat.instansi_id 
        WHERE tipe_surat = ? AND tanggal BETWEEN ? AND ?
        ORDER BY tanggal DESC");
        $stmt->bind_param("sss", $tipe_surat, $tanggal_awal, $tanggal_akhir);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
}
