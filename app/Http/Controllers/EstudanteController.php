<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model\Estudante;

class EstudanteController extends Controller
{

    public function salvar_estudante(){
        $estudante = new Estudante;
        $estudante->nome = request()->nome;
        $estudante->email = request()->email;
        $estudante->telefone = request()->telefone;
        $estudante->save();
        return ('Salvo com Sucesso!');
    }

    public function visualizar_estudante(){
        $estudante = Estudante::paginate(5);
        return response()->json($estudante);
    }

    public function editar_estudante($id){
        $estudante = Estudante::find($id);
        return response()->json($estudante);
    }
   
   public function atualizar_estudante(){
        $estudante = Estudante::find(request()->id);
        $estudante->nome = request()->nome;
        $estudante->email = request()->email;
        $estudante->telefone = request()->telefone;
        $estudante->update();
        return ('Atualizado com Sucesso!');
    }

    public function deletar_estudante($id){
        $estudante = Estudante::find($id)->delete();
        return ('Registro excluído com Sucesso!');
    }
    
}
