<div class="modal fade" id="modalTrabalharSugestao" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">    
        <div class="modal-content">
            <div id="cabeca-modal" class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle">Trabalhar na Sugestão</h4>
                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioTrabalharSugestao" method="post" action='{{ url("trabalharSugestao") }}'>
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="hidden" value="{{$sugestao[0]->id}}" name="sugestaoTrabalhar_id" id="sugestaoTrabalhar_id"/>
                                <label>Active a opção ao lado caso queira trabalhar em grupo</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group float-right">
                                <input class="switchery" type="checkbox" data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                            </div>
                        </div>
                        <input type="checkbox">
                    </div>
                    <?php                   
                        $envolventes = App\Model\Pessoa::pegaEstudantesCurso($sessao[0]->id_departamento,$sessao[0]->id_pessoa);
                    ?> 
                    <div id="envolventesp" class="form-group">
                        <label for="name">Envolventes</label>
                        <select class="js-example-basic-multiple custom-select" name="envolventes[]" multiple="multiple">
                            <?php foreach($envolventes as $envolvente): ?>
                                <option>{{$envolvente->nome}}</option>
                            <?php endforeach ?>
                        </select>
                    </div>
                                
                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>