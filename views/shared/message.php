<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require 'views/shared/header.php';
?>

<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="d-flex align-items-center justify-content-center vh-100">
                    <div class="text-center">
                        <h1 class="display-1"><?php echo $this->messageHeader ?></h1>
                        <p class="lead">
                            <?php echo $this->message ?>
                        </p>
                        <a href="<?php echo constant("URL") . $this->url ?>" class="btn btn-success">Continuar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/shared/footer.php'; ?>