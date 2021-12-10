@foreach($notaInformativa as $nota)
    <tr>
        <td colspan="4"><span style="text-align:center;font-weight:bold"><i class="fas fa-info-circle mr-1"></i>NOTA INFORMATIVA SOBRE A DEFESA</span><a href="#" id="{{$nota->id}}" class="eliminarNotaInformativa float-right btn btn-danger btn-sm btn-rounded"><i class='fa fa-trash-alt mr-2'></i>Eliminar</a></td>
    </tr>
    <tr>
        <td colspan="4"><hr style="margin-top:-20px"></td>
    </tr>
    <tr>                
        <td style="background:#edeff1">Data prevista da defesa</td>                
        <td><a href="#" class="dataprovapublica_edit" data-name="created_at" data-type="combodate" data-value="{{$nota->created_at}}" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="DD/MM/YYYY" data-pk="{{$nota->id}}"></a></td>                
        <td style="background:#edeff1">Local da defesa</td>                
        <td><a href="#" class="local_edit" data-name="local" data-type="text" data-placeholder="Preenchimento obrigatório" data-pk="{{$nota->id}}" data-title="Informe o local">{{$nota->local}}</a></td>                
    </tr>                
                
    <tr>                
        <td style="background:#edeff1">Presidente</td>                
        <td><B>{{$nota->presidente}}</B></td>                
        <td style="background:#edeff1">Secretário</td>                
        <td><B>{{$nota->secretario}}</B></td>                
    </tr>                
             
    <tr>                
        <td style="background:#edeff1">1º Vogal</td>                
        <td><B>{{$nota->vogal_1}}</B></td>                
        <td style="background:#edeff1">2º Vogal</td>                
        <td><B>{{$nota->vogal_2}}</B></td>                
    </tr>                   
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
            url:'{{url("editarLocal")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer:1500
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
                        confirmButtonText: 'Fechar',
                        timer:1500
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
            url:'{{url("editarJurado")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer:1500
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
            url:'{{url("editarJurado")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer:1500
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
            url:'{{url("editarJurado")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer:1500
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
            url:'{{url("editarJurado")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer:1500
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