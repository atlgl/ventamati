<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Compra</title>

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
<div class="container" ng-app="myApp" ng-controller="comprasCtrl">
    <div class="row">
        <div class="col s12">
            <h4>Compra</h4>
            <!-- modal for for creating new compra -->
            <div id="modal-compra-form" class="modal">
                <div class="modal-content">
                    <h4 id="modal-compra-title">Nuevo Producto</h4>
                    <div class="row">
                        <div class="input-field col s12">
                            <input ng-model="descripcion" type="text" class="validate" id="form-name" placeholder="Nombre del comprao..." />
                            <label for="descripcion">Nombre</label>
                        </div>

                        <div class="input-field col s12">
                            <input ng-model="precioCompra" type="text" class="validate" placeholder="precio Compra..."/>
                            <label for="precioCompra">Precio de Compra</label>
                        </div>


                        <div class="input-field col s12">
                            <input ng-model="precioVenta" type="text" class="validate" id="form-price" placeholder="Precio de Venta..." />
                            <label for="precioVenta">Precio de Venta</label>
                        </div>



                        <div class="input-field col s12">
                            <input ng-model="cantidad" type="text" class="validate" id="form-price" placeholder="Cantidad..." />
                            <label for="cantidad">Cantidad</label>
                        </div>

                        <div class="input-field col s12">
                            <input ng-model="unidadDeMedida" type="text" class="validate" id="form-price" placeholder="Unidad de Medida..." />
                            <label for="unidadDeMedida">Unidad de Medida</label>
                        </div>


                    <div class="input-field col s12">
                        <select class="browser-default" ng-model="departamento_id" ng-init="getDeptoAll()" >
                            <option value="" disabled selected>Seleccionar un departamento</option>
                          <option ng-repeat="d in deptos" ng-value="d.id">{{ d.nombre +'--'+d.tiendanombre}}</option>
                        </select>

                      </div>





                        <div class="input-field col s12">
                            <a id="btn-create-compra" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createProduct()"><i class="material-icons left">add</i>Nuevo</a>

                            <a id="btn-update-compra" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateProduct()"><i class="material-icons left">edit</i>Guardar Cambios</a>

                            <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>


             <!-- used for searching the current list -->
<input type="text" ng-model="search" class="form-control" placeholder="Buscar compraos..." />

<!-- table that shows compra record list -->
<table class="hoverable bordered">

    <thead>
        <tr>
            <th class="text-align-center">ID</th>
            <th class="width-30-pct">Descripcion</th>
            <th class="text-align-center">Precio Venta</th>
            <th class="text-align-center">Precio Venta</th>
            <th class="text-align-center">Departamento</th>
            <th class="text-align-center">Cantidad</th>
            <th class="text-align-center">Unidad de Medida</th>
            <th class="text-align-center">Acciones</th>
        </tr>
    </thead>

    <tbody ng-init="getAll()">
        <tr ng-repeat="x in names | filter:search">
            <td class="text-align-center">{{ x.id }}</td>
            <td>{{ x.descripcion }}</td>
            <td>{{ x.precioVenta }}</td>
            <td>{{ x.precioCompra }}</td>
            <td>{{ x.departamento_id }}</td>
            <td>{{ x.cantidad }}</td>
            <td>{{ x.unidadDeMedida }}</td>
            <td>
                <a ng-click="readOne(x.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                <a ng-click="deleteProduct(x.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
            </td>
        </tr>
    </tbody>
</table>


                        <!-- floating button for creating compra -->
    <div class="fixed-action-btn" style="bottom:45px; right:24px;">
        <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-compra-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
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
app.controller('comprasCtrl', function($scope, $http) {
    // more angular JS codes will be here
    $scope.showCreateForm = function(){
    // clear form
    $scope.clearForm();

    // change modal title
    $('#modal-compra-title').text("Nuevo Producto");

    // hide update compra button
    $('#btn-update-compra').hide();

    // show create compra button
    $('#btn-create-compra').show();

    }

    // clear variable / form values
    $scope.clearForm = function(){
        $scope.id = "";
        $scope.descripcion = "";
        $scope.precioCompra = "";
        $scope.precioVenta = "";
        $scope.departamento_id = "";
        $scope.cantidad = "";
        $scope.unidadDeMedida = "";
    }


    // create new compra
    $scope.createProduct = function(){
//descripcion, precioCompra, precioVenta, departamento_id, cantidad, unidadDeMedida
        // fields in key-value pairs
        $http.post('create_compra.php', {
                'descripcion' : $scope.descripcion,
                'precioCompra' : $scope.precioCompra,
                'precioVenta' : $scope.precioVenta,
                'departamento_id' : $scope.departamento_id,
                'cantidad' : $scope.cantidad,
                'unidadDeMedida' : $scope.unidadDeMedida
            }).then(
            function (data, status, headers, config) {

                console.log(data);
            // tell the user new compra was created
            Materialize.toast("Producto fue creado", 4000);

            // close modal
            $('#modal-compra-form').modal('close');

            // clear modal content
            $scope.clearForm();

            // refresh the list
            $scope.getAll();
        });
    }


    // read compras
    $scope.getAll = function(){
        $http.get("read_compras.php").then(
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
        $('#modal-compra-title').text("Edit Product");

        // show udpate compra button
        $('#btn-update-compra').show();

        // show create compra button
        $('#btn-create-compra').hide();

        // post id of compra to be edited
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
            $('#modal-compra-form').modal('open');
        })
        .error(function(data, status, headers, config){
            Materialize.toast('Unable to retrieve record.', 4000);
        });
    }

    // update compra record / save changes
    $scope.updateProduct = function(){
        $http.post('update_compra.php', {
                'descripcion' : $scope.descripcion,
                'precioCompra' : $scope.precioCompra,
                'precioVenta' : $scope.precioVenta,
                'departamento_id' : $scope.departamento_id,
                'cantidad' : $scope.cantidad,
                'unidadDeMedida' : $scope.unidadDeMedida
        })
        .then(function (data, status, headers, config){
            // tell the user compra record was updated
            Materialize.toast(data.data, 4000);

            // close modal
            $('#modal-compra-form').modal('close');

            // clear modal content
            $scope.clearForm();

            // refresh the compra list
            $scope.getAll();
        });
    }


// delete compra
$scope.deleteProduct = function(id){

    // ask the user if he is sure to delete the record
    if(confirm("Esta seguro de eliminar el comprao?")){
        // post the id of compra to be deleted
        $http.post('delete_compra.php', {
            'id' : id
        }).then(function (data, status, headers, config){

            // tell the user compra was deleted
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
