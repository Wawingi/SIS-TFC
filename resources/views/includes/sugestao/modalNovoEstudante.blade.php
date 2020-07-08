<div class="modal fade" id="novoestudanteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">    
        <div class="modal-content">
            <div id="cabeca-modal" class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle">Adicionar Novo Estudante</h4>
                <button id="modalCloseNovo" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioSalvarNovoEstudante" method="post">
                    @csrf                                                   
                    <?php                   
                        $envolventes = App\Model\Pessoa::pegaEstudantesFaculdade($sessao[0]->faculdade,$sessao[0]->id_pessoa);
                    ?> 
                    <div id="envolventesp" class="form-group">
                        <label for="name">Envolventes</label>
                        <select class="js-example-basic-multiple custom-select" name="envolventes[]" multiple="multiple">
                            <?php foreach($envolventes as $envolvente): ?>
                                <option>{{$envolvente->nome}}</option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <input type="hidden" value="{{$sugestao[0]->id}}" name="sugestao_id" id="sugestao_id"/>                                         
                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>