<!-- Modal Create -->
<div class="detail-modal">
    <div class="detail-modal-content">
        <h2>Detail Buku</h2>
        <p>ISBN: {{ $dataBook->isbn }}</p>
        <p>Judul: {{ $dataBook->judul }}</p>
        <p>Penulis: {{ $dataBook->penulis }}</p>
        <p>Tanggal Terbit: {{ $dataBook->tanggal_terbit }}</p>
        <p>Stok: {{ $dataBook->stok }}</p>
        <button class="close-modal"> <a href="/">Kembali</a></button>
    </div>
</div>
