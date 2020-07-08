<div class="modal fade" id="modalSave" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div id="cabeca-modal" class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle"><i class="fas fa-share-square mr-2"></i>Associar Permissão</h4>
                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioSalvarPermission" method="post">
                    @csrf
                    <?php                 
                        $permissions = App\Permission::getPermissions($perfil->tipo);
                    ?>
                    @foreach($permissions as $permission) 
                    <div class="mt-3">
                        <div class="custom-control custom-checkbox">
                            <input <?php if(App\Permission::isDefinedPermissionRole($permission->id,$perfil->id)==1){ echo 'disabled';} ?> value="{{$permission->id}}" class="mr-3" type="checkbox" id="checkbox2" name="permission_id[]">
                            <label for="checkbox2">{{$permission->desc}}</label>
                        </div>
                    </div> 
                    @endforeach 
                    <input type="hidden" value="{{$perfil->id}}" id="idRole" class="form-control" name="idRole">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
                    </div>
                </form>
            </div>
                    
        </div>
    </div>
</div>