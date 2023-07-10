<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MarketPlace </title>
		 <!-- Custom fonts for this template-->
		<link href="../../libs/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"    rel="stylesheet">
		<!-- Custom styles for this template-->
		<link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
			
	</head>
	<body id="page-top">  
	<?php include "template/template.php" ?> 
		<div id="content-wrapper" class="d-flex flex-column">      
			 
			<div id="content">
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">					
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>   					
					<ul class="navbar-nav ml-auto">
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
                    <h6 class="mb-0 ">HOME</h6>                       
                </div>
				<hr>
                <!-- Content Row -->
                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->                   
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
										REGISTERED PRODUCTS</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=count($product);?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
										SALES</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=count($sales);?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
					<div class="col-xl-2 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
										AMOUNT SALES</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$info['amount'];?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 				
					<div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
										SALES VALUE</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$info['full_value'];?></div>
                                    </div>
                                    <div class="col-auto">
									<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
					<div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
										TAX</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$info['tax'];?></div>
                                    </div>
                                    <div class="col-auto">
									<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
				<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Type</th>
											<th>Value</th>
                                            <th>Tax Percentage</th>                                           
                                        </tr>
                                    </thead>                                   
                                    <tbody>
										<?php foreach ($product as $key => $value) { ?>
											<tr>
												<td><?=$value->name;?></td>
												<td><?=$value->type;?></td>
												<td><?=funcValor($value->value,"C",2);?></td>
												<td><?=funcValor($value->tax,"A",2)."%";?></td>												
											</tr>    
										<?php } ?>                                                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
	<script type="text/javascript">
	
	</script>
</html>
