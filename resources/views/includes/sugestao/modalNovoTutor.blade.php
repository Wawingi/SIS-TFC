<div class="modal fade editar bs-example-modal-lg" id="novotutor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div style="background-color:#37cde6" class="modal-header">
                <h4 style="color:#ffff" class="modal-title" id="myLargeModalLabel"><i class='fa fa-pencil-alt mr-2'></i>Adicionar Outro Orientador</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="formularioNovoTutor" action="{{ url('trocarTutor') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <?php                   
                                $docentes = App\Model\Pessoa::getDocentes($sessao[0]->id_departamento);
                            ?> 
                            <div class="form-group">
                                <label for="name">Orientadores</label>
                                <select id="orientador" name="orientador" class="selectpicker" data-live-search="true" data-style="btn-light">
                                    <?php foreach($docentes as $docente): ?>
                                        <option value="{{$docente->pessoa_id}}">{{$docente->nome}}</option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{$sugestao[0]->id}}" name="sugestao_id" id="sugestao_id"/>        
                </div>
                <div class="modal-footer">
                    <button id="modalNovoTutorClose" type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><i class="mdi mdi-close"></i> Fechar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
                </div>
            </form> 
        </div>
    </div>
</div>