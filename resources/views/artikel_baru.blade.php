@extends('layout')

@section('judul', 'Tambah Artikel')

@section('content')
    <form action="{{ route('artikel.simpanArtikel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="judul" placeholder="Masukan Judul">
        <br>
        <textarea cols="20" rows="10" name="konten"></textarea>
        <br>
        <label>Status</label>
        <input type="radio" name="status" value="1">Aktif
        <input type="radio" name="status" value="0">Tidak Aktif
        <br>
        <input type="file" name="gambar" accept="image/jpg,image/jpeg,image/png">
        <br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    </form>
@endsection

