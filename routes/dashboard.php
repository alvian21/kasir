<?php

Route::get('/','AuthController@index')->name('login');
Route::post('/','AuthController@login')->name('postlogin');


Route::group([
    'namespace'     => 'Dashboard',
    'prefix'        => 'admin',
    'middleware'    => ['auth','checkRole:admin']], function(){
        Route::get('/dashboard','DashboardController@index');
        Route::get('/karyawan','KaryawanController@karyawan')->name('karyawan');
        Route::get('/karyawan/edit/{id}','KaryawanController@getEdit')->name('karyawan.edit');
        Route::post('/karyawan/edit/{id}','KaryawanController@Edit')->name('karyawan.update');
        Route::get('/karyawan/create','KaryawanController@create')->name('karyawan.create');
        Route::get('/karyawan/delete','KaryawanController@delete')->name('karyawan.delete');
        Route::post('/karyawan/create','KaryawanController@store')->name('karyawan.store');
        Route::get('/barang','DashboardController@barang')->name('barang');
        Route::post('/barang','DashboardController@barangBaru')->name('tmbbarang');
        Route::post('/fetchdata','DashboardController@fetchdata');
        Route::post('/barang/edit','DashboardController@editBarang')->name('editbarang');
        Route::get('/barang/delete','DashboardController@deleteBarang')->name('deleteBarang');
        Route::get('/logout','DashboardController@logout')->name('logout');
});

Route::group([
    'namespace'     => 'Dashboard',
    'prefix'        => 'admin',
    'middleware'    => ['auth','checkRole:admin,karyawan']], function(){
        Route::get('/dashboard','DashboardController@index');
        Route::post('/pembelian/fetch','PembelianController@fetchform')->name('beli.fetch');
        Route::post('/pembelian/hitung','PembelianController@hitung')->name('beli.hitung');
        Route::get('/pembelian/hitung','PembelianController@hitung');
        Route::post('/member/fetch','MemberController@fetchdata')->name('member.fetch');
        Route::post('/member/edit','MemberController@edit')->name('member.edit');
        Route::get('/member/delete','MemberController@delete')->name('member.delete');
        Route::get('/member','MemberController@index')->name('member');
        Route::post('/member','MemberController@store')->name('member.store');
        Route::get('/barang','DashboardController@barang')->name('barang');
        Route::post('/barang','DashboardController@barangBaru')->name('tmbbarang');
        Route::post('/fetchdata','DashboardController@fetchdata');
        Route::get('/pembelian','PembelianController@index')->name('pembelian');
        Route::post('/barang/edit','DashboardController@editBarang')->name('editbarang');
        Route::get('/barang/delete','DashboardController@deleteBarang')->name('deleteBarang');
        Route::get('/transaksi','TransactionController@index')->name('transaksi');
        Route::get('/transaksi/delete','TransactionController@delete')->name('transaksi.delete');
        Route::get('/transaksi/detail/{id}','TransactionController@detail')->name('detail');
        Route::get('/logout','DashboardController@logout')->name('logout');
});
