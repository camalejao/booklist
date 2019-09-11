<?php

namespace App\Http\Controllers;

use App\Livro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LivrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Livro::with('autor')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|string|min:3|max:255|unique:livros',
            'descricao' => 'required|string',
            'avaliacao' => 'sometimes|integer|min:1|max:10',
            'status' => 'required|in:lendo,completado,desejado,pausado,desistido',
            'autor_id' => 'required|exists:autores,id',
        ]);

        $livro = Livro::create($request->all());

        return response()->json($livro, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function show(Livro $livro)
    {
        $livro->load('autor');
        return response()->json($livro, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function edit(Livro $livro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livro $livro)
    {
        $this->validate($request, [
            'titulo' => ['sometimes', 'string', 'min:3', 'max:255', Rule::unique('livros')->ignore($livro->id)],
            'descricao' => 'required|string',
            'avaliacao' => 'sometimes|integer|min:1|max:10',
            'status' => 'required|in:lendo,completado,desejado,pausado,desistido',
            'autor_id' => 'required|exists:autores,id',
        ]);
        
        $livro->update($request->all());

        return response()->json($livro, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro $livro)
    {
        $livro->delete();

        return response()->json(null, 204);
    }
}
