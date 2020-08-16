<section class="content-header">
    <h1>
    Video   <?= $this->Html->link(
                        '<span class="video">Add Video</span><span class="sr-only">' . __('Add') . '</span>',
                        ['action' => 'add'],
                        ['escape' => false, 'title' => __('AddVideo'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Video</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <?php echo $this->Flash->render(); ?>
        
        <div class="box">

            <div class="box-body">
               <div>
                  
              </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Instructor</th>
                  <th>Style</th>
                  <th>Program</th>
                  <th>Count</th>
                  <th>Level</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($videos as $user): ?>
                <tr>
                  <td><?php echo $user->id; ?></td>
                  <td><?php echo $user->instructor->name ?></td>
                  <td><?php echo $user->style->style ?></td>
                  <td><?php echo $user->program->title ?></td>
                  <td><?php echo $user->count ?></td>
                  <td><?php echo $user->level ?></td>
                  <td>
                      <?php echo $user->description ?>
                  </td>
                  <td>
                      
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('edit') . '</span>',
                        ['action' => 'edit', $user['id']],
                        ['escape' => false, 'title' => __('editvid'), 'class' => 'btn btn-success btn-xs']
                    ) ?>

                    <?php
                    ?>
                    <a href="<?php echo $this->request->webroot; ?>admin/videos/delete/<?php echo $user['id']; ?>"  class="btn btn-danger btn-xs" onclick="if (confirm('Are you sure you want to delete this video?')) { return true; } return false;"><span class="fa fa-trash"></span></a>
                    <?php  ?>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        
        
        
        </div>
    </div>
</section>       