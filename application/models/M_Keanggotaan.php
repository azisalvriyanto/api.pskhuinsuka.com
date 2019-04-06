<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Keanggotaan extends CI_Model {
    public function daftar($periode)
    {
        $query = $this->db->select("keanggotaan.*, divisi.divisi_keterangan, jabatan.jabatan_keterangan")->from("keanggotaan")
        ->join("jabatan", "jabatan.jabatan_id=keanggotaan.keanggotaan_jabatan")
        ->join("divisi", "divisi.divisi_id=keanggotaan.keanggotaan_divisi")
        ->where("keanggotaan_periode", $periode)
        ->get();

        if ($query->num_rows() > 0) {
            return array(
                "status" => 200,
                "keterangan" => json_decode(json_encode($query->result()), TRUE)
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Daftar anggota tidak ditemukan."
            );
        }
    }

    public function lihat($username)
    {
        $query = $this->db->select("keanggotaan.*, divisi.divisi_keterangan, jabatan.jabatan_keterangan")->from("keanggotaan")
        ->join("jabatan", "jabatan.jabatan_id=keanggotaan.keanggotaan_jabatan")
        ->join("divisi", "divisi.divisi_id=keanggotaan.keanggotaan_divisi")
        ->where("keanggotaan_username", $username)->get();

        if ($query->num_rows() > 0) {
            $query  = $query->row();

            return array(
                "status" => 200,
                "keterangan" => array(
                    "periode" => $query->keanggotaan_periode,
                    "username" => $query->keanggotaan_username,
                    "nama" => $query->keanggotaan_nama,
                    "angkatan" => $query->keanggotaan_angkatan,
                    "divisi" => $query->divisi_keterangan,
                    "jabatan" => $query->jabatan_keterangan,
                    "jabatan_x" => $query->keanggotaan_jabatan,
                    "email" => $query->keanggotaan_email,
                    "telepon" => $query->keanggotaan_telepon,
                    "motto" => $query->keanggotaan_motto
                )
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Profil tidak ditemukan."
            );
        }
    }

    public function tambah(
        $keterangan,
        $periode,
        $username,
        $password,
        $nama,
        $divisi,
        $jabatan,
        $email,
        $telepon,
        $motto
    ) {
        $this->db->trans_begin();
        $this->db->insert("keanggotaan",
            array(
                "keanggotaan_periode" => $periode,
                "keanggotaan_nama" => $nama,
                "keanggotaan_username" => $username,
                "keanggotaan_divisi" => $divisi,
                "keanggotaan_jabatan" => $jabatan,
                "keanggotaan_email" => $email,
                "keanggotaan_telepon" => $telepon,
                "keanggotaan_motto" => $motto
            )
        );
        $this->db->insert("akun",
            array(
                "akun_keterangan" => $keterangan,
                "akun_username" => $username,
                "akun_password" => $password
            )
        );

        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();

            return array(
                "status" => 200,
                "keterangan" => "Profil berhasil ditambahkan."
            );
        } else {
            $this->db->trans_rollback();

            return array(
                "status" => 204,
                "keterangan" => "Profil gagal ditambahkan."
            );
        }
    }

    public function perbarui(
        $keterangan,
        $periode,
        $username,
        $nama,
        $divisi,
        $jabatan,
        $email,
        $telepon,
        $motto
    ) {
        $this->db->trans_begin();
        $this->db->where("keanggotaan_username", $username)->update("keanggotaan",
            array(
                "keanggotaan_periode" => $periode,
                "keanggotaan_nama" => $nama,
                "keanggotaan_divisi" => $divisi,
                "keanggotaan_jabatan" => $jabatan,
                "keanggotaan_email" => $email,
                "keanggotaan_telepon" => $telepon,
                "keanggotaan_motto" => $motto
            )
        );
        $this->db->where("akun_username", $username)->update("akun",
            array(
                "akun_keterangan" => $keterangan
            )
        );

        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();

            return array(
                "status" => 200,
                "keterangan" => "Profil berhasil ditambahkan."
            );
        } else {
            $this->db->trans_rollback();

            return array(
                "status" => 204,
                "keterangan" => "Profil gagal ditambahkan."
            );
        }
    }

    public function hapus($username)
    {
        $query = $this->db->where("keanggotaan_username", $username)->delete("keanggotaan");
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Profil berhasil dihapus."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Profil gagal dihapus."
            );
        }
    }

    public function username($username_lama, $username_baru)
    {
        $query = $this->db->where("keanggotaan_username", $username_lama)->update("keanggotaan",
            array(
                "keanggotaan_username" => $username_baru
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Username berhasil diperbarui."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Username gagal diperbarui."
            );
        }
    }

    public function password($username, $password)
    {
        $query = $this->db->where("akun_username", $username)->update("akun",
            array(
                "akun_password" => $password
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Kata sandi berhasil diperbarui"
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Kata sandi gagal diperbarui"
            );
        }
    }
}