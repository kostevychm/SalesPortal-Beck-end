<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                Addresses
                <a  href="<?= base_url('admin/addresses') ?>" class="btn btn-warning">Go back to addresses listing</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Update address
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php if ($this->session->flashdata('message')): ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=$this->session->flashdata('message')?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-lg-6">
                            <form role="form" method="POST" action="<?=base_url('admin/addresses/edit/'.$address->id)?>">
                                <div class="form-group">
                                    <label>Address Id Input</label>
                                    <input class="form-control" value="<?=$address->id?>" placeholder="Auto generated" disabled="1">
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <select class="form-control" id="city_id" name="city_id">
                                        <?php if (count($cities)): ?>
                                            <?php foreach ($cities as $key => $city): ?>
                                                <option value="<?= $city['id'] ?>" <?= ($address->city_id == $city['id']) ? 'selected="selected"' : '' ?>><?= $city['city'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Establishment</label>
                                    <select class="form-control" id="parent_id" name="parent_id">
                                        <?php if (count($establishments)): ?>
                                            <?php foreach ($establishments as $key => $establishment): ?>
                                                <option value="<?= $establishment['id'] ?>" <?= ($address->parent_id == $establishment['id']) ? 'selected="selected"' : '' ?>><?= $establishment['name'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Street</label>
                                    <input class="form-control" value="<?= $address->street ?>" placeholder="Enter street" id="street" name="street">
                                </div>
                                <div class="form-group">
                                    <label>Street no</label>
                                    <input class="form-control" value="<?= $address->street_no ?>" placeholder="Enter street_no" id="street_no" name="street_no">
                                </div>
                                <div class="form-group">
                                    <label>Zip</label>
                                    <input class="form-control" value="<?= $address->zip ?>" placeholder="Enter zip" id="zip" name="zip">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" value="<?= $address->phone ?>" placeholder="Enter phone number" id="phone" name="phone">
                                </div>

                                <div class="form-group">
                                    <label>Web</label>
                                    <input class="form-control" value="<?= $address->web ?>" placeholder="Enter web page" id="web" name="web">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" value="<?= $address->email ?>" placeholder="Enter email address" id="email" name="email">
                                </div>

                                <div class="form-group">
                                    <label>Lat</label>
                                    <input class="form-control" value="<?= $address->lat ?>" placeholder="Enter lat" id="lat" name="lat">
                                </div>
                                <div class="form-group">
                                    <label>Lng</label>
                                    <input class="form-control" value="<?= $address->lng ?>" placeholder="Enter lng" id="lng" name="lng">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit Button</button>
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
