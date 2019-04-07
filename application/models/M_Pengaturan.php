<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Pengaturan extends CI_Model {
    public function hapus($periode)
    {
        $query = $this->db->where("periode_id", $periode)->delete("periode");
        if (!empty($query)) {
            @unlink("../pskhuinsuka.com/assets/gambar/organisasi/logo_".$periode.".png");
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
        $periode,
        $username,
        $password,
        $nama,
        $email,
        $telepon,
        $motto
    ) {
        $periode_dahulu = $this->M_Periode->daftar();
        if ($periode_dahulu["status"] === 200) {
            $organisasi = $this->M_Organisasi->lihat($periode_dahulu["keterangan"][count($periode_dahulu["keterangan"])-1]["periode_id"]);
            $galeri		= $this->M_Galeri->lihat($periode_dahulu["keterangan"][count($periode_dahulu["keterangan"])-1]["periode_id"]);
            if ($organisasi["status"] === 200 && $galeri["status"] === 200) {
                $this->db->trans_begin();
                $this->db->insert("periode",
                    array(
                        "periode_keterangan" => $periode
                    )
                );
                $periode_sekarang = $this->M_Periode->daftar();
                $this->db->insert("organisasi",
                    array(
                        "organisasi_periode" => $periode_sekarang["keterangan"][count($periode_sekarang["keterangan"])-1]["periode_id"],
                        "organisasi_nama_lengkap" => $organisasi["keterangan"]["nama_lengkap"],
                        "organisasi_nama_pendek" => $organisasi["keterangan"]["nama_pendek"],
                        "organisasi_visi" => $organisasi["keterangan"]["visi"],
                        "organisasi_misi" => $organisasi["keterangan"]["misi"],
                        "organisasi_deskripsi" => $organisasi["keterangan"]["deskripsi"],
                        "organisasi_tentang" => $organisasi["keterangan"]["tentang"],
                        "organisasi_sejarah" => $organisasi["keterangan"]["sejarah"],
                        "organisasi_alamat" => $organisasi["keterangan"]["kontak"]["alamat"],
                        "organisasi_email" => $organisasi["keterangan"]["kontak"]["email"],
                        "organisasi_telepon" => $organisasi["keterangan"]["kontak"]["telepon"],
                        "organisasi_facebook" => $organisasi["keterangan"]["kontak"]["facebook"],
                        "organisasi_twitter" => $organisasi["keterangan"]["kontak"]["twitter"],
                        "organisasi_instagram" => $organisasi["keterangan"]["kontak"]["instagram"],
                        "organisasi_youtube" => $organisasi["keterangan"]["kontak"]["youtube"],
                        "organisasi_peta" => $organisasi["keterangan"]["kontak"]["peta"]
                    )
                );
                $this->db->insert("galeri",
                    array(
                        "galeri_periode" => $periode_sekarang["keterangan"][count($periode_sekarang["keterangan"])-1]["periode_id"],
                        "galeri_instagram" => $galeri["keterangan"]["instagram"]
                    )
                );
                $this->db
                ->where("akun_periode", $periode_dahulu["keterangan"][count($periode_dahulu["keterangan"])-1]["periode_id"])
                ->where("akun_keterangan", 1)
                ->update("akun",
                    array(
                        "akun_keterangan" => 0,
                    )
                );
                $this->db->insert("keanggotaan",
                    array(
                        "keanggotaan_periode" => $periode_sekarang["keterangan"][count($periode_sekarang["keterangan"])-1]["periode_id"],
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
                        "akun_periode" => $periode_sekarang["keterangan"][count($periode_sekarang["keterangan"])-1]["periode_id"],
                        "akun_username" => $username,
                        "akun_password" => $password
                    )
                );

                if ($this->db->trans_status() === TRUE) {
                    $this->db->trans_commit();
                    $path = "../pskhuinsuka.com/assets/gambar/organisasi";
                    @copy($path."/logo_".$periode_dahulu["keterangan"][count($periode_dahulu["keterangan"])-1]["periode_id"].".png", $path."/logo_".$periode_sekarang["keterangan"][count($periode_sekarang["keterangan"])-1]["periode_id"].".png");

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
            } else {
                return array(
                    "status" => 204,
                    "keterangan" => "Kepengurusan gagal diganti."
                );
            }
        } else {
            return array(
                "status" => 204,
                "keterangan" => "Kepengurusan gagal diganti."
            );
        }
    }
}