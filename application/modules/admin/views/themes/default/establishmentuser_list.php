<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    Alowed Users
                    <a  href="<?= base_url('admin/establishments/addRelatedUser/'.$id) ?>" class="btn btn-success">Add a new</a>
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
                    Users listing
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                                       <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Created From IP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($establishment)): ?>
                                    <?php foreach ($establishment as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                              <a href="../users/edit/<?= $list['user_id'] ?>">
                                                <?= $list['first_name'] ?> <?= $list['last_name'] ?>, <?= $list['email'] ?></a>
                                            </td>
                                            <td><?=$list['created_from_ip']?></td>
                                            <td>
                                                <a href="<?= base_url('admin/establishments/deleteRelatedUser/'.$list['id']) ?>" class="btn btn-danger">delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="even gradeC">
                                        <td>No data</td>
                                        <td>No data</td>
                                        <td>
                                            <a href="#" class="btn btn-danger">delete</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfooter>
                                <tr>
                                    <th>User</th>

                                    <th>Created From IP</th>

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
