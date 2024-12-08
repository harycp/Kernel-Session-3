@include('layout')

<div>
    <h1 style="text-align: left; font-size: 26px">CRUD Laravel</h1>
    @include('create')
    <table>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th style="width: 15%">Tanggal Terbit</th>
            <th>Aksi</th>
        </tr>

        @foreach ($dataBooks as $books)
            <tr>
                <td>{{ $books->judul }}</td>
                <td>{{ $books->penulis }}</td>
                <td>{{ $books->tanggal_terbit }}</td>
                <td>
                    <button class="open-modal">
                        <a href="{{ route('books.detail', ['id' => $books->id]) }}">Detail</a>
                    </button>

                    <button type="button" class="btn hapusBtn btn-danger" data-id="{{ $books->id }}" title="Delete"
                        onclick="confirmDelete({{ $books->id }})">
                        Hapus
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
</div>


<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>
<script>
    function confirmDelete(bookId) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = "{{ route('books.delete', ['id' => '__ID__']) }}".replace('__ID__', bookId);
        }
    }
</script>
