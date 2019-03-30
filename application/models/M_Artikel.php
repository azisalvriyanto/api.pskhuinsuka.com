<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Artikel extends CI_Model {
    public function tambah(
        $keterangan,
		$penerbit,
		$judul,
		$isi
    ) {
        $query = $this->db->insert("artikel",
            array(
                "artikel_keterangan" => $keterangan,
                "artikel_penerbit" => $penerbit,
                "artikel_judul" => $judul,
                "artikel_isi" => $isi
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => array(
                    "id" => $this->db->insert_id()
                )
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Artikel gagal ditambahkan."
            );
        }
    }

    public function perbarui(
        $id,
        $keterangan,
		$judul,
		$isi
    ) {
        $query = $this->db->where("artikel_id", $id)->update("artikel",
            array(
                "artikel_keterangan" => $keterangan,
                "artikel_judul" => $judul,
                "artikel_isi" => $isi
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Artikel berhasil diperbarui."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Artikel gagal diperbarui."
            );
        }
    }

    public function hapus($id)
    {
        $query = $this->db->where("artikel_id", $id)->delete("artikel");
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Artikel berhasil dihapus."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Artikel gagal dihapus."
            );
        }
    }
}