<!-- Adicionar perfil a um utilizador -->
<div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title"><i class="fas fa-id-card mr-2"></i>Atribuir Perfil a Utilizador</h4>
    <div class="custom-modal-text text-left">
        <form method="post" action="{{ url('atribuirPerfil') }}">
            @csrf
 
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="genero">Escolha o perfil para o utilizador: </label><br><br>
                        <?php 
                            if ($dados[0]->tipo == 'funcionario'){ 
                                $roles = App\Model\Role::where('tipo', '=', 1)->select('id','nome')->get();
                                foreach($roles as $role):
                        ?>
                                <div class="custom-control custom-checkbox">
                                    <input style="width:18px;height:18px" type="checkbox" value="{{$role->id}}" name="roles_id[]"/> 
                                    <label style="padding-left:10px">{{$role->nome}}</label>
                                </div>
                        <?php
                                endforeach; 
                            } else if ($dados[0]->tipo == 'docente'){
                                $roles = App\Model\Role::where('tipo', '=', 2)->select('id','nome')->get();
                                foreach($roles as $role):
                        ?>
                                <div class="custom-control custom-checkbox">
                                    <input style="width:18px;height:18px" type="checkbox" value="{{$role->nome}}" name="roles[]"/> 
                                    <label style="padding-left:10px">{{$role->nome}}</label>
                                    <input type="hidden" value="{{$role->id}}" name="roles_id[]"/>
                                </div>
                        <?php
                                endforeach; 
                            } else if ($dados[0]->tipo == 'estudante'){
                                $roles = App\Model\Role::where('tipo', '=', 3)->select('id','nome')->get();
                                foreach($roles as $role): 
                        ?>
                                <div class="custom-control custom-checkbox">
                                    <input style="width:18px;height:18px" type="checkbox" value="{{$role->nome}}" name="roles[]"/> 
                                    <label style="padding-left:10px">{{$role->nome}}</label>
                                    <input type="hidden" value="{{$role->id}}" name="roles_id[]"/>
                                </div>
                        <?php
                                endforeach;
                            }
                        ?>
                    </div>
                </div> 
            </div>
            <input type="hidden" class="form-control" value="{{$dados[0]->id}}" name="idUtilizador">
            <hr>
            <div class="text-right">
                <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Atribuir</button>
            </div>
        </form>
    </div>
</div>