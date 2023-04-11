<?php require 'views/shared/header.php'; ?>
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Registro de casas</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">DNI</th>
                                    <th style="width: 30%;">Nombre del cliente</th>
                                    <th style="width: 30%;">Condominio</th>
                                    <th style="width: 10%;">Manzana</th>
                                    <th style="width: 10%;">Lote</th>
                                    <th style="width: 10%;">
                                        <a href="<?php echo constant("URL") ?>/house/new" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3">
                                            <i class="btn-inner">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                            </i>
                                            Nuevo
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="rows">
                                <?php foreach ($this->rows as $row) { ?>
                                    <tr>
                                        <?php for ($i = 0; $i < count($row) - 1; $i++) { ?>
                                            <td><?php echo $row[$i] ?>
                                            </td>
                                        <?php } ?>
                                        <td>
                                            <a href="<?php echo constant("URL") ?>/house/edit?id=<?php echo ($row[count($row) - 1]) ?>" class="btn btn-sm btn-icon text-primary flex-end" data-bs-toggle="tooltip" title="Editar Cliente">
                                                <span class="btn-inner">
                                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
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
<?php require 'views/shared/footer.php'; ?>