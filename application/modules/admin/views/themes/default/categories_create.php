<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Categories
                <a  href="<?= base_url('admin/categories') ?>" class="btn btn-warning">Go back to categories listing</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create new category
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="POST" action="<?=base_url('admin/categories/create')?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Category Id Input</label>
                                    <input class="form-control" placeholder="Auto generated" disabled="1">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control" placeholder="Enter category name" id="title" name="title">
                                </div>
                                <div class="form-group">
                                    <label>Slogan</label>
                                    <input class="form-control" placeholder="Enter category slogan" id="slogan" name="slogan">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" size="20" />

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
