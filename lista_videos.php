<?php 
include('includes/header.php');
?>

<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Lista de Vídeos</h4>
                <ol class="breadcrumb">
                    
                    
                </ol>

                
            </div>
        </div>
</div>
<div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <a href="crear_video.php" class="btn btn-primary waves-effect waves-light float-right m-b-10 ">Crear Usuario</a>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>options</th>
                            
                        </tr>
                        </thead>


                        <tbody>
                        <tr>
                            
                        </tr>
                        
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

<?php 
include('includes/footer.php');
include('includes/scripts.php');

?>