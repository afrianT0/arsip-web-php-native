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
        $stmt = $this->koneksi->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    //USERS
    function get_data_user()
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function total_user()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function foreignkey_user($id)
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM archives WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'] > 0;
    }
    function select_user($id)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function cek_username($username)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function cek_email($email)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function tambah_user($username, $email, $password, $level)
    {
        $stmt = $this->koneksi->prepare("INSERT INTO users (username, email, password, level) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $username, $email, $password, $level);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function edit_user($id, $username, $email, $password, $level, $picture)
    {
        $stmt = $this->koneksi->prepare("UPDATE users SET username = ?, email = ?, password = ?, level = ?, picture = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $username, $email, $password, $level, $picture, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function hapus_user($id)
    {
        $stmt = $this->koneksi->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    //CATEGORIES
    function get_data_categories()
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM categories");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function total_categories()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM categories");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function tambah_categories($name)
    {
        $stmt = $this->koneksi->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function foreignkey_categories($id)
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM archives WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'] > 0;
    }
    function select_categories($id)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function edit_categories($id, $name)
    {
        $stmt = $this->koneksi->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function cek_name_categories($name)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM categories WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function hapus_categories($id)
    {
        $stmt = $this->koneksi->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    //INSTANSI
    function get_data_instansi()
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM instansi ORDER BY name ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function total_instansi()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM instansi");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function foreignkey_instansi($id)
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM archives WHERE instansi_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'] > 0;
    }
    function select_instansi($id)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM instansi WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function cek_name_instansi($name)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM instansi WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function tambah_instansi($name, $address, $phone)
    {
        $stmt = $this->koneksi->prepare("INSERT INTO instansi (name, address, phone) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $address, $phone);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function edit_instansi($id, $name, $address, $phone)
    {
        $stmt = $this->koneksi->prepare("UPDATE instansi SET name = ?, address = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $address, $phone, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function hapus_instansi($id)
    {
        $stmt = $this->koneksi->prepare("DELETE FROM instansi WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    //SURAT MASUK / KELUAR
    function get_all_archives()
    {
        $stmt = $this->koneksi->prepare("SELECT 
        archives.*, 
        users.username AS user_name, 
        categories.name AS category_name,
        instansi.name AS instansi_name
        FROM archives 
        JOIN users ON users.id = archives.user_id 
        JOIN categories ON categories.id = archives.category_id 
        JOIN instansi ON instansi.id = archives.instansi_id 
        ORDER BY tanggal DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function total_inArchives()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM archives WHERE tipe_surat = '1'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function total_outArchives()
    {
        $stmt = $this->koneksi->prepare("SELECT COUNT(*) AS total FROM archives WHERE tipe_surat = '2'");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
    function get_data_inArchives()
    {
        $stmt = $this->koneksi->prepare("SELECT 
        archives.*, 
        users.username AS user_name, 
        categories.name AS category_name,
        instansi.name AS instansi_name
        FROM archives 
        JOIN users ON users.id = archives.user_id 
        JOIN categories ON categories.id = archives.category_id 
        JOIN instansi ON instansi.id = archives.instansi_id 
        WHERE archives.tipe_surat = '1' 
        ORDER BY tanggal DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function get_data_outArchives()
    {
        $stmt = $this->koneksi->prepare("SELECT 
        archives.*, 
        users.username AS user_name, 
        categories.name AS category_name,
        instansi.name AS instansi_name
        FROM archives 
        JOIN users ON users.id = archives.user_id 
        JOIN categories ON categories.id = archives.category_id 
        JOIN instansi ON instansi.id = archives.instansi_id 
        WHERE archives.tipe_surat = '2' 
        ORDER BY tanggal DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function select_archives($id)
    {
        $stmt = $this->koneksi->prepare("SELECT 
        archives.*, 
        users.username AS user_name, 
        categories.name AS category_name,
        instansi.name AS instansi_name
        FROM archives 
        JOIN users ON users.id = archives.user_id 
        JOIN categories ON categories.id = archives.category_id 
        JOIN instansi ON instansi.id = archives.instansi_id 
        WHERE archives.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function tambah_archives($category_id, $user_id, $instansi_id, $nama, $nomor, $tanggal, $deskripsi, $file, $tipe_surat)
    {
        $stmt = $this->koneksi->prepare("INSERT INTO archives (category_id, user_id, instansi_id, nama, nomor, tanggal, deskripsi, file, tipe_surat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiissssss", $category_id, $user_id, $instansi_id, $nama, $nomor, $tanggal, $deskripsi, $file, $tipe_surat);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function edit_archives($id, $category_id, $user_id, $instansi_id, $nama, $nomor, $tanggal, $deskripsi, $file, $tipe_surat)
    {
        $stmt = $this->koneksi->prepare("UPDATE archives SET category_id = ?, user_id = ?, instansi_id = ?, nama = ?, nomor = ?, tanggal = ?, deskripsi = ?, file = ?, tipe_surat = ? WHERE id = ?");
        $stmt->bind_param("iiissssssi", $category_id, $user_id, $instansi_id, $nama, $nomor, $tanggal, $deskripsi, $file, $tipe_surat, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    function cek_number_archives($nomor)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM archives WHERE nomor = ?");
        $stmt->bind_param("s", $nomor);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
    function hapus_archives($id)
    {
        $stmt = $this->koneksi->prepare("DELETE FROM archives WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    //CETAK DOKUMEN
    function cetak_semua_surat($tanggal_awal, $tanggal_akhir)
    {
        $stmt = $this->koneksi->prepare("SELECT 
        archives.*, 
        users.username AS user_name, 
        categories.name AS category_name,
        instansi.name AS instansi_name
        FROM archives 
        JOIN users ON users.id = archives.user_id 
        JOIN categories ON categories.id = archives.category_id 
        JOIN instansi ON instansi.id = archives.instansi_id 
        WHERE tanggal BETWEEN ? AND ?
        ORDER BY tanggal DESC");
        $stmt->bind_param("ss", $tanggal_awal, $tanggal_akhir);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function cetak_semua_masuk($tipe_surat, $tanggal_awal, $tanggal_akhir)
    {
        $stmt = $this->koneksi->prepare("SELECT 
        archives.*, 
        users.username AS user_name, 
        categories.name AS category_name,
        instansi.name AS instansi_name
        FROM archives 
        JOIN users ON users.id = archives.user_id 
        JOIN categories ON categories.id = archives.category_id 
        JOIN instansi ON instansi.id = archives.instansi_id 
        WHERE tipe_surat = ? AND tanggal BETWEEN ? AND ?
        ORDER BY tanggal DESC");
        $stmt->bind_param("sss", $tipe_surat, $tanggal_awal, $tanggal_akhir);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    function cetak_semua_keluar($tipe_surat, $tanggal_awal, $tanggal_akhir)
    {
        $stmt = $this->koneksi->prepare("SELECT 
        archives.*, 
        users.username AS user_name, 
        categories.name AS category_name,
        instansi.name AS instansi_name
        FROM archives 
        JOIN users ON users.id = archives.user_id 
        JOIN categories ON categories.id = archives.category_id 
        JOIN instansi ON instansi.id = archives.instansi_id 
        WHERE tipe_surat = ? AND tanggal BETWEEN ? AND ?
        ORDER BY tanggal DESC");
        $stmt->bind_param("sss", $tipe_surat, $tanggal_awal, $tanggal_akhir);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
}
