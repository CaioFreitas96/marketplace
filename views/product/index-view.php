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
                    <h6 class="mb-0 ">PRODUCT</h6>                       
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
                                        <h1 class="h4 text-gray-900 mb-4">Register Product</h1>
                                    </div>
                                    <form class="user" id="form_register">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user"
                                                    placeholder="Name product" name="name">
                                            </div>    
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user" 
                                                    placeholder="Type" name="type">
                                            </div>                                            
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user" 
                                                    placeholder="Value" name="value">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user"
                                                    placeholder="Tax percentage" name="tax">
                                            </div>
                                        </div>                                            
                                        <a id="register" class="btn btn-primary btn-user btn-block">
                                            Register Product
                                        </a>
                                        <hr>                                           
                                    </form>
                                    <br><br>                                    
                                </div>
                            </div>
                            <div class="col-lg-1" style="background-color:white"></div>
                        </div>
                    </div>                                           
                </div>				
			</div>
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

	<!-- Bootstrap core JavaScript-->
    <script src="../../libs/jquery/jquery.min.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../libs/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../libs/js/sb-admin-2.min.js"></script>	
	<?php include 'template/scripts.inc' ?>
	
    <script>
        $("#register").click(function(){
            requestAjax("register","form_register")
        });

        function requestAjax(metodo,  form = null){			
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
						alert(retorno.message); 
                        window.location.reload();                        							      
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
