<!--header-->
<?php

include("../config/config.php");
// periksa apakah user sudah login, cek kehadiran session name
  // jika tidak ada, redirect ke login.php
if (!isset($_SESSION['yics_user'])) {
  header('location: ../index.php');
}
?>
<?php
include '../elemen/header.php';?>
<!-- end header -->
<body class="animsition">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    
      <!--navbaricon -->
<?php include '../elemen/navbaricon.php';?>
<!-- end navbaricon     -->
    
      <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
         <!-- Navbar left -->
<?php include '../elemen/navbarleft.php';?>
<!-- End Navbar left -->
    
<!-- Navbar Right -->
<?php include '../elemen/navbarright.php';?>
 <!-- End Navbar Right -->
        </div>
        <!-- End Navbar Collapse -->
    
<!-- Site Navbar Search -->
<?php include '../elemen/navbarsearch.php';?>        
<!-- End Site Navbar Search -->
      </div>
    </nav>    <div class="site-menubar">
<!-- sidebar -->
<div class="site-menubar-body" >
<div>
  <div><br><br>
    <ul class="site-menu" data-plugin="menu"> 
      <li class="site-menu-item has-sub active open ">
        <a href="dashboard.php" class="animsition-link">
                    <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                    <span class="site-menu-title">DASHBOARD</span>
                </a> 
      </li>              
      <li class="site-menu-item has-sub">
        <a href="javascript:void(0)">
                <i class="site-menu-icon wb-table" aria-hidden="true"></i>
                <span class="site-menu-title">CONTROL TABLES</span>
                        <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">
          <li class="site-menu-item">
            <a class="animsition-link" href="controltabledep1.php">
              <span class="site-menu-title">Body Plant 1</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="controltabledep2.php">
              <span class="site-menu-title">Body Plant 2</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="controltabledep3.php">
              <span class="site-menu-title">BQC</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="site-menu-item has-sub">
        <a href="tracking.php">
                <i class="site-menu-icon wb-shopping-cart" aria-hidden="true"></i>
                <span class="site-menu-title">TRACKING DOCUMENT</span>
                        <span class="site-menu-tittle"></span>
            </a>
      </li>
      <li class="site-menu-item has-sub">
        <a href="javascript:void(0)">
                <i class="site-menu-icon fa-database" aria-hidden="true"></i>
                <span class="site-menu-title">BUDGET</span>
                      <span class="site-menu-arrow"></span>                        
            </a>
        <ul class="site-menu-sub">
          <li class="site-menu-item">
            <a class="animsition-link" href="budgetdep1.php">
              <span class="site-menu-title">Body Plant 1</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="budgetdep2.php">
              <span class="site-menu-title">Body Plant 2</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="budgetdep3.php">
              <span class="site-menu-title">BQC</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="site-menu-item has-sub">
        <a href="javascript:void(0)">
                <i class="site-menu-icon wb-user" aria-hidden="true"></i>
                <span class="site-menu-title">ADMINISTRATOR</span>
                        <span class="site-menu-arrow"></span>
            </a>
        <ul class="site-menu-sub">
          <li class="site-menu-item">
            <a class="animsition-link" href="usersetting.php">
              <span class="site-menu-title">User Setting</span>
            </a>
          </li>
          <li class="site-menu-item" >  
            <a class="animsition-link" href="categorysetting.php">
              <span class="site-menu-title">Category Setting</span>
            </a>
          </li>
          <li class="site-menu-item" >  
            <a class="animsition-link" href="fiscalsetting.php">
              <span class="site-menu-title">Time Fiscal Setting</span>
            </a>
        </li>  
      </ul>
    </li>                            
  </ul>
<!-- Site Navbar Search -->
<?php include '../elemen/sidebar.php';?>        
<!-- End Site Navbar Search -->
<!-- end sidebar -->   
    
 <!-- sidebar back -->
<?php include '../elemen/sidebarback.php';?>
<!-- end sidebar back -->   

    <!-- Page -->
    <div class="page">
     

      <div class="page-content container-fluid">
        <div class="row">
          <!-- Second Row -->
          <div class="col-lg-12 col-md-12">
            <div class="card card-shadow">
              <div class="card-header card-header-transparent bg-dark">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <div class="float-left">
                      <span class="font-size-20 bold">Form Edit Proposal</span>
                      </div>                    
                    </div>
                  </div>                                      
              </div>
              <div class="card-body bg-white">
                
              <?php 
                  //ambil data di url
                  $id=$_GET ["edit"];
                  //query data mahasiswa berdasarkan id menghasilkan array numeric
                  $proposal = mysqli_query($link_yics ,"SELECT 
				  proposal.id_kat AS id_kat,
                  depart.id_dep AS id_dep,
				  proposal.id_prop AS id_prop,
                  depart.depart AS depart,
				  kategori_proposal.kategori AS kategori,
				  time_fiscal.status,proposal.proposal AS proposal
                  FROM proposal 
                  LEFT JOIN depart ON proposal.id_dep = depart.id_dep
                  LEFT JOIN kategori_proposal  ON proposal.id_kat = kategori_proposal.id_kat
                  LEFT JOIN time_fiscal  ON proposal.id_fis = time_fiscal.id_fis  
                  WHERE id_prop = '$id'")or die (mysqli_error($link_yics));
                  $data = mysqli_fetch_assoc($proposal)
                ?>

              <form method="post" action="../proses/dashboard/tambahplanning.php">
			  <input type="hidden" name="edit">
			  <input type="hidden" class="form-control" name="id" autocomplete="off" value="<?php echo $data['id_prop']; ?>" required>
                  	<div class="form-group row">
                     	 <h4 class="col-md-12 modal-title text-left" style="color:black;">SUBJECT</h4>                                      
                	</div>
                  <div class="form-group row">
                      <label class="col-md-2 col-form-label text-left" style="color:black;">Department</label>
                      <div class="col-md-4">
					           
							   <select name="depart" class="form-control bg-grey-200">

								<option  value="<?php echo $data['id_dep']; ?>"><?php echo $data['depart']; ?></option>
									<?php 
									$depart = mysqli_query($link_yics,"SELECT * FROM depart") or die (mysqli_error($link_yics));
									if(mysqli_num_rows($depart)){
										while($rows_depart=mysqli_fetch_assoc($depart)){?>
								<option value="<?= $rows_depart['id_dep']; ?>"><?= $rows_depart['depart']; ?></option>
										<?php 
										}
									}
									?>
                              </select>
                     
                        </div>
                        <label class="col-md-2 col-form-label text-left" style="color:black;">Category</label>
                        <div class="col-md-4">
                     		 <select name="kategori" class="form-control bg-grey-200">
								<option  value="<?php echo $data['id_kat']; ?>"><?php echo $data['kategori']; ?></option>
									<?php 
									$kategori = mysqli_query($link_yics,"SELECT * FROM kategori_proposal") or die (mysqli_error($link_yics));
									if(mysqli_num_rows($kategori)){
										while($rows_kategori=mysqli_fetch_assoc($kategori)){?>
								<option value="<?= $rows_kategori['id_kat']; ?>"><?= $rows_kategori['kategori']; ?></option>
										<?php 
										}
									}
									?>
                              </select>
                        </div>
                    </div>                                  
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label text-left" style="color:black;">Proposal</label>
                      <div class="col-md-10">
                      <input type="text" class="form-control bg-grey-200 text-uppercase" name="proposal" placeholder=" Judul Proposal" autocomplete="off" value="<?php echo $data['proposal']; ?>">
                      </div>
                    </div>
                    <hr>
                   
                    <div class="modal-footer">
                      <a href="../page/dashboard.php" type="reset" class="btn btn-danger" data-dismiss="modal">Kembali</a>
                      <button type="submit" class="btn btn-primary">Save</button>
                     </div>      
                </form>  
                                          
              	</div>             
			</div>   
		</div>                      
	</div>
</div>
          <!-- End Third Right -->
          <!-- End Third Row -->
        </div>
      </div>
    </div>
    <!-- End Page -->

<!-- Footer -->
<?php
include '../elemen/footer.php';?>


