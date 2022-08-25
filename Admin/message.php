<?php
if(isset($_SESSION['message']))
{
    ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Hey!</strong> <?php echo $_SESSION['message']; ?>
        </div>
    <?php
    unset($_SESSION['message']);
}

?>