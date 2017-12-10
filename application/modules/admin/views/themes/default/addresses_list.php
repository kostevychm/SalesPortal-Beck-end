<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    Addresses
                    <a  href="<?= base_url('admin/addresses/create/'.$id) ?>" class="btn btn-success">Add a new</a>
                </h2>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Addresses listing
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Related To</th>
                                    <th>Description</th>
                                    <th>Created From IP</th>
                                    <th>Updated From IP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($addresses)): ?>
                                    <?php foreach ($addresses as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><?=$list['podnik']?></td>
                                            <td>
                                              <?=$list['city']?>, <?=$list['street']?> <?=$list['street_no']?><br>
                                              <?=$list['phone']?>, <?=$list['web']?>,  <?=$list['email']?>
                                            </td>
                                            <td><?=$list['created_from_ip']?></td>
                                            <td><?=$list['updated_from_ip']?></td>
                                            <td>
                                                <a href="<?= base_url('admin/addresses/edit/'.$list['id']) ?>" class="btn btn-info">edit</a>
                                                <a href="<?= base_url('admin/addresses/delete/'.$list['id']) ?>" class="btn btn-danger">delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="even gradeC">
                                        <td>No data</td>
                                        <td>No data</td>
                                        <td>No data</td>
                                        <td>No data</td>
                                        <td>
                                            <a href="#" class="btn btn-info">edit</a>
                                            <a href="#" class="btn btn-danger">delete</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfooter>
                                <tr>
                                    <th>Address ID</th>
                                    <th>Description</th>
                                    <th>Created From IP</th>
                                    <th>Updated From IP</th>
                                    <th>Action</th>
                                </tr>
                            </tfooter>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
</div>
<!-- /#page-wrapper -->
