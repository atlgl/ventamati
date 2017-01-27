<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tienda</title>

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
<div class="container" ng-app="myApp" ng-controller="productsCtrl">
    <div class="row">
        <div class="col s12">
            <h4>Tienda</h4>
            <!-- modal for for creating new product -->
            <div id="modal-product-form" class="modal">
                <div class="modal-content">
                    <h4 id="modal-product-title">Nueva Tienda</h4>
                    <div class="row">
                        <div class="input-field col s12">
                            <input ng-model="nombre" type="text" class="validate" id="form-nombre" placeholder="Nombre de la tienda" required title="Escriba un nombre de tienda" />
                            <label for="nombre">Nombre</label>
                        </div>

                        <div class="input-field col s12">
                            <input ng-model="domicilio" type="text" class="validate" placeholder="Domicilio..." id="form-domicilio"/>
                            <label for="domicilio">Domicilio</label>
                        </div>




                    <div class="input-field col s12">
                        <select class="browser-default" ng-model="estado">
                            <option value="" disabled selected>Seleccionar</option>
                          <option  ng-value="1">Activo</option>
                          <option  ng-value="2">Desactivado</option>
                        </select>

                      </div>





                        <div class="input-field col s12">
                            <a id="btn-create-product" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createProduct()"><i class="material-icons left">add</i>Nuevo</a>

                            <a id="btn-update-product" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateProduct()"><i class="material-icons left">edit</i>Guardar Cambios</a>

                            <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">close</i>Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>


             <!-- used for searching the current list -->
<input type="text" ng-model="search" class="form-control" placeholder="Buscar Tienda..." />

<!-- table that shows product record list -->
<table class="hoverable bordered">

    <thead>
        <tr>
            <th class="text-align-center">ID</th>
            <th class="width-30-pct">Nombre</th>
            <th class="text-align-center">Domicilio</th>
            <th class="text-align-center">Estado</th>

        </tr>
    </thead>

    <tbody ng-init="getAll()">
        <tr ng-repeat="x in names | filter:search">
            <td class="text-align-center">{{ x.id }}</td>
            <td>{{ x.nombre }}</td>
            <td>{{ x.domicilio }}</td>
            <td>{{ x.estado }}</td>

            <td>
                <a ng-click="readOne(x.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Editar</a>
                <a ng-click="deleteProduct(x.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Eliminar</a>
            </td>
        </tr>
    </tbody>
</table>


                        <!-- floating button for creating product -->
    <div class="fixed-action-btn" style="bottom:45px; right:24px;">
        <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-product-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
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
app.controller('productsCtrl', function($scope, $http) {
    // more angular JS codes will be here
    $scope.showCreateForm = function(){
    // clear form
    $scope.clearForm();

    // change modal title
    $('#modal-product-title').text("Nuevo Producto");

    // hide update product button
    $('#btn-update-product').hide();

    // show create product button
    $('#btn-create-product').show();

    }

    // clear variable / form values
    $scope.clearForm = function(){
        $scope.id = "";
        $scope.nombre = "";
        $scope.domicilio = "";
        $scope.estado = "";

    }


    // create new product
    $scope.createProduct = function(){
//descripcion, precioCompra, precioVenta, departamento_id, cantidad, unidadDeMedida
        // fields in key-value pairs
        $http.post('create_tienda.php', {
                'nombre' : $scope.nombre,
                'domicilio' : $scope.domicilio,
                'estado' : $scope.estado
            }).then(
            function (data, status, headers, config) {

                console.log(data);
            // tell the user new product was created
            Materialize.toast("Tienda fue creada", 4000);

            // close modal
            $('#modal-product-form').modal('close');

            // clear modal content
            $scope.clearForm();

            // refresh the list
            $scope.getAll();
        });
    }


    // read products
    $scope.getAll = function(){
        $http.get("read_tienda.php").then(
            function (response){
                $scope.names=response.data.records;
            }
        );
    }




        // retrieve record to fill out the form
    $scope.readOne = function(id){

        // change modal title
        $('#modal-product-title').text("Editar tienda");

        // show udpate product button
        $('#btn-update-product').show();

        // show create product button
        $('#btn-create-product').hide();

        // post id of product to be edited
        $http.post('read_one.php', {
            'id' : id
        })
        .then(function(data, status, headers, config){

            // put the values in form
            $scope.id = data.data[0]["id"];
            $scope.nombre = data.data[0]["nombre"];
            $scope.domicilio = data.data[0]["domicilio"];
            $scope.estado = data.data[0]["estado"];


            // show modal
            $('#modal-product-form').modal('open');
        })
        .error(function(data, status, headers, config){
            Materialize.toast('Unable to retrieve record.', 4000);
        });
    }

    // update product record / save changes
    $scope.updateProduct = function(){
        $http.post('update_tienda.php', {
                'nombre' : $scope.nombre,
                'domicilio' : $scope.domicilio,
                'estado' : $scope.estado
        })
        .then(function (data, status, headers, config){
            // tell the user product record was updated
            Materialize.toast(data.data, 4000);

            // close modal
            $('#modal-product-form').modal('close');

            // clear modal content
            $scope.clearForm();

            // refresh the product list
            $scope.getAll();
        });
    }


// delete product
$scope.deleteProduct = function(id){

    // ask the user if he is sure to delete the record
    if(confirm("Esta seguro de eliminar el producto?")){
        // post the id of product to be deleted
        $http.post('delete_tienda.php', {
            'id' : id
        }).then(function (data, status, headers, config){

            // tell the user product was deleted
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
