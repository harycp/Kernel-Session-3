<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index_books()
    {
        $dataBooks = DB::table('books')->get();

        return view('home', compact('dataBooks')) 
            ->with('title', 'Kernel Session - Session 3');
    }

    public function store_books(Request $request)
    {

        try { 
            DB::table('books')->insert([
                'isbn' => $request->isbn,
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'tanggal_terbit' => $request->tanggal_terbit,
                'stok' => $request->stok,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect('/')->with('success', 'Data berhasil disimpan')->with('title', 'Kernel Session - Session 3');
        }catch (\Exception $e) {
            Log::info($e->getMessage());
            return redirect('/')->with('error', 'Data gagal disimpan');
        }
    }

    public function detail_book(Request $request)
    {
        $id = $request->input('id');
        $dataBook = DB::table('books')->where('id', $id)->first();

        return view('detail', compact('dataBook'));
    }

    public function delete_book(Request $request)
    {
        $id = $request->input('id');
        DB::table('books')->where('id', $id)->delete();
        return redirect('/')->with('success', 'Data berhasil dihapus')->with('title', 'Kernel Session - Session 3');
    }

    public function update_book(Request $request)
    {
        $id = $request->input('id');    
        $book = DB::table('books')->find($id);

        if (!$book) {
            return redirect()->route('/')->with('error', 'Buku tidak ditemukan!');
        }

        $book->isbn = $request->isbn;
        $book->judul = $request->judul;
        $book->penulis = $request->penulis;
        $book->tanggal_terbit = $request->tanggal_terbit;
        $book->stok = $request->stok;

        $book->save();

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

}
