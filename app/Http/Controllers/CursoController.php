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

    public function pegaCursos($id){
        $cursos = Curso::pegaCursoDepartamento($id);

        return view('departamento.cursoTable',compact('cursos'));
    }

    public function eliminarCurso($id){
        if(DB::table('curso')->where('id', '=', $id)->delete()){
            echo 'Sucesso';
        }
    }

    //Função que pega um determinado curso
    public function pegaCurso($id){
        $data = Curso::find($id);
        echo json_encode($data);
    }

    public function editarCurso(Request $request){
        /*$validatedData = $request->validate([
            'nome' => ['required', 'string', 'max:200', 'unique:departamento'],
            'chefe_departamento' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:departamento'],
            'telefone' => ['required','min:9', 'max:9', 'unique:departamento'],
        ],[
            //Mensagens de validação de erros
            'nome.required'=>'Por favor, informe o nome do departamento',
            'chefe_departamento.required'=>'Por favor, informe o nome do chefe do departamento',
            'email.required'=>'Por favor, informe o email',
            'telefone.required'=>'Por favor, informe o contacto telefónico',
            'telefone.min'=>'A quantidade de digítos telefonicos é inferior',
            'telefone.max'=>'A quantidade de digítos telefonicos é superior',
        ]);*/
        
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
