<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">    
        <div class="modal-content">
            <div id="cabeca-modal" class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle">Adicionar Sugestão</h4>
                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioSalvar" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tema</label>
                        <input required type="text" class="form-control" name="tema" placeholder="ex: SIS-TFC">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" name="descricao" rows="3"></textarea>
                    </div>
                    <!--Buscar area de aplicação na BD e preencher a combobox -->
                    <?php 
                        $areas = App\Model\Area::where('id_departamento',$sessao[0]->id_departamento)->get();
                    ?>    
                    <div class="form-group">
                        <label for="position">Área de Aplicação</label>
                        <select name="area" class="custom-select">
                            <?php foreach($areas as $area): ?>
                                <option>{{$area->nome}}</option>
                            <?php endforeach ?>
                        </select>     
                    </div>
                    @if($sessao[0]->tipo==3)
                        <?php 
                            $docentes = App\Model\Pessoa::getDocentes($sessao[0]->id_departamento);
                        ?> 
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="position">Orientador Desejado</label>
                                    <select name="docente" class="custom-select">
                                        <?php foreach($docentes as $docente): ?>
                                            <option>{{$docente->nome}}</option>
                                        <?php endforeach ?>
                                    </select>     
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="position">Activar trabalho em grupo</label>
                                    <br><input type="checkbox" data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                </div>
                            </div>
                        </div>
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