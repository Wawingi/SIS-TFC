<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div id="cabeca-modal" class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle"><i class="mdi mdi-plus-circle mr-1"></i>Adicionar Sugestão</h4>
                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioSalvar" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tema</label>
                        <input required type="text" class="form-control" name="tema" placeholder="ex: SIS-TFC">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Anexar Ficheiro em Pdf</label>
                        <input type="file" class="form-control" accept="application/pdf" name="descricao">
                        <span style="color:red;font-style:italic">tamanho máximo 2Mb</span>
                    </div>
                    <!--Buscar area de aplicação na BD e preencher a combobox -->
                    <?php $areas = App\Model\Area::where('id_departamento', $sessao[0]->id_departamento)->get();?>
                    <div class="form-group">
                        <label for="position">Área de Aplicação</label>
                        <select name="area" class="selectpicker" data-live-search="true" data-style="btn-light">
                            <?php foreach ($areas as $area): ?>
                                <option>{{$area->nome}}</option>
                            <?php endforeach?>
                        </select>
                    </div>
                    @if($sessao[0]->tipo==3)
                        <?php $docentes = App\Model\Pessoa::getDocentes($sessao[0]->id_departamento);?>
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="position">Orientador Desejado</label>
                                    <select name="docente" class="selectpicker" data-live-search="true" data-style="btn-light">
                                        <?php foreach ($docentes as $docente): ?>
                                            <option>{{$docente->nome}}</option>
                                        <?php endforeach?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="position">Escolha a modalidade</label>
                                    <select name="modalidade" id="modalidade" class="custom-select">
                                        <option>Individual</option>
                                        <option>Colectivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="envolventes" style="display:none">
                            <?php $envolventes = App\Model\Pessoa::pegaEstudantesFaculdade($sessao[0]->faculdade, $sessao[0]->id_pessoa);?>
                            <div class="form-group">
                                <label for="name">Envolventes</label>
                                <select class="js-example-basic-multiple custom-select" name="envolventes[]" multiple="multiple">
                                    <?php foreach ($envolventes as $envolvente): ?>
                                        <option value="{{$envolvente->id}}">{{$envolvente->nome}} - {{$envolvente->departamento}}</option>
                                    <?php endforeach?>
                                </select>
                            </div>
                        </div>
                    @endif
                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>