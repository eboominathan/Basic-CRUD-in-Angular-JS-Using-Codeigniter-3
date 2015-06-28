<!DOCTYPE html>
<html ng-app="listpp" ng-app lang="en">
<head>
    <meta charset="utf-8">

    <!--load all the scripts for the table data export-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/tableExport.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.base64.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/html2canvas.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/sprintf.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jspdf.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/base64.js"></script>
  
    <script type="text/javaScript"> 
    $(document).ready(function(){   
    });
  </script>

<link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">


<section class="content" >
    <div class="col-lg-12">
      <!-- general form elements -->     
      <div class="box box-primary">
        <div class="box-header">
          <div class="box-body"> 

     <!--links for the export table data-->
     <div class="btn-group pull-right">

              <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>



      <ul class="dropdown-menu " role="menu">
                <li><a href="#" onClick ="$('#customers').tableExport({type:'json',escape:'false'});"> 

                <img src='<?php echo base_url();?>assets/imgs/json.png' width='24px'> JSON</a></li>

                <li><a href="#" onClick ="$('#customers').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});">
                 <img src='<?php echo base_url();?>assets/imgs/json.png' width='24px'> JSON (ignoreColumn)</a></li>

                <li><a href="#" onClick ="$('#customers').tableExport({type:'json',escape:'true'});"> <img src='<?php echo base_url();?>assets/imgs/json.png' width='24px'> JSON (with Escape)</a></li>

                <li class="divider"></li>
                <li><a href="#" onClick ="$('#customers').tableExport({type:'xml',escape:'false'});"> <img src='<?php echo base_url();?>assets/imgs/xml.png' width='24px'> XML</a></li>
                <li><a href="#" onClick ="$('#customers').tableExport({type:'sql'});"> <img src='<?php echo base_url();?>assets/imgs/sql.png' width='24px'> SQL</a></li>

                <li class="divider"></li>
                <li><a href="#" onClick ="$('#customers').tableExport({type:'csv',escape:'false'});"> <img src='<?php echo base_url();?>assets/imgs/csv.png' width='24px'> CSV</a></li>
                <li><a href="#" onClick ="$('#customers').tableExport({type:'txt',escape:'false'});"> <img src='<?php echo base_url();?>assets/imgs/txt.png' width='24px'> TXT</a></li>

                <li class="divider"></li>       
                <li><a href="#" onClick ="$('#customers').tableExport({type:'excel',escape:'false'});"> <img src='<?php echo base_url();?>assets/imgs//xls.png' width='24px'> XLS</a></li>

                <li><a href="#" onClick ="$('#customers').tableExport({type:'doc',escape:'false'});"> <img src='<?php echo base_url();?>assets/imgs/word.png' width='24px'> Word</a></li>

                <li class="divider"></li>
                <li><a href="#" onClick ="$('#customers').tableExport({type:'pdf',escape:'false'});"> <img src='<?php echo base_url();?>assets/imgs//pdf.png' width='24px'> PDF</a></li>

                
                
              </ul>
            </div> 







            <div ng-controller="maincontroller">
                <div class="row">
                    <div class="col-md-2">PageSize:
                        <select ng-model="entryLimit" class="form-control">
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                    </div>
                    <div class="col-md-3">Filter:
                        <input type="text" ng-model="search" ng-change="filter()" placeholder="Filter" class="form-control" />
                    </div>
                    <div class="col-md-4">
                        <h5>Filtered {{ filtered.length }} of {{ totalItems}} total products</h5>
                    </div>
                </div>
                <hr class="hr" />
               <form name="add_product" class="update_entry">
                  <input type="hidden" name="prod_id" ng-model="prod_id">
                  Update Area <img src="<?php echo base_url();?>assets/imgs/arrow.png" alt="arrow" style="width:12px;height:12px">

                  <input type="text" name="prod_name" ng-model="prod_name" class="btn-default font-color">
                  <input type="text"  name="prod_desc" ng-model="prod_desc"  class="btn-default font-color">
                  <input type="text"  name="prod_price" ng-model="prod_price" class="btn-default font-color">
                  <input type="text"  name="prod_quantity" ng-model="prod_quantity"  class="btn-default font-color">
                  <input type="button" name="update_product" ng-show='update_prod' value="Update" ng-click="update_product()" class=" btn btn-primary btn-xs">
                 <a href="<?php echo base_url();?>hello/create"> 
                 <img src="<?php echo base_url();?>assets/imgs/cancle.png" alt="cancle" style="width:12px;height:12px"></a>
                </form>
  
<hr class="hr"  />
    <div class="row">
        <div class="col-md-12" ng-show="filteredItems > 0">
            <table class="table table-hover" id="customers" >
            <thead>
                <tr>
            <th>ID<a ng-click="sort_by('id');"></a></th>
            <th>Product Name <a ng-click="sort_by('prod_name');"></a></th>
            <th>Product Description <a ng-click="sort_by('prod_desc');"></a></th>
            <th>Product Price <a ng-click="sort_by('prod_price');"></a></th>
            <th>Product Quantity <a ng-click="sort_by('prod_quantity');"></a></th>  
            <th>Action</th> 
            </tr>        
            </thead>
            <tbody ng-init="get_product()">
                <tr ng-repeat="product in filtered = (pagedItems | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td>{{ product.id }}</td>
                    <td>{{ product.prod_name | uppercase }}</td>
                    <td>{{ product.prod_desc }}</td>
                    <td>{{ product.prod_price }}</td>
                    <td>{{ product.prod_quantity }}</td>    
                    <td><a href="" ng-click="prod_edit(product.id)" class="btn btn-primary">Edit</a>&nbsp;<a href="" ng-click="prod_delete(product.id)" class="btn btn-danger">Delete</a></td>
                </tr>
            </tbody>
          </table>
        <div class="col-md-12" ng-show="filteredItems == 0">
            <div class="col-md-12">
                <h4>No Record found</h4>
            </div>
        </div>
        <div class="col-md-12" ng-show="filteredItems > 0">    
            <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<section class="content" >
    <div class="col-lg-12">
      <!-- general form elements -->     
      <div class="box box-primary">
        <div class="box-header">       
       
          <div class="box-body"> 
            
        <div ng-controller="maincontroller">
         
        <div class="container col-sm-8 ">
          <div class="page-header">
        <h4>Add Product</h4>
        </div>
                <form class="form-horizontal" name="add_product" >
                  <input type="hidden" name="prod_id" ng-model="prod_id">
           <div class="form-group">
          
              <div class="col-sm-4">
                 <input type="text" class="form-control" name="prod_name" ng-model="prod_name"
                    placeholder="Enter Product Name">
              </div>
           </div>
           <div class="form-group">
             
              <div class="col-sm-4">
                 <input type="text" class="form-control" name="prod_desc" ng-model="prod_desc"
                    placeholder="Enter Product Description">
              </div>
           </div>
           <div class="form-group">
             
              <div class="col-sm-4">
                 <input type="text" class="form-control" name="prod_price" ng-model="prod_price" 
                 placeholder="Enter Product Price">
              </div>
           </div>
         <div class="form-group">
             
              <div class="col-sm-4">
                 <input type="text" class="form-control" name="prod_quantity" ng-model="prod_quantity" 
                 placeholder="Enter Product Quantity">
              </div>
           </div>
           <div class="form-group">
              <div class="col-sm-offset-1 col-sm-14">
                 <button type="submit" class="btn btn-primary"  name="submit_product" ng-show='add_prod' value="Submit" ng-click="product_submit()">Submit</button>
                 <button type="reset" class="btn btn-default">Cancel</button>
                   
              </div>
           </div>
         </div>
         
        </form>
        </div>
        </div>
        </section>


<script type="text/javascript">

      var listApp = angular.module('listpp', ['ui.bootstrap']);    

    listApp.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
    });



    listApp.controller('maincontroller', function ($scope,$http) {
    $scope.filteredItems =  [];
    $scope.groupedItems  =  [];
    $scope.itemsPerPage  =  3;
    $scope.pagedItems    =  [];
    $scope.currentPage   =  0;

  
    /** toggleMenu Function to show menu by toggle effect , by default the stage of the menu is false as we click on toggle button, we make it to true or show and reverse on anothe click event. **/

    $scope.menuState = false;
    $scope.add_prod = true;

    $scope.toggleMenu = function() {                
        if($scope.menuState) {                    
            $scope.menuState= false;
        }
        else {
            $scope.menuState= !$scope.menuState.show;
        }
    };

    /** function to get detail of product added in DB**/

    $scope.get_product = function(){
    $http.get("<?php echo base_url();?>hello/get_details").success(function(data)
    {
        //$scope.product_detail = data;   
        $scope.pagedItems = data;    
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 10; //max no of items to display in a page
        $scope.filteredItems = $scope.pagedItems.length; //Initially for no filter  
        $scope.totalItems = $scope.pagedItems.length;

    });
    }
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function() {
        $timeout(function() { 
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };

    /** function to add details for products in mysql referecing php **/

    $scope.product_submit = function() {

        $http.post('<?php echo base_url();?>hello/insert', 
            {
                'prod_name'     : $scope.prod_name, 
                'prod_desc'     : $scope.prod_desc, 
                'prod_price'    : $scope.prod_price,
                'prod_quantity' : $scope.prod_quantity
            }
        )
        .success(function (data, status, headers, config) {
          alert("Product has been Submitted Successfully");
          $scope.get_product();
        location.reload();

        })

        .error(function(data, status, headers, config){
        alert(data);
        });
    }

    /** function to delete product from list of product referencing php **/

    $scope.prod_delete = function(index) {  
     var x = confirm("Are you sure to delete the selected product");
     if(x){
      $http.post('<?php echo base_url();?>hello/delete', 
            {
                'prod_index'     : index
            }
        )      
        .success(function (data, status, headers, config) {               
             $scope.get_product();
             alert("Product has been deleted Successfully");
        })

        .error(function(data, status, headers, config){
           alert(data);
        });
      }else{

      }
    }

    /** fucntion to edit product details from list of product referencing php **/

    $scope.prod_edit = function(index) {  
      $scope.update_prod = true;
      $scope.add_prod = false;
      $http.post('<?php echo base_url();?>hello/edit', 
            {
                'prod_index'     : index
            }
        )      
        .success(function (data, status, headers, config) {    
            //alert(data[0]["prod_name"]);
           
            $scope.prod_id          =   data[0]["id"];
            $scope.prod_name        =   data[0]["prod_name"];
            $scope.prod_desc        =   data[0]["prod_desc"];
            $scope.prod_price       =   data[0]["prod_price"];
            $scope.prod_quantity    =   data[0]["prod_quantity"];


        })

        .error(function(data, status, headers, config){
           alert(data);
        });
    }

    /** function to update product details after edit from list of products **/

    $scope.update_product = function() {

        $http.post('<?php echo base_url();?>hello/update', 
                    {
                        'id'            : $scope.prod_id,
                        'prod_name'     : $scope.prod_name, 
                        'prod_desc'     : $scope.prod_desc, 
                        'prod_price'    : $scope.prod_price,
                        'prod_quantity' : $scope.prod_quantity
                    }
                  )
                .success(function (data, status, headers, config) {                 
                  $scope.get_product();
                   alert("Product has been Updated Successfully");
                    location.reload();
                })
                .error(function(data, status, headers, config){
                    alert(data);
                });
    }

   
});
</script>
<script src="<?php echo base_url();?>assets/js/ui-bootstrap-tpls-0.10.0.min.js"></script>