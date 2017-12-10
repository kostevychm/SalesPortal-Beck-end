<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    Notifications
                    <a  href="<?= base_url('admin/notifications/create') ?>" class="btn btn-success">Add a new</a>
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
                    Notification List
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                                       <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Notification ID</th>
                                    <th>Name</th>
                                    <th>Text</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($notifications)): ?>
                                    <?php foreach ($notifications as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><?=$list['id']?></td>
                                            <td><?=$list['title']?></td>
                                            <td><?=$list['slogan']?></td>
                                            <td><?php
                                                if($list['showed'] == 1)
                                                {
                                                  echo '<i class="fa fa-eye" aria-hidden="true"></i>';
                                                }else{
                                                  echo '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
                                                }
                                             ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/notifications/edit/'.$list['id']) ?>" class="btn btn-info">edit</a>
                                                <a href="<?= base_url('admin/notifications/delete/'.$list['id']) ?>" class="btn btn-danger">delete</a>
                                                <?php
                                                  if($list['showed'] == 0 && $this->is_admin)
                                                  { ?>
                                                    <a href="<?= base_url('admin/notifications/sentToAll/'.$list['id']) ?>" class="btn btn-info">send to device</a>
                                                    <?php
                                                  }
                                                ?>
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
                                    <th>Notification ID</th>
                                    <th>Name</th>
                                    <th>Text</th>
                                    <th>Status</th>
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
