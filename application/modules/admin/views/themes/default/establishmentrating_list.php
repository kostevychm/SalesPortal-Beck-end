<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    Ratings

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
                                    <th>Value</th>
                                    <th>Created From IP</th>
                                    <th>Date</th>
                                    <?php
                                      if($this->is_admin==1)
                                        {
                                          ?><th>Action</th><?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($establishment)): ?>
                                    <?php foreach ($establishment as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                              <?= $list['value'] ?>
                                            </td>
                                            <td><?=$list['created_date']?></td>
                                            <td><?=$list['created_from_ip']?></td>
                                            <?php
                                              if($this->is_admin==1)
                                                {
                                                  ?>  <td>


                                                    <a href="<?= base_url('admin/establishments/ratingDelete/'.$list["id"]) ?>" class="btn btn-danger">delete</a>

                                                </td>  <?php
                                                }
                                            ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="even gradeC">
                                        <td>No data</td>
                                        <td>No data</td>
                                        <td>No data</td>
                                        <?php
                                          if($this->is_admin==1)
                                            {
                                              ?>  <td>

                                            <a href="#" class="btn btn-danger">delete</a>

                                        </td><?php } ?>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfooter>
                              <tr>
                                <th>Value</th>
                                <th>Created From IP</th>
                                <th>Date</th>
                                <?php
                                  if($this->is_admin==1)
                                    {
                                      ?><th>Action</th><?php } ?>
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
