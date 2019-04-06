<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route["default_controller"]	= "Awal";
$route["404_override"]			= "Galat/_404";
$route["translate_uri_dashes"]	= FALSE;

//API
$route["otentikasi"]        = "Otentikasi/index";
$route["otentikasi/masuk"]  = "Otentikasi/masuk";
$route["otentikasi/keluar"] = "Otentikasi/keluar";

$route["organisasi"]                = "Organisasi/index";
$route["organisasi/perbarui"]       = "Organisasi/perbarui";
$route["organisasi/(:num)"]         = "Organisasi/lihat/$1";

$route["keanggotaan"]               = "Keanggotaan/index";
$route["keanggotaan/tambah"]        = "Keanggotaan/tambah";
$route["keanggotaan/perbarui"]      = "Keanggotaan/perbarui";
$route["keanggotaan/username"]      = "Keanggotaan/username";
$route["keanggotaan/password"]      = "Keanggotaan/password";
$route["keanggotaan/hapus"]         = "Keanggotaan/index";
$route["keanggotaan/hapus/(:any)"]  = "Keanggotaan/hapus/$1";
$route["keanggotaan/(:num)"]        = "Keanggotaan/daftar/$1";
$route["keanggotaan/(:num)/(:any)"] = "Keanggotaan/lihat/$1/$2";

$route["divisi"]                = "Divisi/daftar";
$route["divisi/jabatan"]        = "Divisi/index";
$route["divisi/jabatan/(:any)"] = "Divisi/jabatan/$1";
$route["divisi/(:any)"]         = "Divisi/lihat/$1";

$route["jpendapat"]         = "JPendapat/daftar";
$route["jpendapat/simpan"]  = "JPendapat/simpan";

$route["artikel"]               = "Artikel/index";
$route["artikel/tambah"]        = "Artikel/tambah";
$route["artikel/hapus/(:num)"]  = "Artikel/hapus/$1";

$route["galeri"]        = "Galeri/index";
$route["galeri/simpan"] = "Galeri/simpan";
$route["galeri/(:num)"] = "Galeri/lihat/$1";

$route["pengaturan"] = "Pengaturan/index";
$route["pengaturan/renew"] = "Pengaturan/renew";
$route["pengaturan/hapus/(:num)"] = "Pengaturan/hapus/$1";