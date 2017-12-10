<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Establishment
                <a  href="<?= base_url('admin/establishment') ?>" class="btn btn-warning">Go back to Establishment listing</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create new product
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="POST" action="<?=base_url('admin/establishment/create')?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Estabilishment Id Input</label>
                                    <input class="form-control" placeholder="Auto generated" disabled="1">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" placeholder="Enter product name" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label>Sale Percent</label>
                                    <input class="form-control" placeholder="Enter percent" id="sale" name="sale">
                                </div>
                                <div class="form-group">
                                    <label>Sales Rules</label>
                                    <textarea class="form-control" rows="3" id="rules" name="rules"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" id="features" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea class="form-control" rows="3" id="short_desc" name="short_desc"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <?php if (count($categories)): ?>
                                            <?php foreach ($categories as $key => $category): ?>
                                                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Background Image</label>
                                    <input type="file" name="bgimage" size="20" />
                                </div>

                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" name="logoimage" size="20" />
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
