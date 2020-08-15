<div id="modalTrocaDepartamento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">           
            <div class="modal-body">            
                <form id="formularioEditarDepartamentoFuncionario" method="post">
                    @csrf
                    <?php
                        if($dados->tipo==1){          
                            $departamentos = App\Model\Departamento::where('id_faculdade',$sessao[0]->id_faculdade)
                                            ->where('tipo',1)
                                            ->get();
                        }else if($dados->tipo==2 && $dados->privilegio==1){
                            $departamentos = App\Model\Departamento::pegaDepartamentoByTipo(2,$sessao[0]->id_faculdade);
                        }
                    ?>                    
                    <div class="row">              
                        <div class="col-lg-9">
                            <div class="form-group mb-3">
                                <select name="departamento" class="custom-select">
                                    @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}" <?php if(App\Model\Departamento::pegaChefeDepartamento($departamento->id)){ echo "disabled";} ?>>{{$departamento->nome}}</option>
                                    @endforeach
                                </select>                                        
                            </div>
                        </div>
                        <input  type="hidden" class="form-control" value="{{$dados->pessoa_id}}" required name="id_pessoa">
                        <div class="col-lg-3">
                            <button id="modalEditarDptoClose" type="button" class="float-right btn btn-danger waves-effect btn-md" data-dismiss="modal"><i class="fas fa-times"></i></button> 
                            <button type="submit" class="float-right mr-1 btn btn-primary waves-effect btn-md waves-light"><i class="fas fa-check"></i></button>      
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
