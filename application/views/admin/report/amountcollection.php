<div class="content-wrapper" style="min-height: 433px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Amount Collection
        </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                                                
                <div class="row">
                    <div class="col-md-12">
                                            </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Amount Submission by employee</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="http://localhost/pms/addNewUser" method="post" novalidate="novalidate">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Employee: 123</label>
                                        <select class="form-control required" id="role" name="role" aria-required="true" aria-invalid="true">
                                            <option value="0">Select Employee</option>
                                                                                                <option value="2">Anil</option>
                                                                                                        <option value="3">Rapani</option>
                                                                                            </select>
                                                                                            
                                    </div>
                                </div>
                                
                                
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Terminal</label>
                                        <select class="form-control required" id="role" name="role" aria-required="true" aria-invalid="true">
                                            <option value="0">Select Terminal</option>
                                                                                                <option value="2">Exit Terminal 1</option>
                                                                                                        <option value="3">Exit Terminal 2</option>
                                                                                            </select>
                                                                                            
                                    </div>
                                </div>
                           
                        
                            </div>
                            <div class="row">
                                   <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Pending Amount</label>
                                        <input disabled type="text" class="form-control required" id="fname" value="100000">
                                    </div>
                                    
                                </div>
                      
                            
                            </div>
                            
                            
                                <div class="row">
                                   <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Hard Cash</label>
                                        <input type="text" class="form-control required" id="fname" value="100000">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Soft Cash</label>
                                        <input type="text" class="form-control required" id="password" name="password" maxlength="10" aria-required="true">
                                    </div>
                                </div>
                            
                            </div>
                            
                                   <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Total Amount</label>
                                        <input type="text" class="form-control required" id="password" name="password" maxlength="10" aria-required="true">
                                    </div>
                                </div>
                            
                            </div>
                            
                            
                            
                             
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <input type="reset" class="btn btn-default" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
            
        </div>    
    </section>
    
</div>