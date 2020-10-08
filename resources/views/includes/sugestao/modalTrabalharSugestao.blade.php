<div class="modal fade" id="modalTrabalharSugestao" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
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
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" value="{{$sugestao[0]->id}}" name="sugestaoTrabalhar_id" id="sugestaoTrabalhar_id"/>
                                <label for="position">Escolha a modalidade</label>
                                <select name="modalidade" id="modalidade" class="custom-select">
                                    <option>Individual</option>
                                    <option>Colectivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="envolventes">
                        <?php $envolventes = App\Model\Pessoa::pegaEstudantesFaculdade($sessao[0]->faculdade, $sessao[0]->id_pessoa);?>
                        <div id="envolventesp" class="form-group">
                            <label for="name">Envolventes</label>
                            <select class="js-example-basic-multiple custom-select" name="envolventes[]" multiple="multiple">
                                <?php foreach ($envolventes as $envolvente): ?>
                                    <option value="{{$envolvente->id}}">{{$envolvente->nome}} - {{$envolvente->departamento}}</option>
                                <?php endforeach?>
                            </select>
                        </div>
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