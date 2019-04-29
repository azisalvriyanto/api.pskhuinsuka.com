<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class M_Keuangan extends CI_Model {
    public function daftar($periode, $bulan)
    {
        if (!empty($bulan) && is_numeric($bulan)) {
            $query = $this->db->select("bulan.bulan_keterangan, keuangan.*")->from("keuangan")
            ->join("bulan", "bulan.bulan_id=MONTH(keuangan.keuangan_tanggal)")
            ->where("keuangan_periode", $periode)
            ->where("MONTH(keuangan_tanggal)", $bulan)
            ->order_by("keuangan_tanggal", "ASC")
            ->get();
        } else {
            $query = $this->db->select("bulan.bulan_keterangan, keuangan.*")->from("keuangan")
            ->join("bulan", "bulan.bulan_id=MONTH(keuangan.keuangan_tanggal)")
            ->where("keuangan_periode", $periode)
            ->order_by("keuangan_tanggal", "ASC")
            ->get();
        }

        if ($query->num_rows() > 0) {
            return array(
                "status" => 200,
                "keterangan" => json_decode(json_encode($query->result()), TRUE)
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Laporan tidak ditemukan."
            );
        }
    }

    public function bulan_daftar($periode) {
        $query = $this->db->select("keuangan.keuangan_tanggal, bulan.*")->from("keuangan")
        ->join("bulan", "bulan.bulan_id=MONTH(keuangan.keuangan_tanggal)")
        ->where("keuangan_periode", $periode)
        ->order_by("MONTH(keuangan.keuangan_tanggal)", "ASC")
        ->order_by("keuangan.keuangan_id", "ASC")
        ->get();

        if ($query->num_rows() > 0) {
            return array("status" => 200, "keterangan" => json_decode(json_encode($query->result()), TRUE));
        }
        else {
            return array("status" => 204, "keterangan" => "Data tidak ditemukan.");
        }
    }

    public function lihat($id) {
        $query = $this->db->select("*")->from("keuangan")
        ->join("bulan", "bulan.bulan_id=MONTH(keuangan.keuangan_tanggal)")
        ->where("keuangan_id", $id)
        ->get();

        if ($query->num_rows() > 0) {
            $query = $query->row();
            return array(
                "status" => 200,
                    "keterangan" => array(
                        "id" => $query->keuangan_id,
                        "periode" => $query->keuangan_periode,
                        "tanggal" => date("d/m/Y", strtotime($query->keuangan_tanggal)),
                        "judul" => $query->keuangan_judul,
                        "jumlah" => $query->keuangan_jumlah,
                        "keterangan" => $query->keuangan_keterangan,
                        "nominal" => $query->keuangan_nominal
                    )
            );
        }
        else {
            return array("status" => 204, "keterangan" => "Data tidak ditemukan.");
        }
    }

    public function tambah(
        $periode,
        $tanggal,
        $judul,
        $jumlah,
        $keterangan,
        $nominal
    ) {
        $query = $this->db->insert("keuangan",
            array(
                "keuangan_periode" => $periode,
                "keuangan_tanggal" => $tanggal,
                "keuangan_judul" => $judul,
                "keuangan_jumlah" => $jumlah,
                "keuangan_keterangan" => $keterangan,
                "keuangan_nominal" => $nominal
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Data keuangan berhasil diperbarui."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Data keuangan gagal diperbarui."
            );
        }
    }

    public function perbarui(
        $id,
        $tanggal,
        $judul,
        $jumlah,
        $keterangan,
        $nominal
    ) {
        $query = $this->db->where("keuangan_id", $id)->update("keuangan",
            array(
                "keuangan_tanggal" => $tanggal,
                "keuangan_judul" => $judul,
                "keuangan_jumlah" => $jumlah,
                "keuangan_keterangan" => $keterangan,
                "keuangan_nominal" => $nominal
            )
        );
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Data keuangan berhasil diperbarui."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Data keuangan gagal diperbarui."
            );
        }
    }

    public function hapus($id)
    {
        $query = $this->db->where("keuangan_id", $id)->delete("keuangan");
        if (!empty($query)) {
            return array(
                "status" => 200,
                "keterangan" => "Data berhasil dihapus."
            );
        }
        else {
            return array(
                "status" => 204,
                "keterangan" => "Data gagal dihapus."
            );
        }
    }
}