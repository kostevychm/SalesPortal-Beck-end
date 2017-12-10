<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Users
                <a  href="<?= base_url('admin/establishments/users/'.$id) ?>" class="btn btn-warning">Go back</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add new user
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="POST" action="<?=base_url('admin/establishments/addRelatedUser/'.$id)?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Estabilishment User id</label>
                                    <input class="form-control" placeholder="Auto generated" disabled="1">
                                </div>
                                <div class="form-group">
                                    <label>User</label>
                                    <select class="form-control" id="user_id" name="user_id">
                                        <?php if (count($users)): ?>
                                            <?php foreach ($users as $key => $user): ?>
                                                <option value="<?= $user['id'] ?>"><?= $user['first_name'] ?> <?= $user['last_name'] ?>, <?= $user['email'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit Button</button>
                                <button type="reset" class="btn btn-default">Reset Button</button>
                            </form>
                            <?php if(!empty($errors)){ ?>
                            <div class="alert alert-danger alert-dismissable">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <?php echo $errors; ?>
                            </div>
                            <?php  } ?>
                        </div>


                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
