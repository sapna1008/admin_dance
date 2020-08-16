<section class="content-header">
    <h1>
    Programs
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
          <h3 class="box-title"><?= h($programs->fname) ?></h3>
        </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tbody>
                  <tr>
                    
                  </tr>
                  <tr>
                      <th><?= __('Id') ?></th>
                      <td><?= $this->Number->format($programs->id) ?></td>
                  </tr>
                  <?php if($programs->title){ ?>
                  <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($programs->title) ?></td>
                  </tr>
                  <?php } ?>


                   <?php if($programs->description){ ?>
                  <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($programs->description) ?></td>
                  </tr>
                  <?php } ?>



                  <?php if($programs->thumbnail){ ?>
                  <tr>
                    <th><?= __('Image') ?></th> 
                    <td>
                      <?php if($programs->thumbnail != ''){ ?>
                      <img src="<?php echo $this->request->getAttribute('webroot'); ?>images/introductoryimages/<?php echo $programs->thumbnail; ?>" style="width: 190px; margin-bottom: 20px;
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



 <div class="col-md-12">
            
          <!-- general form elements -->
              <div class="box box-primary">
             
               <div class="box-body">

                <div class="panel-group" id="accordion">
                    <label for="exampleInputEmail1">Programs</label>
  
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse_1">Beginners</a>
                            </h4>
                        </div>
                        <div id="collapse_1" class="panel-collapse collapse in">
                            <div class="panel-body">
                              <?php
                              foreach($programs->videos as $video)
                              {
                                if($video['level'] == "beginner")
                                {
                                
                                ?>  
                                <video width="200" height="150" controls>
                                <source src="<?php echo $this->request->getAttribute('webroot'); ?>images/introductoryimages/<?php echo $video->video; ?>" type="video/mp4">
                                <source src="<?php echo $this->request->getAttribute('webroot'); ?>images/introductoryimages/<?php echo $video->video; ?>" type="video/ogg">
                              </video> 

                              <?php
                              }

                              }


                              ?>
                            </div>
                        </div>
                    </div>


                     <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse_2">Intermediate</a>
                            </h4>
                        </div>
                        <div id="collapse_2" class="panel-collapse collapse">
                            <div class="panel-body">
                               <?php
                              foreach($programs->videos as $video)
                              {
                                if($video['level'] == "intermediate")
                                {
                                
                                ?>
                                <video width="200" height="150" controls>
                                <source src="<?php echo $this->request->getAttribute('webroot'); ?>images/introductoryimages/<?php echo $video->video; ?>" type="video/mp4">
                                <source src="<?php echo $this->request->getAttribute('webroot'); ?>images/introductoryimages/<?php echo $video->video; ?>" type="video/ogg">
                              </video> 

                              <?php

                              }
                              }


                              ?>
                            </div>
                        </div>
                    </div>

                     <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse_3">Expert</a>
                            </h4>
                        </div>
                        <div id="collapse_3" class="panel-collapse collapse">
                            <div class="panel-body">

                               <?php
                              foreach($programs->videos as $video)
                              {
                                if($video['level'] == "expert")
                                {
                                ?>
                                <video width="200" height="150" controls>
                                <source src="<?php echo $this->request->getAttribute('webroot'); ?>images/introductoryimages/<?php echo $video->video; ?>" type="video/mp4">
                                <source src="<?php echo $this->request->getAttribute('webroot'); ?>images/introductoryimages/<?php echo $video->video; ?>" type="video/ogg">
                              </video> 

                              <?php
                              }
                              }


                              ?>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </form>
          </div>
      </div>

</div>
</section> 
