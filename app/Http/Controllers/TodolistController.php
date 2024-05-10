<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $todo = todo::where('user_id', auth()->user()->id)->get();
        return view('index', compact('todo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required'
        ]);



        todo::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
        ]);


        return redirect()->back()->with('succes', 'the list hass been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $todo = Todo::findOrFail($id);

        // Memperbarui status todo berdasarkan data yang diterima dari request
        $status = $request->input('status');

        // Memastikan status yang diterima valid (Todo, In progress, atau Complete)
        if ($status === 'Todo' || $status === 'In progress' || $status === 'Complete') {
            $todo->status = $status;
            $todo->save();

            return redirect()->route('todo.index')->with('success', 'Status todo berhasil diperbarui.');
        } else {
            // Jika status tidak valid, kembalikan respons dengan pesan kesalahan
            return redirect()->back()->with('error', 'Status yang dimasukkan tidak valid.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $todo = todo::findOrFail($id);
        $todo->delete();

        return redirect()->back()->with('succes', 'the list hass been created');
    }
}
