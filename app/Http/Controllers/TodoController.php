<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Menampilkan daftar ToDo
    public function index()
    {
        $todos = Todo::latest()->get();
        return view('todos.index', compact('todos'));
    }

    // Menampilkan form untuk membuat ToDo baru
    public function create()
    {
        return view('todos.create');
    }

    // Menyimpan data ToDo baru ke database
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Cek apakah checkbox 'selesai' dicentang
        $isCompleted = $request->has('is_completed');

        // Simpan data ke database
        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $isCompleted,
            'completed_at' => $isCompleted ? now() : null,
        ]);

        return redirect()->route('todos.index')->with('success', 'ToDo berhasil ditambahkan!');
    }

    public function updateStatus($id)
    {
        // Cari data ToDo berdasarkan ID
        $todo = Todo::findOrFail($id);

        // Update statusnya secara manual (jika 0 jadi 1, jika 1 jadi 0)
        $todo->update([
            'is_completed' => $todo->is_completed ? 0 : 1,
            'completed_at' => $todo->is_completed ? null : now(),
        ]);

        return redirect()->route('todos.index')->with('success', 'Status ToDo berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'ToDo berhasil dihapus!');
    }
}