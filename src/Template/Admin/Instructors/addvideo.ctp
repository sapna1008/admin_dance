<section class="content-header">
    <h1>
    Video
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Video</li>
    </ol>
</section>

<section class="content">
	<div class="row">
	    <?php echo $this->Flash->render(); ?>
        <div class="col-xs-8">
        <div class="box box-primary">
            
            <div class="box-header with-border">
              <h3 class="box-title">Add Video</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create('video', ['id' => 'user-form','type' => 'post', 'url' => ['controller' => 'instructors', 'action' => 'addvideo'], 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
              
                

                <div class="form-group">
                  <label for="exampleInputEmail1">Instructor name</label>
                 <?php
                  echo $this->Form->input('instructor_id',
                    array(
                        'options' => $instructors,
                        'class' => 'form-control',
                        'label' => false,
                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'label custom-inline-error label-important help-inline'))
                    ));
                    ?>
                </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Level</label>
                  <?php echo $this->Form->select('level', [ 
                    'beginner' => 'Beginner', 
                    'intermediate' => 'Intermediate',
                    'expert' => 'Expert'
                ],['class' => 'form-control']);  
                ?>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Set count of video</label>
                    <select class = "form-control" name="count" id="count">
                      <option selected="selected">1</option>
                      <?php
                        foreach($count as $count) { ?>
                         <option value="<?= $count ?>"><?= $count ?></option>
                      <?php
                        } ?>
                    </select> 
                      </div>
                     <div class="form-group">
                  <label for="exampleInputEmail1">Video</label>
                  <?php echo $this->Form->control('video', ['id' => 'profilePic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>   
                <!--<img src="<?php echo ($video->image != '') ? $this->request->webroot.'images/introductoryimages/'.$video->image : $this->request->webroot.'images/introductoryimages/noimage.png'; ?>" class="previewHolder" style="width: 135px;"/> -->
                
               <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
    </div>
</section> 

<script>
    
    
        
$().ready(function() {
	$("#user-form").validate({
		rules: {
			description: "required",
			video: "required",
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				//digits: true
			},
			country: {
				required: true
			},
			gender: {
				required: true
			},
			dob: "required",
			password1: "required",
			password: {
				equalTo: "#password1"
			}
		},
		messages: {
			descripton: "Please enter description",
			video: "Please enter video",
			email: "Please enter a valid email address",
			phone: "Please enter valid phone number",	
			country: "Please select country",
			gender: "Please select gender",
			dob: "Please fill this field",
			password1: "Password is required",
			password: {
				equalTo: "Password and confirm password should be same"
			}
		}
	});
});

$('#datepicker').datepicker({
  autoclose: true
})
</script>      

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.6/tinymce.min.js"></script>
<script>
tinymce.init({
selector: 'textarea',
plugins: [
"code", "charmap", "link"
],
toolbar: [
"undo redo | styleselect | bold italic | link | alignleft aligncenter alignright | charmap code" | "media"
]
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.previewHolder').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#profilePic").change(function() {
  readURL(this);
});
</script>