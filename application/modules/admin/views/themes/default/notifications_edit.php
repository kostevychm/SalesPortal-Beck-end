<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Notifications
                <a  href="<?= base_url('admin/notifications') ?>" class="btn btn-warning">Go back to categories listing</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Update notification
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="POST" action="<?=base_url('admin/notifications/edit/'.$notification->id)?>">
                                <div class="form-group">
                                    <label>notification Id Input</label>
                                    <input class="form-control" value="<?=$notification->id?>" placeholder="Auto generated" disabled="1">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input value="<?=$notification->title?>" class="form-control" placeholder="Enter notification name" id="title" name="title">
                                </div>
                                <div class="form-group">
                                    <label>Text</label>
                                    <input value="<?=$notification->slogan?>" class="form-control" placeholder="Enter notification slogan" id="slogan" name="slogan">
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
