<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if($loggeduser['image'] != ''){ ?>
            <img src="<?php echo $this->request->getAttribute("webroot"); ?>images/users/<?php echo $loggeduser['image']; ?>" class="img-circle" />
            <?php }else{ ?>
            <img src="<?php echo $this->request->getAttribute("webroot"); ?>images/users/noimage.png" class="img-circle" />
            <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php if(isset($loggeduser['name'])){ echo $loggeduser['name']; } ?></p> 
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="<?php if($this->request->getParam('controller') == 'Dashboard' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        
        <li class="<?php if($this->request->getParam('controller') == 'Users' ) { echo "active"; }?>">
          <a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/users">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
         <li class="treeview <?php if($this->request->getParam('controller') == 'Instructors' ) { echo "active"; }?>">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Programs</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
          
          <ul class="treeview-menu">

          <li class="<?php if($this->request->getParam('controller') == 'Programs' && $this->request->getParam('action') == 'index' ) { echo "active"; }?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/programs">
                <i class="fa fa-circle-o"></i>programs</a></li>


              
            <li class="<?php if($this->request->getParam('controller') == 'Instructors' && $this->request->getParam('action') == 'index' ) { echo "active"; }?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/instructors">
                <i class="fa fa-circle-o"></i>instructors</a></li>
                
                
            <li class="<?php if($this->request->getParam('controller') == 'Videos' && $this->request->getParam('action') == 'index' ) { echo "active"; }?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/videos/index"><i class="fa fa-circle-o"></i> videos</a></li>
            
            <li class="<?php if($this->request->getParam('controller') == 'Styles' && $this->request->getParam('action') == 'index' ) { echo "active"; }?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/styles/index"><i class="fa fa-circle-o"></i> Dance style</a></li>
            
            
          </ul>
        </li>
         <li class="treeview <?php if($this->request->getParam('controller') == 'Products' ) { echo "active"; }?>">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Products</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
          
          <ul class="treeview-menu">
              
            <li class="<?php if($this->request->getParam('controller') == 'Products' && $this->request->getParam('action') == 'index' ) { echo "active"; }?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/products">
                <i class="fa fa-circle-o"></i>products</a></li>
                
                
            <li class="<?php if($this->request->getParam('controller') == 'Products' && $this->request->getParam('action') == 'option' ) { echo "active"; }?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/products/option"><i class="fa fa-circle-o"></i> options</a></li>
            
            <li class="<?php if($this->request->getParam('controller') == 'Products' && $this->request->getParam('action') == 'product_option' ) { echo "active"; }?>"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/products/product_option"><i class="fa fa-circle-o"></i> product option</a></li>
          </ul>
        </li>
        <li class=" treeview">
          <a href="#">
           <i class="fa fa-cog" aria-hidden="true"></i>
            <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/introductories"><i class="fa fa-circle-o"></i> Inroductory screen </a></li>
            <li class="active"><a href="<?php echo $this->request->getAttribute("webroot"); ?>admin/subscriptions"><i class="fa fa-circle-o"></i>Subscriptions</a></li>
          </ul>
        </li>
        
    
  
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>