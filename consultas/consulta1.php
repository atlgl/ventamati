<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Empleado</title>

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
            <h4>Empleado</h4>
             <!-- used for searching the current list -->
<input type="text" ng-model="search" class="form-control" placeholder="Buscar Empleado..." />

<!-- table that shows product record list -->
<table class="hoverable bordered">

    <thead>
        <tr>
            <th class="text-align-center">ID</th>
            <th class="width-30-pct">Puesto</th>
            <th class="text-align-center">Tienda</th>
            <th class="text-align-center">Nombre</th>
            <th class="text-align-center">Apellido Paterno</th>
            <th class="text-align-center">Apellido Materno</th>
            <th class="text-align-center">Email</th>
            <th class="text-align-center">Domicilio</th>

        </tr>
    </thead>

    <tbody ng-init="getAll()">
        <tr ng-repeat="x in names | filter:search">
            <td class="text-align-center">{{ x.id }}</td>
            <td>{{ x.puesto }}</td>
            <td>{{ x.tiendanombre }}</td>
            <td>{{ x.personanombre }}</td>
            <td>{{ x.apat }}</td>
            <td>{{ x.amat }}</td>
            <td>{{ x.email }}</td>
            <td>{{ x.domicilio }}</td>

            <td>
                <a ng-click="readOne(x.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Editar</a>
                <a ng-click="deleteProduct(x.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Eliminar</a>
            </td>
        </tr>
    </tbody>
</table>


                        <!-- floating button for creating product -->
                        <!--
    <div class="fixed-action-btn" style="bottom:45px; right:24px;">
        <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-product-form" ng-click="showCreateForm()"><i class="large material-icons">add</i></a>
    </div>
-->


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


    // read products
    $scope.getAll = function(){
        $http.get("read_empleado.php").then(
            function (response){
                $scope.names=response.data;
            }
        );
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
