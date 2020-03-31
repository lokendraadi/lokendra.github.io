@extends('layout')

@section('judul', 'Edit Artikel')

@section('content')
    <form action="{{ route('artikel.simpanArtikel', [$id]) }}" method="POST">
        @csrf
        <input type="text" name="judul" placeholder="Masukan Judul" value="{{ $edit->judul_artikel }}">
        <br>
        <textarea cols="20" rows="10" name="konten">{{ $edit->content_artikel }}</textarea>
        <br>
        <label>Status</label>
        <input type="radio" name="status" value="1" {{ ($edit->status == 1) ? 'checked' : ''}}>Aktif
        <input type="radio" name="status" value="0" {{ ($edit->status == 0) ? 'checked' : ''}}>Tidak Aktif
        <br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    </form>
@endsection

