<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Horario</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="localStyles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/Shadows.js"></script>
    <?php include 'PHP/Shadows.php'?>


</head>

<body class="body1">
    <div class="container">
        <?php echo BarNav ?>
<!--
            <div class="alert alert-danger" id="infosE">
               <button type='button' class='close closeA' data-dismiss='alert'>x</button>
                <p><strong>Info Extra!</strong> Esta a punto  </p>
            </div>
-->
            <h2 class="h2EH" >Formulario Para eliminar horario</h2>

<!--
            <div>
                <p>Esta pagina debe traer el mismo form utilizado para crear una materia pero desde ser desde la db para un UPDATE</p>
            </div>
-->

            <div class="container">
                <!--            <div class="Eliminar-Materia-Imagen">-->
                <img src="img/delete.png" class="Img-Del-Asig">
                <!--            </div>-->

                <div action="" class="EditAsignaturaForm">
                    <input list="HorariosList" type="text" id="InputEliminarHorario" class="form-control" placeholder="Introduzca o selecione el Nombre" required autofocus >
                </div>
                <datalist id="HorariosList">
                    
                </datalist>

                <div class="col-xs-12 ckSLboton">

                    <button type="button" class="btn btn-danger ckEditPensum2" data-toggle="modal" data-target="#myModal" id="Eliminar">
                        <span class="glyphicon glyphicon-edit"></span> Eliminar 
                    </button>

                </div>

            </div>

    </div>

    <!-- Trigger the modal with a button -->
    <!--    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" color="red">Esta a Punto de eliminar el horario siguiente</h4>
                </div>
                <div class="modal-body jcnevula" id="modal-body">

                </div>
                <div class="modal-footer">
                    <p class="ModalText" id="ES">Está seguro?</p>
                    <button type="button" id="Aceptar" class="btn btn-default aceptar01" data-dismiss="modal">Si estoy seguro</button>

                    <button type="button" id="Cancelar" class="btn btn-default cancelar01" data-dismiss="modal">No lo estoy</button>
                    
                    <button type="button" id="salir" class="btn btn-default cancelar01 hide" data-dismiss="">Salir</button>

                </div>

            </div>

        </div>
    </div>

    <script>
       $.post('PHP/exe.php',{
           action: 'dataList',
           select: 'select Nombre, Alias from proyecto_ponchador.horarios_creados_linear'
       }, (d,s)=>{
           $('#HorariosList').html(d);
//           document.write(d);
       });
        
        $('#Eliminar').click((e) => {
//           $('#salir').show();
            if ($('#InputEliminarHorario').val() == "") {

                alert("Debe introducir el nombre del horario");
                event.stopPropagation();

            }else{
                var tabla = [];
                //                $('#Eliminar').click((e) => {
//                window.location.href = 'PHP/exe.php';
                $.post('PHP/exe.php', {
                        action: 'EliminarHorarioConsulta',
                        InputEliminarHorario: $('#InputEliminarHorario').val()
                    }, (data, status) => {
                        if(data==="fail"){
                            $('#ES').hide();
                            $('#Aceptar').hide();
                            $('#Cancelar').hide();
//                            $('#salir').show();
                         $('#modal-body').html("<strong class='jcnevula'>Datos introducidos no son validos para eliminar el horario</strong>")   
                            
                            
//                            document.write(data);
                        }else{
                            $('#ES').show();
                            $('#Aceptar').show();
                            $('#Cancelar').show();
//                            $('#salir').show();
                            
                        table = data;
                        $('#modal-body').html(data)
                        }
              
                    })
                    //                });
            }
        });

        var tabla = [];
        $('#Aceptar').click((e) => {
//            console.log($('#InputEliminarHorario').val());
            $.post('PHP/exe.php', {
                action: 'EliminarHorario',
                InputEliminarHorario: $('#InputEliminarHorario').val()
                
            },(data, status) => {
                document.write(data);
                if(data==="ss"){
                    $('#infosE').hide();
                  location ='index.php?action=EH';

                    

                } else {
                    $('#infosE2').hide();
  
                }

            })
//            location ='PHP/exe.php';
        });
    </script>

</body>

</html>