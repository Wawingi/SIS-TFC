<div id="modalTrocaFuncao" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">           
            <div class="modal-body">            
                <form id="formularioEditarFuncao" method="post">
                    @csrf                    
                    <div class="row">              
                        <div class="col-lg-9">
                            <div class="form-group mb-3">
                                <select id="tipo_funcao" name="tipo_funcao" class="custom-select">
                                    <option value="1">Chefe de Deparamento</option>
                                    <option value="2">Outro</option>
                                </select>                                          
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <button id="modalEditarFuncaoClose" type="button" class="float-right btn btn-danger waves-effect btn-md" data-dismiss="modal"><i class="fas fa-times"></i></button> 
                            <button type="submit" class="float-right mr-1 btn btn-primary waves-effect btn-md waves-light"><i class="fas fa-check"></i></button>      
                        </div>
                    </div>
                    <div style="display:none" id="mostra_outro" class="row">              
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <input type="text" value="{{$dados->funcao}}" class="form-control" id="funcao" name="funcao" placeholder="Informe a função">                                       
                            </div>
                        </div>
                    </div>
                    <input  type="hidden" class="form-control" value="{{$dados->pessoa_id}}" required name="id_pessoa">
                </form>
            </div>
        </div>
    </div>
</div>

