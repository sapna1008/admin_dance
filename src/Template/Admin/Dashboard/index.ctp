<section class="content-header">
    <h1>
    Dashboard
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
	<div class="row">
    
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
                <a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/users">  
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  
                    <span class="info-box-text">All Users</span>
                    <span class="info-box-number"><?php echo count($users); ?><small></small></span> 
                </div>
              </a>  
            </div>
        </div>
    </div>
    
</section> 