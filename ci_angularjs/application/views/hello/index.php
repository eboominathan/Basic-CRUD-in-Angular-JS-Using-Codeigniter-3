<section class="content" ng-app="">
  <div class="row">
    <div class="col-lg-12">
      <!-- general form elements -->     
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Hello Word</h3>
        </div><!-- /.box-header -->
          <div class="box-body">  
                <div class="form-group">
                  <label>Type some text</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                        ng-model = mytext
                    </div>
                    <input type="text" class="form-control" id="test" ng-model="mytext" 
                           placeholder="Type some text" required="" autofocus="">
                  </div>
                  <div>
                        Result <small> expression</small> :
                        {{ mytext }}
                    </div>
                </div>
              
          </div><!-- /.box-body -->
      </div><!-- /.box -->
      
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Basic directive</h3>
        </div><!-- /.box-header -->
          <div class="box-body">
              
            <div class="form-group">
                <label>Set Lowercase</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        ng-keyup = mylowercase
                    </div>
                    <input type="text" class="form-control"  ng-model="mylowercase" 
                        placeholder="Type some text">
                </div>
                <div>
                    Result <small> expression</small> :
                    {{ mylowercase | lowercase}}
                </div>
            </div>

            <div class="form-group">
              <label>Set Uppercase</label>
              <div class="input-group">
                <div class="input-group-addon">
                    ng-model = myuppercase
                </div>
                <input type="text" class="form-control" id="test" ng-model="myuppercase" 
                       placeholder="Type some text">
              </div>
              <div>
                    Result <small> expression</small> :
                    {{ myuppercase | uppercase }}
                </div>
            </div>
            <div class="form-group">
              <label>Dual Text box </label>
              <div class="input-group">
                <div class="input-group-addon">
                   
                </div>
        First name <input type="text" class="form-control" ng-model="firstname"placeholder="Type some text">
        Last Name <input type="text" class="form-control" ng-model="lastname"placeholder="Type some text">
              </div>
              <div>
                    Result <small> expression</small> :
                   Welcome {{ firstname + " " + lastname }}!
                </div>
            </div>
                          
          </div><!-- /.box-body -->
      </div><!-- /.box -->
      
    </div>
  </div>   <!-- /.row -->
</section><!-- /.content -->