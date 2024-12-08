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

                    <!-- Tombol Edit yang membuka Modal -->
                    <button type="button" class="btn editBtn btn-warning" data-id="{{ $books->id }}"
                        data-isbn="{{ $books->isbn }}" data-judul="{{ $books->judul }}"
                        data-penulis="{{ $books->penulis }}" data-tanggal_terbit="{{ $books->tanggal_terbit }}"
                        data-stok="{{ $books->stok }}" onclick="openEditModal(this)">
                        Edit
                    </button>

                    <!-- Tombol Hapus yang sudah kita buat sebelumnya -->
                    <button type="button" class="btn hapusBtn btn-danger" data-id="{{ $books->id }}" title="Delete"
                        onclick="confirmDelete({{ $books->id }})">
                        <i class="fa fa-close"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<!-- Modal Edit -->
<div class="edit-modal" style="display: none;">
    <div class="edit-modal-content">
        <h2>Edit Buku</h2>
        <form action="{{ route('books.update', ['id' => '__ID__']) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="isbn" id="edit-isbn" placeholder="Edit ISBN" required>
            <input type="text" name="judul" id="edit-judul" placeholder="Edit Judul" required>
            <input type="text" name="penulis" id="edit-penulis" placeholder="Edit Penulis" required>
            <input type="date" name="tanggal_terbit" id="edit-tanggal_terbit" placeholder="Edit Tanggal Terbit"
                required>
            <input type="number" name="stok" id="edit-stok" placeholder="Edit Stok" required>
            <button type="submit">Update</button>
        </form>
        <button class="close-modal">Close</button>
    </div>
</div>

<style>
    /* Modal Overlay */
    .edit-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: none;
        justify-content: center;
        align-items: center;
    }

    .edit-modal-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        text-align: center;
    }

    .edit-modal-content input {
        margin: 10px 0;
        padding: 8px;
        width: 100%;
    }

    .edit-modal-content button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .edit-modal-content button.close-modal {
        background-color: #dc3545;
        margin-top: 10px;
    }
</style>

<script>
    function openEditModal(button) {
        const modal = document.querySelector('.edit-modal');
        const isbn = button.getAttribute('data-isbn');
        const judul = button.getAttribute('data-judul');
        const penulis = button.getAttribute('data-penulis');
        const tanggal_terbit = button.getAttribute('data-tanggal_terbit');
        const stok = button.getAttribute('data-stok');
        const bookId = button.getAttribute('data-id');

        const form = modal.querySelector('form');
        form.action = form.action.replace('__ID__', bookId);

        document.getElementById('edit-isbn').value = isbn;
        document.getElementById('edit-judul').value = judul;
        document.getElementById('edit-penulis').value = penulis;
        document.getElementById('edit-tanggal_terbit').value = tanggal_terbit;
        document.getElementById('edit-stok').value = stok;

        modal.style.display = 'flex';
    }

    document.querySelector('.close-modal').addEventListener('click', function() {
        document.querySelector('.edit-modal').style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        const modal = document.querySelector('.edit-modal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>
