<div class="modal fade modalAvaliarElemento bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div style="background-color:#37cde6" class="modal-header">
                <h4 style="color:#ffff" class="modal-title" id="myLargeModalLabel"><i class='fa fa-check mr-2'></i>Avaliar Elemento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="formAvaliar" method="POST">
                    @csrf
                    <input type="hidden" id="id_item"  name="id_item">
                    <div class="form-group row mb-0">                                                                       
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="genero">Avaliação</label><br>
                                <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                    <input type="radio" id="valor" onclick="mudarAValiacao(1,1)" value="1" name="avaliacao" checked>
                                    <label for="inlineRadio1"> Aprovado </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input type="radio" id="valor" onclick="mudarAValiacao(0,1)" value="0" name="avaliacao">
                                    <label for="inlineRadio2"> Rejeitado </label>
                                </div>
                            </div>
                        </div>
                        <div style="display:none" id="mostraComentario1" class="col-sm-12 mostraComentario">                                                  
                            <label for="genero">Pontos a rever</label>  
                            <?php $predefinidas = App\Model\PredefinidoAvaliacao::where('id_departamento', $sessao[0]->id_departamento)->get();?>  
                            @foreach($predefinidas as $predefinida)
                                <div style="margin-left:-20px" class="custom-control custom-checkbox">
                                    <input type="checkbox" value="{{$predefinida->id}}" name="predefinidas[]">
                                    <label>{{$predefinida->avaliacao}}</label>
                                </div>                        
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-rounded"><i class="far fa-save"> Avaliar </i></button>
                    <button id="modalAvaliarClose" type="button" data-dismiss="modal" class="btn btn-warning btn-rounded"><i class="far fa-window-close"> Cancelar </i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    //Mostar a inout comentario caso avaliacao seja negativa
    function mudarAValiacao(avaliacao,tipo_elemento){
        if(tipo_elemento==1){
            if(avaliacao==0)
                document.getElementById("mostraComentario1").style.display = 'block';
            else 
                document.getElementById("mostraComentario1").style.display = 'none';
        }
        if(tipo_elemento==2){
            if(avaliacao==0)
                document.getElementById("mostraComentario2").style.display = 'block';
            else 
                document.getElementById("mostraComentario2").style.display = 'none';
        }
        if(tipo_elemento==3){
            if(avaliacao==0)
                document.getElementById("mostraComentario3").style.display = 'block';
            else 
                document.getElementById("mostraComentario3").style.display = 'none';
        }
    }

    //Avaliar elemento
    $('.formAvaliar').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);

        $.ajax({
            url:"{{ url('registarAvaliacao') }}",
            type: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == 1){
                    $('.formAvaliar')[0].reset();
                    $("#modalAvaliarClose").click();
                    location.reload();     
                    Swal.fire({
                        text: "Elemento avaliado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer: 1500
                    });
                                  
                }
            },
            error: function(e){
                $('.formAvaliar')[0].reset();
                Swal.fire({
                    text: 'Ocorreu um erro ao avaliar o elemento.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });
</script>