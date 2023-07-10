<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MarketPlace </title>		
		<link href="../../libs/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"    rel="stylesheet">	    
		<link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">		
	</head>
	<body id="page-top">  
	    <?php include "template/template.php" ?> 
		<div id="content-wrapper" class="d-flex flex-column">  	 
			<div id="content">
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>   
					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Nav Item - Messages -->
						<li class="nav-item dropdown no-arrow mx-1">
							<a class="nav-link dropdown-toggle" href="/login/finish" >
								<i> Logout</i>							
							</a>							
						</li>						
					</ul>
				</nav>
				<!-- Begin Page Content -->
				<div class="container-fluid">
                
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0 ">Sales</h6>                       
                </div>
                <hr>
                <!-- Content Row -->
                <div class="row">                   
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-1" style="background-color:white"></div>
                            <div class="col-lg-8" style="background-color:white">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Sales Product</h1>
                                    </div>
                                    <form class="user" id="form_sales">
                                        <div class="form-group row">
                                            <div class="col-sm-8 mb-3 mb-sm-0">                                              
                                                <select class="form-control" name="id_product" style="border-radius:20px;height:50px;font-size:14px">
                                                    <option value="">Select</option>
                                                    <?php if(isset($product) && !empty($product)){ ?>
                                                        <?php foreach ($product as $key => $value) { ?>
                                                            <option value="<?=$value->id;?>"><?=$value->name;?></option>
                                                        <?php } ?> 
                                                    <?php } ?>
                                                </select>
                                            </div>    
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-user" 
                                                    placeholder="Amount" name="amount">
                                            </div>                                            
                                        </div>
                                        <div class="form-group row">
                                            
                                        </div> 
                                        <div class="form-group row">  
                                            <div class="col-sm-3 mb-3 mb-sm-0"> </div>                                                                                   
                                            <a id="sales" class="btn btn-primary btn-user btn-block" style="width:50%;text-align:center">
                                            Calculate Tax
                                            </a>
                                        </div>
                                        <hr>                                            
                                    </form>
                                    <br><br>
                                    <!-- style="visibility:hidden" -->
                                    <div id="table" style="visibility:hidden">
                                        <div class="table-responsive" >
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Amount</th>
                                                        <th>Total value</th>
                                                        <th>Total Tax</th>                                           
                                                    </tr>
                                                </thead>                                   
                                                <tbody>
                                                    <?php foreach ($product as $key => $value) { ?>
                                                        <tr>
                                                            <td id="td_product"></td>
                                                            <td id="td_amount"></td>
                                                            <td id="td_value"></td>
                                                            <td id="td_tax"></td>												
                                                        </tr>    
                                                    <?php } ?>                                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>  
                                        <div class="form-group row">                                                  
                                            <a  class="btn btn-success btn-user btn-block" style="border-radius:20px" id="confirm_sales">
                                                Confirm Sales
                                            </a>
                                        </div>                                                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1" style="background-color:white"></div>
                        </div>
                    </div>                                           
                </div>				
			</div>
            <button type="button"  data-bs-toggle="modal" data-bs-target="#modal_sales" id="modal_button" hidden></button>
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Marketpkace &copy; Website 2023</span>
                </div>
            </div>
        </footer>
		</div>        
    </body>

    <!-- Modal -->
    <div class="modal fade" id="modal_sales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
        </div>
        </div>
    </div>
    </div>

   
    <?php include 'template/scripts.inc' ?>
  

	
    <script type="text/javascript">
        $("#sales").click(function(){
            requestAjax("sales","form_sales", true)
        });

        $("#confirm_sales").click(function(){
            requestAjax("confirmSales","form_sales")
        });

        function requestAjax(metodo,  form = null, table = false){			
			url  = "<?= HOME_URI.$this->module_name?>/"+metodo;					
			if(form != null){
				form = $("#"+form).serialize();                
			}	
                              	
			$.ajax({
				url: url,
				data : form,
				type: 'POST',				
                success: function(data){                    
                    retorno = JSON.parse(data);					
                    if(retorno.cod == 0){   
                        if(table == true){                     
                            $("#td_product").text(retorno.output.product);                      
                            $("#td_amount").text(retorno.output.amount);
                            $("#td_value").text(retorno.output.value);
                            $("#td_tax").text(retorno.output.tax);
                            $("#table").attr("style","visibility:visible"); 
                        }else{
                            alert(retorno.message); 
                            window.location.reload();
                        }                                       							      
                    }else{						
						alert(retorno.message);                                                 		                                    
                    }
                },
                erro: function(error){
					alert(retorno.message);    
                }
			});	
		}
  
	</script>
</html>
