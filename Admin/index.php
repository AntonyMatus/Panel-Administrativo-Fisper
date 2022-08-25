
<?php 
session_start();

if(!isset($_SESSION['user_id'])){
header('location:login.php');
} else {

}
?>
<?php 
include('includes/header.php');
?>


<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">FISPER</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    Welcome to Fisper Dashboard
                    <?php echo $_SESSION['user_id'];?>
                </li>
            </ol>
           
            <?php include('message.php'); ?>
        </div>
    </div>
</div>
<!-- end row -->

<?php 
include('includes/footer.php');
include('includes/scripts.php');

?>