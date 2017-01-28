<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cupon</title>

    <!-- include material design CSS -->
    <link rel="stylesheet" href="../libs/css/materialize/css/materialize.min.css" />

    <!-- include material design icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <!-- custom CSS -->
    <style>
        .width-30-pct{
            width:30%;
        }

        .text-align-center{
            text-align:center;
        }

        .margin-bottom-1em{
            margin-bottom:1em;
        }
    </style>

</head>
<body>

<!-- page content and controls will be here -->
<div class="container" ng-app="myApp" ng-controller="cuponsCtrl">
    <div class="row">
        <div class="col s12">
            <h4>Cupon</h4>
            <!-- modal for for creating new cupon -->
            <div id="modal-cupon-form" class="modal">
                <div class="modal-content">
                    <h4 id="modal-cupon-title">Nuevo Cupon</h4>
                    <div class="row">
                        <div class="input-field col s12">
                            <input ng-model="descripcion" type="text" class="validate" id="form-name" placeholder="Descripcion del cupon." />
                            <label for="descripcion">Nombre</label>
                        </div>

                        <div class="input-field col s12">
                            <input ng-model="descuento" type="text" class="validate" placeholder="Descuento..."/>
                            <label for="descuento">Precio de Compra</label>
                        </div>

                        <div class="input-field col s12">
                            <a id="btn-create-cupon" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createProduct()"><i class="material-icons left">add</i>Nuevo</a>

                            <a id="btn-update-cupon" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateProduct()"><i class="material-icons left">edit</i>Guardar Cambios</a>

                            <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>


             <!-- used for searching the current list -->
<input type="text" ng-model="search" class="form-control" placeholder="Buscar cuponos..." />

<!-- table that shows cupon record list -->
<table class="hoverable bordered">

    <thead>
        <tr>
            <th class="text-align-center">ID</th>
            <th class="width-30-pct">Descripcion</th>
            <th class="text-align-center">Descuento</th>
            <!--<th class="text-align-center">Acciones</th>-->
        </tr>
    </thead>

    <tbody ng-init="getAll()">
        <tr ng-repeat="x in names | filter:search">
            <td class="text-align-center">{{ x.id }}</td>
            <td>{{ x.descripcion }}</td>
            <td>%{{ x.descuento }}</td>

          <!--  <td>
                <a ng-click="readOne(x.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                <a ng-click="deleteProduct(x.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
            </td>-->
        </tr>
    </tbody>
</table>


                        <!-- floating button for creating cupon -->
    <div class="fixed-action-btn" style="bottom:45px; right:24px;">
        <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-cupon-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
    </div>



        </div> <!-- end col s12 -->
    </div> <!-- end row -->
</div> <!-- end container -->
<!-- include jquery -->
<script type="text/javascript" src="../libs/js/jquery-3.1.1.min.js"></script>

<!-- material design js -->
<script type="text/javascript"  src="../libs/css/materialize/js/materialize.min.js"></script>

<!-- include angular js -->
<script type="text/javascript"  src="../libs/js/angular.min.js"></script>

<script type="text/javascript">
// angular js codes will be here
 var app = angular.module('myApp', []);
app.controller('cuponsCtrl', function($scope, $http) {
    // more angular JS codes will be here
    $scope.showCreateForm = function(){
    // clear form
    $scope.clearForm();

    // change modal title
    $('#modal-cupon-title').text("Nuevo Cupon");

    // hide update cupon button
    $('#btn-update-cupon').hide();

    // show create cupon button
    $('#btn-create-cupon').show();

    }

    // clear variable / form values
    $scope.clearForm = function(){
        $scope.id = "";
        $scope.descripcion = "";
        $scope.descuento = "";
    }


    // create new cupon
    $scope.createCupon = function(){
//descripcion, precioCompra, precioVenta, departamento_id, cantidad, unidadDeMedida
        // fields in key-value pairs
        $http.post('create_cupon.php', {
                'descripcion' : $scope.descripcion,
                'descuento' : $scope.precioCompra
            }).then(
            function (data, status, headers, config) {

                console.log(data);
            // tell the user new cupon was created
            Materialize.toast("Cupon fue creado", 4000);

            // close modal
            $('#modal-cupon-form').modal('close');

            // clear modal content
            $scope.clearForm();

            // refresh the list
            $scope.getAll();
        });
    }


    // read cupons
    $scope.getAll = function(){
        $http.get("read_cupon.php").then(
            function (response){
                $scope.names=response.data.records;
            }
        );
    }

    $scope.getDeptoAll = function(){
        $http.get("../controllerdepto/read_depto.php").then(
            function (response){

                $scope.deptos=response.data.records;
                //$('select').material_select();


            }
        );
    }


        // retrieve record to fill out the form
    $scope.readOne = function(id){

        // change modal title
        $('#modal-cupon-title').text("Edit Product");

        // show udpate cupon button
        $('#btn-update-cupon').show();

        // show create cupon button
        $('#btn-create-cupon').hide();

        // post id of cupon to be edited
        $http.post('read_one.php', {
            'id' : id
        })
        .then(function(data, status, headers, config){

            // put the values in form
            $scope.id = data.data[0]["id"];
            $scope.descripcion = data.data[0]["descripcion"];
            $scope.precioCompra = data.data[0]["precioCompra"];
            $scope.precioVenta = data.data[0]["precioVenta"];
            $scope.cantidad = data.data[0]["cantidad"];
            $scope.unidadDeMedida = data.data[0]["unidadDeMedida"];
            $scope.departamento_id = data.data[0]["departamento_id"];

            // show modal
            $('#modal-cupon-form').modal('open');
        })
        .error(function(data, status, headers, config){
            Materialize.toast('Unable to retrieve record.', 4000);
        });
    }

    // update cupon record / save changes
    $scope.updateProduct = function(){
        $http.post('update_cupon.php', {
                'descripcion' : $scope.descripcion,
                'precioCompra' : $scope.precioCompra,
                'precioVenta' : $scope.precioVenta,
                'departamento_id' : $scope.departamento_id,
                'cantidad' : $scope.cantidad,
                'unidadDeMedida' : $scope.unidadDeMedida
        })
        .then(function (data, status, headers, config){
            // tell the user cupon record was updated
            Materialize.toast(data.data, 4000);

            // close modal
            $('#modal-cupon-form').modal('close');

            // clear modal content
            $scope.clearForm();

            // refresh the cupon list
            $scope.getAll();
        });
    }


// delete cupon
$scope.deleteProduct = function(id){

    // ask the user if he is sure to delete the record
    if(confirm("Esta seguro de eliminar el cupono?")){
        // post the id of cupon to be deleted
        $http.post('delete_cupon.php', {
            'id' : id
        }).then(function (data, status, headers, config){

            // tell the user cupon was deleted
            Materialize.toast(data.data, 4000);

            // refresh the list
            $scope.getAll();
        });
    }
}


    });



// jquery codes will be here

    $(document).ready(function(){
    // initialize modal
        $('.modal').modal();
        //$('select').material_select();
    });
</script>

</body>
</html>
