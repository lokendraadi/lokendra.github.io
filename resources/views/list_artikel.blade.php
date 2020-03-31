@extends('layout')

@section('judul', 'List Artikel')

@section('content')
    <br>
    <a href="{{ route('artikel.newArtikel') }}"><button class="btn btn-success">Tambah Artikel</button></a>
    <br>
    <br>
    <table border="1">
        <thead>
            <th>Judul </th>
            <th>Gambar </th>
            <th>Status </th>
            <th>Action </th>
        </thead>
        <tbody>
             @foreach($artikel as $item)
                    <tr>
                        <td>{{ $item->judul_artikel }}</td>
                        <td>
                            <img src="{{ $lokasi_gambar.$item->gambar }}">
                        </td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="{{ route('artikel.editArtikel', [$item->id]) }}"><button class="btn btn-warning">Edit</button></a>
                            <a href="{{ route('artikel.deleteArtikel', [$item->id]) }}" onclick="return confirm('Apakah anda ingin menghapus data ini?')"><button class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
             @endforeach
        </tbody>
    </table>

@endsection

