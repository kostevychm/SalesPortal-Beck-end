<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    Establishment
                    <a  href="<?= base_url('admin/establishment/create') ?>" class="btn btn-success">Add a new</a>
                </h2>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
          <?php if ($this->session->flashdata('message')): ?>
          <div class="col-lg-12 col-md-12">
              <div class="alert alert-info alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?=$this->session->flashdata('message')?>
              </div>
          </div>
          <?php endif; ?>
          
            <div class="panel panel-default">
                <div class="panel-heading">
                    Establishment listing
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Short Desc</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($establishment)): ?>
                                    <?php foreach ($establishment as $key => $list): ?>
                                        <tr class="odd gradeX">

                                            <td><?=$list['name']?></td>
                                            <td><?=$list['title']?></td>
                                            <td><?=$list['short_desc']?></td>
                                            <td><?=$list['rating']?>/5</td>
                                            <td>
                                              <?php
                                                  if($list['showed'] == 1)
                                                  {
                                                    echo '<i class="fa fa-eye" aria-hidden="true"></i>';
                                                  }else{
                                                    echo '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
                                                  }
                                               ?>

                                              </td>
                                            <td>
                                                <a href="<?= base_url('admin/establishments/edit/'.$list['id']) ?>" class="btn btn-info">edit</a>
                                                <a class="btn btn-info" href="<?= base_url('admin/establishments/rating/'.$list['id']) ?>"><i class="fa fa-edit fa-fw"></i> Rating</a>
                                                <?php if ($this->is_admin): ?>
                                                  <a class="btn btn-info" href="<?= base_url('admin/establishments/users/'.$list['id']) ?>"><i class="fa fa-edit fa-fw"></i> Related Users</a>

                                                <?php endif; ?>
                                                <a class="btn btn-info" href="<?= base_url('admin/addresses/related/'.$list['id']) ?>"><i class="fa fa-edit fa-fw"></i> Branches</a>
                                                <a href="<?= base_url('admin/establishment/delete/'.$list['id']) ?>" class="btn btn-danger">delete</a><br>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="even gradeC">

                                        <td>No data</td>
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
                                  <th>Name</th>
                                  <th>Category</th>
                                  <th>Short Desc</th>
                                  <th>Rating</th>
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
