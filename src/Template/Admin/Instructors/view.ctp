<section class="content-header">
    <h1>
    Instructors
     <?= $this->Flash->render() ?> 
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">View</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
         
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"><?= h($instructor->fname) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
        <tr>
          
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($instructor->id) ?></td>
        </tr>
        <?php if($instructor->name){ ?>
        <tr>
          <th><?= __('Name') ?></th>
          <td><?= h($instructor->name) ?></td>
        </tr>
        <?php } ?>
        
         <?php if($instructor->phone){ ?>
        <tr>
          <th><?= __('Style') ?></th>
          <td><?= h($instructor->style) ?></td>
        </tr>
         <?php } ?> 
         
          <?php if($instructor->email){ ?>
        <tr>
          <th><?= __('Email') ?></th>
          <td><?= h($instructor->email) ?></td>
        </tr>
         <?php } ?> 
       
        <?php if($instructor->phone){ ?>
        <tr>
          <th><?= __('Phone') ?></th>
          <td><?= h($instructor->phone) ?></td>
        </tr>
         <?php } ?> 

        <!-- <?php if($user->deactivate_reason){ ?>-->
        <!--<tr>-->
        <!--  <th><?= __('Deactivate Reason') ?></th>-->
        <!--  <td><?= h($user->deactivate_reason) ?></td>-->
        <!--</tr>-->
        <!-- <?php } ?> -->

        <!--  <?php if($user->deactivate_desc){ ?>-->
        <!--<tr>-->
        <!--  <th><?= __('Deactivate Description') ?></th>-->
        <!--  <td><?= h($user->deactivate_desc) ?></td>-->
        <!--</tr>-->
        <!-- <?php } ?> -->


        <?php if($instructor->image){ ?>
        <tr>
          <th><?= __('Image') ?></th> 
          <td>
            <?php if($instructor->image != ''){ ?>
            <img src="<?php echo $this->request->getAttribute('webroot'); ?>images/introductoryimages/<?php echo $instructor->image; ?>" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php }else{ ?>
            <img src="<?php echo $this->request->getAttribute('webroot'); ?>images/introductoryimages/noimage.png" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php } ?>
          </td>
        </tr>
         <?php } ?>

         
     
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section> 
