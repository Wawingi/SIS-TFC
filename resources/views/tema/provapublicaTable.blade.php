<h4 class="header-title" style="text-align:center;font-weight:bold">DADOS DA PROVA PÚBLICA</h4><hr>
@foreach($provapublica as $pp)
<div class="row">
    <div class="col-5">
        <div class="form-group row mb-3">
            <p class="col-md-5 col-form-label" for="name2"> Data da Prova Pública</p>
        </div>
    </div> 
    <div class="col-7">
        <div class="form-group row mb-3">
            <a href="#" class="dataprovapublica_edit" data-name="datadefesa" data-type="combodate" data-value="{{$pp->created_at}}" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="{{$pp->id}}"  data-title="Select Date of birth"></a>      
        </div>
    </div>
</div>
<div id="labelespaco"  class="row">
    <div class="col-5">
        <div class="form-group row mb-3">
            <p class="col-md-5 col-form-label"> Nota da Defesa</p>
        </div>
    </div>
    <div class="col-7">
        <div class="form-group row mb-3">
            <a href="#" class="nota_edit" data-name="nota" data-type="number" data-placeholder="Preenchimento obrigatório" data-pk="{{$pp->id}}" data-title="Informe a nota">{{$pp->nota}}</a> <span style="margin-left:10px">Valor</span> 
        </div>
    </div>
</div> 
<div id="labelespaco"  class="row">
    <div class="col-5">
        <div class="form-group row mb-3">
            <p class="col-md-5 col-form-label">Local da Defesa</p>
        </div>
    </div>
    <div class="col-7">
        <div class="form-group row mb-3">
            <a href="#" class="local_edit" data-name="local" data-type="text" data-placeholder="Preenchimento obrigatório" data-pk="{{$pp->id}}" data-title="Informe o local">{{$pp->local}}</a>
        </div>
    </div>
</div> 
<div id="labelespaco"  class="row">
    <div class="col-5">
        <div class="form-group row mb-3">
            <p class="col-md-5 col-form-label">Presidente</p>
        </div>
    </div>
    <div class="col-7">
        <div class="form-group row mb-3">
            <a href="#" class="presidente_edit" data-name="presidente" data-type="text" data-placeholder="Preenchimento obrigatório" data-pk="{{$pp->id}}" data-title="Informe o nome do presidente">{{$pp->presidente}}</a>
        </div>
    </div>
</div> 
<div id="labelespaco"  class="row">
    <div class="col-5">
        <div class="form-group row mb-3">
            <p class="col-md-5 col-form-label">Secretário</p>
        </div>
    </div>
    <div class="col-7">
        <div class="form-group row mb-3">
            <a href="#" class="secretario_edit" data-name="secretario" data-type="text" data-placeholder="Preenchimento obrigatório" data-pk="{{$pp->id}}" data-title="Informe o nome do secretário">{{$pp->secretario}}</a>
        </div>
    </div>
</div> 
<div id="labelespaco"  class="row">
    <div class="col-5">
        <div class="form-group row mb-3">
            <p class="col-md-5 col-form-label">1º Vogal</p>
        </div>
    </div>
    <div class="col-7">
        <div class="form-group row mb-3">
            <a href="#" class="vogal1_edit" data-name="vogal_1" data-type="text" data-placeholder="Preenchimento obrigatório" data-pk="{{$pp->id}}" data-title="Informe o nome do 1º vogal">{{$pp->vogal_1}}</a>
        </div>
    </div>
</div> 
<div id="labelespaco"  class="row">
    <div class="col-5">
        <div class="form-group row mb-3">
            <p class="col-md-5 col-form-label">2º Vogal</p>
        </div>
    </div>
    <div class="col-7">
        <div class="form-group row mb-3">
            <a href="#" class="vogal2_edit" data-name="vogal_2" data-type="text" data-placeholder="Preenchimento obrigatório" data-pk="{{$pp->id}}" data-title="Informe o nome do 2º vogal">{{$pp->vogal_2}}</a>
        </div>
    </div>
</div> 
@endforeach
<script>
    $(document).ready(function (){
        $.fn.editableform.buttons='<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button><button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>',
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':'{{csrf_token()}}'
            }
        });

        $(".dataprovapublica_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório"
            },
            url:'{{url("editarPessoa")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        $(".nota_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório";
                if(e>20 || e<0)
                    return "A nota deve estar entre 0 à 20 valores";
            },
            url:'{{url("editarNota")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        $(".local_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório";
            },
            url:'{{url("editarLocal")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        $(".presidente_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório";
                if(!e.match(/^[a-zA-ZáÁàÀçÇéÉèÈõÕóÓãÃúÚ\s]+$/))
                    return "Nome inválido.";
            },
            url:'{{url("editarPresidente")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });
        $(".secretario_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório";
                if(!e.match(/^[a-zA-ZáÁàÀçÇéÉèÈõÕóÓãÃúÚ\s]+$/))
                    return "Nome inválido.";
            },
            url:'{{url("editarSecretario")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        $(".vogal1_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório";
                if(!e.match(/^[a-zA-ZáÁàÀçÇéÉèÈõÕóÓãÃúÚ\s]+$/))
                    return "Nome inválido.";
            },
            url:'{{url("editarVogal1")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        $(".vogal2_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório";
                if(!e.match(/^[a-zA-ZáÁàÀçÇéÉèÈõÕóÓãÃúÚ\s]+$/))
                    return "Nome inválido.";
            },
            url:'{{url("editarVogal2")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });
    });
</script>

                                              

                                                        