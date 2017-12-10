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
                    Update category
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="POST" action="<?=base_url('admin/categories/edit/'.$category->id)?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Category Id Input</label>
                                    <input class="form-control" value="<?=$category->id?>" placeholder="Auto generated" disabled="1">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input value="<?=$category->title?>" class="form-control" placeholder="Enter category name" id="title" name="title">
                                </div>
                                <div class="form-group">
                                    <label>Slogan</label>
                                    <input value="<?=$category->slogan?>" class="form-control" placeholder="Enter category slogan" id="slogan" name="slogan">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" size="20" />

                                </div>

                                <button type="submit" class="btn btn-primary">Submit Button</button>
                            </form>
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
