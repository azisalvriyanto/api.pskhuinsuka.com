<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Pengaturan extends CI_Model {
    public function hapus($periode)
    {
        $organisasi = $this->db->where("organisasi_periode", $periode)->delete("organisasi");
        if (!empty($organisasi)) {
            @unlink("../pskhuinsuka.com/assets/gambar/organisasi/".$periode."_logo.png");
            @unlink("../pskhuinsuka.com/assets/gambar/organisasi/".$periode."_landscape.png");
            @unlink("../pskhuinsuka.com/assets/gambar/organisasi/".$periode."_portrait.png");
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

    public function renew(
        $periode_sekarang,
        $periode_baru,
        $username,
        $password,
        $nama,
        $email,
        $telepon,
        $motto
    ) {
        $sekarang_organisasi    = $this->M_Organisasi->lihat($periode_sekarang);
        $sekarang_organisasi    = $sekarang_organisasi["keterangan"];
        $sekarang_galeri        = $this->M_Galeri->lihat($periode_sekarang);

        $this->db->trans_begin();
        $this->db->insert("organisasi",
            array(
                "organisasi_periode" => $periode_baru,
                "organisasi_nama_panjang" => $sekarang_organisasi["nama_panjang"],
                "organisasi_nama_pendek" => $sekarang_organisasi["nama_pendek"],
                "organisasi_visi" => $sekarang_organisasi["visi"],
                "organisasi_misi" => $sekarang_organisasi["misi"],
                "organisasi_deskripsi" => $sekarang_organisasi["deskripsi"],
                "organisasi_tentang" => $sekarang_organisasi["tentang"],
                "organisasi_sejarah" => $sekarang_organisasi["sejarah"],
                "organisasi_alamat" => $sekarang_organisasi["kontak"]["alamat"],
                "organisasi_email" => $sekarang_organisasi["kontak"]["email"],
                "organisasi_telepon" => $sekarang_organisasi["kontak"]["telepon"],
                "organisasi_facebook" => $sekarang_organisasi["kontak"]["facebook"],
                "organisasi_twitter" => $sekarang_organisasi["kontak"]["twitter"],
                "organisasi_instagram" => $sekarang_organisasi["kontak"]["instagram"],
                "organisasi_youtube" => $sekarang_organisasi["kontak"]["youtube"],
                "organisasi_peta" => $sekarang_organisasi["kontak"]["peta"]
            )
        );
        $this->db->insert("galeri",
            array(
                "galeri_periode" => $periode_baru,
                "galeri_instagram" => $sekarang_galeri["keterangan"]["instagram"]
            )
        );
        $this->db
        ->where("akun_periode", $periode_sekarang)
        ->update("akun",
            array(
                "akun_keterangan" => 0,
            )
        );
        $this->db->insert("keanggotaan",
            array(
                "keanggotaan_periode" => $periode_baru,
                "keanggotaan_nama" => $nama,
                "keanggotaan_username" => $username,
                "keanggotaan_divisi" => 1,
                "keanggotaan_jabatan" => 1,
                "keanggotaan_email" => $email,
                "keanggotaan_telepon" => $telepon,
                "keanggotaan_motto" => $motto
            )
        );
        $this->db->insert("akun",
            array(
                "akun_keterangan" => 1,
                "akun_periode" => $periode_baru,
                "akun_username" => $username,
                "akun_password" => $password
            )
        );

        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            $path = "../pskhuinsuka.com/assets/gambar/organisasi";
            @copy($path."/".$periode_sekarang."_logo.png", $path."/".$periode_baru."_logo.png");
            @copy($path."/".$periode_sekarang."_landscape.png", $path."/".$periode_baru."_landscape.png");
            @copy($path."/".$periode_sekarang."_portrait.png", $path."/".$periode_baru."_portrait.png");

            return array(
                "status" => 200,
                "keterangan" => "Kepengurusan berhasil diganti."
            );
        } else {
            $this->db->trans_rollback();

            return array(
                "status" => 204,
                "keterangan" => "Kepengurusan gagal diganti."
            );
        }
    }
}