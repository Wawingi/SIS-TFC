<?php

namespace App\Http\Controllers;

use App\Model\Curso;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function registarCurso(Request $request){
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'max:200', 'unique:curso'],
            'id_departamento' => ['required'],
        ],[
            //Mensagens de validação de erros
            'nome.required'=>'Por favor, informe o nome do curso',
            'nome.unique'=>'Este departamento já foi registado.',
        ]);
            
        $curso = new Curso;
        $curso->nome = $request->input('nome'); 
        $curso->id_departamento = $request->input('id_departamento');
        if($curso->save()){
            $info = 'Sucesso';
        }else{
            $info = 'Erro';
        }
        echo $info;        
    }

    public function pegaCursos($id,$isDeleted){
        $cursos = Curso::pegaCursoDepartamento($id,$isDeleted);

        return view('departamento.cursoTable',compact('cursos','isDeleted'));
    }

    public function eliminarCurso($id){
        $info = null;
        if(Curso::destroy($id)){
            $info = 'Sucesso';
        }
        echo $info;
    }

     //Função que restaura o curso eliminado com softdelete
     public function restaurarCurso($id){
        $info = null;
        if(Curso::withTrashed()
                ->where('id', $id)
                ->restore())
        {
            $info = 'Sucesso';
        }
        echo $info;
    }

    //Função que pega um determinado curso
    public function pegaCurso($id){
        $data = Curso::find($id);
        echo json_encode($data);
    }

    public function editarCurso(Request $request){
        $validatedData = $request->validate([
            'nome_edit' => ['required', 'string', 'max:200'],
        ],[
            //Mensagens de validação de erros
            'nome_edit.required'=>'Por favor, informe o curso.',
        ]);
        
        if(DB::table('curso')          
                ->where('id','=',$request->id_curso)
                ->update(['nome' => $request->input('nome_edit')])){
            $info = 'Sucesso';
        } else {
            $info = 'Erro';
        }
               
        echo $info;        
    }
}
