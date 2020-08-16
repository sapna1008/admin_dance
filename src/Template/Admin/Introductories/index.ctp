<section class="content-header">
    <h1>
    Screens
      <?php  if(empty($introductoryimage) || count($introductoryimage) < 3)
      {
         echo $this->Html->link(__('Add Screens'), ['action' => 'add'], ['class' => 'btn btn-warning']);
      }


     ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Introductory screens


        </li>
    </ol>
</section>

<section class="content">
  <div class="row">
        <div class="col-xs-12">
        
        <?php echo $this->Flash->render(); ?>
        
        <div class="box">

            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S No.</th>
                  <th>Tilte</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
              
                <?php
                $count =1;
                foreach($introductoryimage as $data )
                {
                  ?>
                    <tr>
                  <td><?php echo $count; ?></td>
                  <td><?php echo $data['title']; ?></td>
                  <td>
                   <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'edit', $data['id']],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
                  </td>
                  </tr>
                  <?php
                  $count++;
                }
                 ?>
                
                </tbody>
              
              </table>
            </div>
          </div>
        
        
        
        </div>
    </div>
</section>       