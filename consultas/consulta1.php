<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tiendas Departamentos</title>

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
            <h4>Tienda Depto</h4>


             <!-- used for searching the current list -->
<input type="text" ng-model="search" class="form-control" placeholder="Buscar Empleado..." />

<!-- table that shows product record list -->
<table class="hoverable bordered">

    <thead>
        <tr>
            <th class="text-align-center">Tienda</th>
            <th class="width-30-pct">Departamento</th>
        </tr>
    </thead>

    <tbody ng-init="readOne()">
        <tr ng-repeat="x in names | filter:search">
            <td class="text-align-center">{{ x.nombretienda }}</td>
            <td>{{ x.nombredepartamento }}</td>
        </tr>
    </tbody>
</table>

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
        // retrieve record to fill out the form
    $scope.readOne = function(id){
        $http.post('read_datos.php', {
            'opc' : 1
        })
        .then(function(responce, status, headers, config){
            $scope.names=responce.data;

        })
        .error(function(data, status, headers, config){
            Materialize.toast('Unable to retrieve record.', 4000);
        });
    }
    });
// jquery codes will be here
    $(document).ready(function(){
    // initialize modal

        //$('select').material_select();
    });
</script>

</body>
</html>
