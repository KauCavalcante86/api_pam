<?php

namespace App\Http\Controllers;

use App\Models\Usuario;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('admin.usuarios')->with('usuarios', $usuarios);
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

    public function storeApi(Request $request)
    {
        dd($request->all());
        $usuario = new Usuario();
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->senha = Hash::make($request->senha);
        $usuario->cep = $request->cep;
        $usuario->bairro = $request->bairro;
        $usuario->rua = $request->rua;
        $usuario->cidade = $request->cidade;
        $usuario->uf = $request->uf;
        $usuario->save();

        return response()->json([
            'message' => 'Usuário criado com sucesso!',
            'usuario' => $usuario
        ],201);
    }

  public function login(Request $request)
{
    $usuario = Usuario::where('email', $request->email)->first();

    if (!$usuario) {
        return response()->json([
            'success' => false,
            'message' => 'Usuário não encontrado!'
        ], 401);
    }

    if (!Hash::check($request->senha, $usuario->senha)) {
        return response()->json([
            'success' => false,
            'message' => 'Senha incorreta!'
        ], 401);
    }

    return response()->json([
        'success' => true,
        'message' => 'Login realizado com sucesso!',
        'usuario' => $usuario
    ]);
}



    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        try {

        $request->validate([
            'nome' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:usuarios,email,' . $usuario->id,
            'senha' => 'sometimes|string|min:6',
            'cep' => 'sometimes|string|max:20',
            'bairro' => 'sometimes|string|max:100',
            'rua' => 'sometimes|string|max:100',
            'cidade' => 'sometimes|string|max:100',
            'uf' => 'sometimes|string|max:2',
        ]);

            $dados = $request->all();

            if ($request->has('senha') && $request->senha) {
                $dados['senha'] = Hash::make($request->senha);
            }

            $usuario->update($dados);

            return response()->json([
                'message' => 'Usuário atualizado com sucesso!',
                'usuario' => $usuario
            ], 200);

        } catch (\Exception $e) {
            return response() ->json([
                'message' => 'Erro ao atualizar o usuário.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
