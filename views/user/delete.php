<?php require 'views/shared/header.php'; ?>

<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="d-flex align-items-center justify-content-center vh-100">
                    <div class="text-center">
                        <h1 class="display-1">Eliminar usuario</h1>
                        <p class="lead">
                        Se va a eliminar el registro, ¿Desea continuar?
                        </p>
                        <div class="lead">
                            <a href="<?php echo constant("URL") ?>/user/deleteUser?id=<?php echo $this->dni ?>" class="btn btn-danger">Sí</a>&nbsp;
                            <a href="<?php echo constant("URL") ?>/user" class="btn btn-success">No</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/shared/footer.php'; ?>
