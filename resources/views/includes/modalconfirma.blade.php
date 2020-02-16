<div id="modalConfirma" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">           
            <div class="modal-body">
                
                <form method="post" action="{{ url('/desactivarConta')}}" >
                    @csrf
                    <?php if($dados[0]->estado=='activo'){ ?>     
                        <h4><p style="text-align:center">Deseja realmente desactivar este utilizador?</p></h4>
                        <input  type="hidden" class="form-control" value="desactivar" required name="opcao">
                    <?php } else{ ?>
                        <h4><p style="text-align:center">Deseja activar a conta do utilizador?</p></h4>
                        <input  type="hidden" class="form-control" value="activar" required name="opcao">
                    <?php } ?>

                    <input  type="hidden" class="form-control" value="{{$dados[0]->id}}" required name="idUtilizador">
                                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Sim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
