<section class="content-header">
    <h1>
    <?= __('Reason') ?>   <?= $this->Html->link(__('Add Reason'), ['action' => 'add'], ['class' => 'btn btn-warning']) ?>
    <small></small>
    </h1>
    
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        <?php echo $this->Flash->render(); ?>
        
        <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
             <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
                <tbody>
                 <?php foreach ($reasons as $reason): ?>
            <tr>
                <td><?= $this->Number->format($reason->id) ?></td>
                <td><?= h($reason->reason) ?></td>
                <td><?php echo ($reason['status'] == '0') ? 'Disabled' : 'Enabled'; ?></td>
                <td><?= h($reason->created) ?></td>
                <td class="actions">
                   <!-- <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $reason->id],
                        ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-xs']
                    ) ?>  --> 
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'edit', $reason->id],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-xs']
                    ) ?>
                  
                     
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reason->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reason->id),'class' => 'btn btn-danger btn-xs']) ?>
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