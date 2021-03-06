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
                            if ($dados->tipo == 1){ 
                                $roles = App\Model\Role::where('tipo', '=', 1)->select('id','nome')->get();
                                foreach($roles as $role):
                        ?>
                                <div class="custom-control custom-checkbox">
                                    <input <?php if(App\Permission::isDefinedRole($dados->id,$role->id)==1){ echo 'disabled';} ?> style="width:18px;height:18px" type="checkbox" value="{{$role->id}}" name="roles_id[]"/> 
                                    <label style="padding-left:10px">{{$role->nome}}</label>
                                </div>
                        <?php
                                endforeach; 
                            } else if ($dados->tipo == 2){
                                $roles = App\Model\Role::where('tipo', '=', 2)->select('id','nome')->get();
                                foreach($roles as $role):
                        ?>
                                <div class="custom-control custom-checkbox">
                                    <input <?php if(App\Permission::isDefinedRole($dados->id,$role->id)==1){ echo 'disabled';} ?> style="width:18px;height:18px" type="checkbox" value="{{$role->id}}" name="roles_id[]"/> 
                                    <label style="padding-left:10px">{{$role->nome}}</label>
                                </div>
                        <?php
                                endforeach; 
                            } else if ($dados->tipo == 3){
                                $roles = App\Model\Role::where('tipo', '=', 3)->select('id','nome')->get();
                                foreach($roles as $role): 
                        ?>
                                <div class="custom-control custom-checkbox">
                                    <input <?php if(App\Permission::isDefinedRole($dados->id,$role->id)==1){ echo 'disabled';} ?> style="width:18px;height:18px" type="checkbox" value="{{$role->id}}" name="roles_id[]"/> 
                                    <label style="padding-left:10px">{{$role->nome}}</label>                        
                                </div>
                        <?php
                                endforeach;
                            }
                        ?>
                    </div>
                </div> 
            </div>
            <input type="hidden" class="form-control" value="{{$dados->id}}" name="idUtilizador">
            <hr>
            <div class="text-right">
                <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Atribuir</button>
            </div>
        </form>
    </div>
</div>