<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'Auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/* Auth */
$route['login'] = 'Auth/login';
$route['login_process'] = 'Auth/login_process';
$route['registrasi'] = 'Auth/registration';
$route['register_process'] = 'Auth/register_process';
$route['guest_book'] = 'Auth/guest_book';

/* Admin */
$route['admin_side/beranda'] = 'admin/App/home';
$route['admin_side/buku_tamu'] = 'admin/App/guest_book';
$route['admin_side/log_activity'] = 'admin/App/log_activity';
$route['admin_side/hapus_aktifitas/(:any)'] = 'admin/App/deleted_log/$1';
$route['admin_side/cleaning_log'] = 'admin/App/cleaning_log';
$route['admin_side/versioning_aplikasi'] = 'admin/App/about';
$route['admin_side/bantuan'] = 'admin/App/helper';
$route['admin_side/profil'] = 'admin/App/profile';
$route['admin_side/pengaturan_kata_sandi'] = 'admin/App/password_setting';
$route['admin_side/perbarui_profil'] = 'admin/App/profile_update';
$route['admin_side/perbarui_kata_sandi'] = 'admin/App/password_update';

$route['admin_side/administrator'] = 'admin/Master/administrator_data';
$route['admin_side/tambah_data_admin'] = 'admin/Master/add_administrator_data';
$route['admin_side/simpan_data_admin'] = 'admin/Master/save_administrator_data';
$route['admin_side/ubah_data_admin/(:any)'] = 'admin/Master/edit_administrator_data/$1';
$route['admin_side/perbarui_data_admin'] = 'admin/Master/update_administrator_data';
$route['admin_side/atur_ulang_kata_sandi_admin/(:any)'] = 'admin/Master/reset_password_administrator_account/$1';
$route['admin_side/hapus_data_admin/(:any)'] = 'admin/Master/delete_administrator_data/$1';

$route['admin_side/data_petugas'] = 'admin/Master/member_data';
$route['admin_side/tambah_data_petugas'] = 'admin/Master/add_member_data';
$route['admin_side/simpan_data_petugas'] = 'admin/Master/save_member_data';
$route['admin_side/ubah_data_petugas/(:any)'] = 'admin/Master/edit_member_data/$1';
$route['admin_side/perbarui_data_petugas'] = 'admin/Master/update_member_data';
$route['admin_side/atur_ulang_kata_sandi_petugas/(:any)'] = 'admin/Master/reset_password_member_account/$1';
$route['admin_side/hapus_data_petugas/(:any)'] = 'admin/Master/delete_member_data/$1';

$route['admin_side/jadwal_kegiatan'] = 'admin/Master/jadwal_kegiatan';
$route['admin_side/timeline_kegiatan'] = 'admin/Master/timeline_kegiatan';
$route['admin_side/tambah_jadwal_kegiatan'] = 'admin/Master/tambah_jadwal_kegiatan';
$route['admin_side/ubah_jadwal_kegiatan/(:any)'] = 'admin/Master/ubah_jadwal_kegiatan/$1';
$route['admin_side/perbarui_jadwal_kegiatan'] = 'admin/Master/perbarui_jadwal_kegiatan';
$route['admin_side/laporan_kegiatan'] = 'admin/Report/laporan_kegiatan';
$route['admin_side/hapus_jadwal_kegiatan/(:any)'] = 'admin/Master/hapus_jadwal_kegiatan/$1';
$route['admin_side/tambah_laporan_kegiatan'] = 'admin/Report/tambah_laporan_kegiatan';
$route['admin_side/simpan_laporan_kegiatan'] = 'admin/Report/simpan_laporan_kegiatan';
$route['admin_side/detail_laporan_kegiatan/(:any)'] = 'admin/Report/detail_laporan_kegiatan/$1';
$route['admin_side/hapus_laporan_kegiatan/(:any)'] = 'admin/Report/hapus_laporan_kegiatan/$1';

/* Petugas */
$route['spv_side/beranda'] = 'spv/App/home';
$route['spv_side/buku_tamu'] = 'spv/App/guest_book';
$route['spv_side/log_activity'] = 'spv/App/log_activity';
$route['spv_side/hapus_aktifitas/(:any)'] = 'spv/App/deleted_log/$1';
$route['spv_side/cleaning_log'] = 'spv/App/cleaning_log';
$route['spv_side/versioning_aplikasi'] = 'spv/App/about';
$route['spv_side/bantuan'] = 'spv/App/helper';
$route['spv_side/profil'] = 'spv/App/profile';
$route['spv_side/pengaturan_kata_sandi'] = 'spv/App/password_setting';
$route['spv_side/perbarui_profil'] = 'spv/App/profile_update';
$route['spv_side/perbarui_kata_sandi'] = 'spv/App/password_update';

$route['spv_side/data_petugas'] = 'spv/Master/member_data';

$route['spv_side/jadwal_kegiatan'] = 'spv/Master/jadwal_kegiatan';
$route['spv_side/timeline_kegiatan'] = 'spv/Master/timeline_kegiatan';
$route['spv_side/tambah_jadwal_kegiatan'] = 'spv/Master/tambah_jadwal_kegiatan';
$route['spv_side/ubah_jadwal_kegiatan/(:any)'] = 'spv/Master/ubah_jadwal_kegiatan/$1';
$route['spv_side/perbarui_jadwal_kegiatan'] = 'spv/Master/perbarui_jadwal_kegiatan';
$route['spv_side/laporan_kegiatan'] = 'spv/Report/laporan_kegiatan';
$route['spv_side/hapus_jadwal_kegiatan/(:any)'] = 'spv/Master/hapus_jadwal_kegiatan/$1';
$route['spv_side/tambah_laporan_kegiatan'] = 'spv/Report/tambah_laporan_kegiatan';
$route['spv_side/simpan_laporan_kegiatan'] = 'spv/Report/simpan_laporan_kegiatan';
$route['spv_side/detail_laporan_kegiatan/(:any)'] = 'spv/Report/detail_laporan_kegiatan/$1';
$route['spv_side/hapus_laporan_kegiatan/(:any)'] = 'spv/Report/hapus_laporan_kegiatan/$1';

/* Guest */
$route['guest_side/beranda'] = 'guest/App/home';
$route['guest_side/versioning_aplikasi'] = 'guest/App/about';
$route['guest_side/bantuan'] = 'guest/App/helper';

$route['guest_side/jadwal_kegiatan'] = 'guest/Master/jadwal_kegiatan';
$route['guest_side/timeline_kegiatan'] = 'guest/Master/timeline_kegiatan';
$route['guest_side/laporan_kegiatan'] = 'guest/Report/laporan_kegiatan';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8