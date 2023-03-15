<?php require 'views/shared/header.php'; ?>
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12 text-center">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="container text-center header-title">
                        <div class="col-12">
                            <h1 class="card-title"><?php echo $this->mensaje ?> a <?php echo constant("SYS") ?></h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-12">
                                <img width="80%" src="https://cdn.goconqr.com/uploads/media/image/37268456/desktop_584440b8-02d9-468b-a634-087d4abd5f99.png" alt="Bienvenido a <?php echo constant("SYS-SHORT") ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'views/shared/footer.php'; ?>