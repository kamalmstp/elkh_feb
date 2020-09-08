<?php

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout_user');
Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('password', 'PasswordController@index')->name('password');
Route::post('password', 'PasswordController@save')->name('password_save');

Route::get('/users', 'UserController@list')->name('user_list');
Route::get('/users/add', 'UserController@add')->name('user_add');
Route::post('/users/', 'UserController@save')->name('user_save');
Route::get('/users/{id}/edit', 'UserController@edit')->name('user_edit');
Route::patch('/users/{id}', 'UserController@update')->name('user_update');
Route::delete('/users/{id}', 'UserController@delete')->name('user_delete');

Route::get('/pangkat', 'PangkatController@list')->name('pangkat_list');
Route::post('/pangkat', 'PangkatController@save')->name('pangkat_save');
Route::patch('/pangkat/{id}', 'PangkatController@update')->name('pangkat_update');
Route::delete('/pangkat/{id}', 'PangkatController@delete')->name('pangkat_delete');

Route::get('/bagian', 'BagianController@list')->name('bagian_list');
Route::post('/bagian', 'BagianController@save')->name('bagian_save');
Route::patch('/bagian/{id}', 'BagianController@update')->name('bagian_update');
Route::delete('/bagian/{id}', 'BagianController@delete')->name('bagian_delete');

Route::get('/satuan', 'SatuanController@list')->name('satuan_list');
Route::post('/satuan', 'SatuanController@save')->name('satuan_save');
Route::patch('/satuan/{id}', 'SatuanController@update')->name('satuan_update');
Route::delete('/satuan/{id}', 'SatuanController@delete')->name('satuan_delete');

Route::get('/tahun', 'TahunController@list')->name('tahun_list');
Route::post('/tahun', 'TahunController@save')->name('tahun_save');
Route::patch('/tahun/{id}', 'TahunController@update')->name('tahun_update');
Route::delete('/tahun/{id}', 'TahunController@delete')->name('tahun_delete');

Route::get('/lkh', 'LkhController@list')->name('lkh_list');
Route::post('/lkh', 'LkhController@save')->name('lkh_save');
Route::patch('/lkh/{id}', 'LkhController@update')->name('lkh_update');
Route::delete('/lkh/{id}', 'LkhController@delete')->name('lkh_delete');
Route::get('/lkh/{id}/detail', 'LkhController@detail')->name('lkh_detail');
Route::post('/lkh/{id}/detail', 'LkhController@detail_save')->name('lkh_detailsave');
Route::patch('/lkh/{id}/detail', 'LkhController@detail_update')->name('lkh_detailupdate');
Route::delete('/lkh/{id}/detail', 'LkhController@detail_delete')->name('lkh_detaildelete');
Route::post('/lkh/{id}/detail', 'LkhController@detail_save')->name('lkh_detailsave');
Route::post('/lkh/pdf', 'LkhController@pdf')->name('lkh_pdf');
Route::post('/lkh/pdf/rekap', 'LkhController@pdf2')->name('lkh_pdf2');

Route::get('/skp', 'SkpController@list')->name('skp_list');
Route::post('/skp', 'SkpController@save')->name('skp_save');
Route::patch('/skp/{id}', 'SkpController@update')->name('skp_update');
Route::delete('/skp/{id}', 'SkpController@delete')->name('skp_delete');
Route::get('/skp/{id}/kegiatan', 'SkpController@kegiatan_list')->name('skpkegiatan_list');
Route::post('/skp/{id}/kegiatan', 'SkpController@kegiatan_save')->name('skpkegiatan_save');
Route::patch('/skp/{id}/kegiatan', 'SkpController@kegiatan_update')->name('skpkegiatan_update');
Route::delete('/skp/{id}/kegiatan', 'SkpController@kegiatan_delete')->name('skpkegiatan_delete');
Route::get('/skp/{id}/target/{jangka_id}', 'SkpController@target_list')->name('target_list');
Route::patch('/skp/{id}/target/{jangka_id}', 'SkpController@target_update')->name('target_update');
Route::post('/skp/{id}/target/{jangka_id}/pdf', 'SkpController@target_pdf')->name('target_pdf');

Route::get('/skp/{id}/realisasi', 'SkpController@realisasi_jangka')->name('realisasi_jangka');
Route::get('/skp/{id}/realisasi/{jangka_id}', 'SkpController@realisasi_list')->name('realisasi_list');
Route::patch('/skp/{id}/realisasi/{jangka_id}', 'SkpController@realisasi_update')->name('realisasi_update');
Route::get('/skp/{id}/tambahan/{jangka_id}', 'SkpController@tambahan_list')->name('tambahan_list');
Route::post('/skp/{id}/tambahan/{jangka_id}', 'SkpController@tambahan_save')->name('tambahan_save');
Route::patch('/skp/{id}/tambahan', 'SkpController@tambahan_update')->name('tambahan_update');
Route::delete('/skp/{id}/tambahan', 'SkpController@tambahan_delete')->name('tambahan_delete');
Route::post('/skp/{id}/realisasi/{jangka_id}/pdf', 'SkpController@realisasi_pdf')->name('realisasi_pdf');

Route::get('/skp/{id}/penilaian/{jangka_id}', 'SkpController@penilaian_list')->name('penilaian_list');
Route::patch('/skp/{id}/penilaian/{jangka_id}', 'SkpController@penilaian_update')->name('penilaian_update');
Route::post('/skp/{id}/penilaian/{jangka_id}/pdf', 'SkpController@penilaian_pdf')->name('penilaian_pdf');

Route::get('/skp/kegiatan', 'KegiatanSkpController@list')->name('kegiatan_list');
Route::post('/skp/kegiatan', 'KegiatanSkpController@save')->name('kegiatan_save');
Route::patch('/skp/kegiatan/{id}', 'KegiatanSkpController@update')->name('kegiatan_update');
Route::delete('/skp/kegiatan/{id}', 'KegiatanSkpController@delete')->name('kegiatan_delete');

Route::get('/bawahan', 'BawahanController@list')->name('bawahan_list');
Route::get('/bawahan/lkh/{id}', 'BawahanController@lkhb_list')->name('lkhb_list');
Route::get('/bawahan/lkh/{id}/detail', 'BawahanController@lkhb_detail')->name('lkhb_detail');
Route::get('/bawahan/skp/{id}', 'BawahanController@skpb_list')->name('skpb_list');
Route::get('/bawahan/skp/{id}/target', 'BawahanController@targetb_jangka')->name('targetb_jangka');
Route::get('/bawahan/skp/{id}/target/{jangka_id}', 'BawahanController@targetb_list')->name('targetb_list');
Route::get('/bawahan/skp/{id}/realisasi', 'BawahanController@realisasib_jangka')->name('realisasib_jangka');
Route::get('/bawahan/skp/{id}/realisasi/{jangka_id}', 'BawahanController@realisasib_list')->name('realisasib_list');
Route::patch('/bawahan/skp/{id}/realisasi/{jangka_id}', 'BawahanController@realisasib_status')->name('realisasib_status');
Route::get('bawahan/skp/{id}/penilaian/{jangka_id}', 'BawahanController@penilaianb_list')->name('penilaianb_list');
Route::patch('bawahan/skp/{id}/penilaian/{jangka_id}', 'BawahanController@penilaianb_status')->name('penilaianb_status');
