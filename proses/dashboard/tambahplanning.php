<?php 
include("../../config/config.php");

if (isset ($_SESSION['yics_user'])){
    if(isset($_POST['add'])){
         // masukan data post ke variabel 
        $depart=$_POST['depart']; 
        $kategori=$_POST['kategori'];
        $proposal=$_POST ['proposal'];
        $cost=$_POST ['cost'];
        $id_fis=$_POST ['id_fis'];
       

        // cek username sudah ada apa blm?
        $qry = mysqli_query($link_yics, "SELECT proposal FROM proposal WHERE proposal = '$proposal' ")or die(mysqli_error($link_yics));
      
    // logika pakai session
        if(mysqli_num_rows($qry)>0){
            $_SESSION['info'] = "Gagal Disimpan";
            $_SESSION['pesan'] = "Data User Sudah Ada di Database";
            header('location: ../../page/dashboard.php');
        }else{
            $_SESSION['info'] = "Disimpan";
            $_SESSION['pesan'] = "Data Berhasil Disimpan";
            header('location: ../../page/dashboard.php');
         }
         $inputproposal = "INSERT INTO proposal (`id_dep`,`id_kat`,`proposal`,`cost`,`id_fis`) VALUES ('$depart','$kategori','$proposal','$cost','$id_fis')"; 
         $sql = mysqli_query($link_yics, $inputproposal)or die(mysqli_error($link_yics));
    // end logika pakai session
    // query insert boleh ngacak sesuai intonya
            
        
    }else if(isset ($_GET['del'])){
        //query delete
        $id=$_GET['del'];
        $query = "DELETE FROM proposal WHERE id_prop='$id'";
         $hasil_query = mysqli_query($link_yics, $query)or die(mysqli_error($link_yics));
         if($hasil_query){
            $_SESSION['info'] = "Dihapus";
            $_SESSION['pesan'] = "Data Berhasil Dihapus";
            header('location: ../../page/dashboard.php');
         }else{
            $_SESSION['info'] = "Gagal Dihapus";
            $_SESSION['pesan'] = "Data Gagal Dihapus";
            header('location: ../../page/dashboard.php');
         }
    }else if (isset($_POST['edit'])){
        // masukan data post ke variabel
        $id=$_POST ['id']; 
        $depart=$_POST['depart'];
        $kategori=$_POST['kategori'];
        $proposal=$_POST['proposal'];
        
       $UbahProposal = "UPDATE  proposal SET id_kat='$kategori',id_dep='$depart',proposal='$proposal' WHERE id_prop = '$id'"; 
       echo $UbahProposal;
       $sql = mysqli_query($link_yics, $UbahProposal)or die(mysqli_error($link_yics));
    // logika pakai session
       if(mysqli_num_rows($sql)>0){
        // echo "tes1";kategori_proposal
         $_SESSION['info'] = "Gagal Diubah";
         $_SESSION['pesan'] = "Data User Sudah Ada di Database";
         header('location: ../../page/dashboard.php');
       }else{
         $_SESSION['info'] = "Diubah";
         $_SESSION['pesan'] = "Data Berhasil Diubah";
         header('location: ../../page/dashboard.php');
        }
      }else if(isset ($_GET['proses'])){
      // print_r($_POST['check']);
         foreach($_POST['check']as $id){
            $deleteAll = "DELETE FROM kategori_proposal WHERE id='$id'";    
            $hasil_delete = mysqli_query($link_yics, $deleteAll)or die(mysqli_error($link_yics));
            } 
            if($hasil_delete){
               $_SESSION['info'] = "Dihapus";
               $_SESSION['pesan'] = "Data Berhasil Dihapus";
               header('location: ../../page/categorysetting.php');
            }else{ 
               $_SESSION['info'] = "Gagal Dihapus";
               $_SESSION['pesan'] = "Data Gagal Dihapus";
               header('location: ../../page/categorysetting.php');
         } 
    }     
}else {
   header("location: ../../index.php");
 }
