<div id="modalTrocaCurso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">           
            <div class="modal-body">            
                <form id="formularioEditarCurso" method="post">
                    @csrf
                    <?php 
                        $cursos = App\Model\Curso::where('id_departamento',$sessao[0]->id_departamento)->get();
                    ?>                     
                    <div class="row">              
                        <div class="col-lg-9">
                            <div class="form-group mb-3">
                                <select name="curso" class="custom-select">
                                <?php foreach($cursos as $curso): ?>
                                    <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                <?php endforeach ?>
                                </select>                                          
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <button id="modalEditarClose" type="button" class="float-right btn btn-danger waves-effect btn-md" data-dismiss="modal"><i class="fas fa-times"></i></button> 
                            <button type="submit" class="float-right mr-1 btn btn-primary waves-effect btn-md waves-light"><i class="fas fa-check"></i></button>      
                        </div>
                    </div>
                    <input  type="hidden" class="form-control" value="{{$dados->pessoa_id}}" required name="id_pessoa">
                </form>
            </div>
        </div>
    </div>
</div>
