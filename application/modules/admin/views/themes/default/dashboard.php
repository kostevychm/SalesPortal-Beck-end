<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <?php if ($this->session->flashdata('message')): ?>
        <div class="col-lg-12 col-md-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$this->session->flashdata('message')?>
            </div>
        </div>
        <?php endif; ?>


          <div class="col-lg-3 col-md-6">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-comments fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge"><?=$val1['value'];?></div>
                              <div><?=$val1['text'];?></div>
                          </div>
                      </div>
                  </div>
                  <a href="establishments/">
                      <div class="panel-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>

          <div class="col-lg-3 col-md-6">
              <div class="panel panel-yellow">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-shopping-cart fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge"><?=$val2['value'];?></div>
                              <div><?=$val2['text'];?></div>
                          </div>
                      </div>
                  </div>
                  <a href="establishment/">
                      <div class="panel-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>

          <div class="col-lg-3 col-md-6">
              <div class="panel panel-red">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-support fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge"><?=$val3['value'];?></div>
                              <div><?=$val3['text'];?></div>
                          </div>
                      </div>
                  </div>
                  <a href="#">
                      <div class="panel-footer">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>





    </div>

</div>
<!-- /#page-wrapper -->
