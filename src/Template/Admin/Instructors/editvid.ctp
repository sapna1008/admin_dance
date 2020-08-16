<section class="content-header">
    <h1>
    Video
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Video</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Video <strong>(ID: <?php echo $video['id']; ?>)</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($video, ['id' => 'user-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
              	<div class="form-group">
             
                
            <div class="form-group">
                  <label for="exampleInputEmail1">Instructor name</label>
                 <div class="input select">
                     <select name="instructor_id" class="form-control valid" id="instructor_id" aria-invalid="false">
                         <?php foreach($instructors as $key=>$val) { ?>
                         <option value="<?php echo $key;  ?>" <?php if($video->instructor_id == $key){ echo "selected"; } ?>><?php echo $val;  ?></option>
                         <?php  } ?>
                    </select>
                     </div>              
                </div>
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Level</label>
                  <select name="level" class="form-control">
                    <option value="beginner" <?php if($video->level=='beginner'){ echo "selected"; }?>>Beginner</option>
                    <option value="intermediate" <?php if($video->level=='intermediate'){ echo "selected"; }?>>Intermediate</option>
                    <option value="expert" <?php if($video->level=='expert'){ echo "selected"; }?>>Expert</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Set count of video</label>
                   <select name="count" class="form-control valid" id="count" aria-invalid="false">
                         <?php foreach($count as $key=>$val) { ?>
                         <option value="<?php echo $val;  ?>" <?php if($video->count == $val){ echo "selected"; } ?>><?php echo $val;  ?></option>
                         <?php  } ?>
                    </select>
                    
                    <!--<select class = "form-control" name="count" id="count">-->
                    <!--  <option value="1" <?php if($video->count =='1'){ echo "selected"; }?>>1</option>-->
                    <!--    <?php foreach($count as $count=>$val) { ?>-->
                    <!--     <option value="<?php echo $key;  ?>" <?php if($video->count == $key){ echo "selected"; } ?>><?php echo $val;  ?></option>-->
                    <!--     <?php  } ?>-->
                    <!--</select> -->
                      </div>
                      
                    <div class="form-group">
                      <label for="exampleInputEmail1">Video</label>
                      <?php echo $this->Form->control('video', ['id' => 'profilePic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                    </div>
                    
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
	$("#instructor-form").validate({
		rules: {
			video: "required", 
			description: "required",
			phone: {
				required: true,
				//digits: true
			},
			country: {
				required: true
			},
			gender: {
				required: true
			}
		},
		messages: {
			video: "Required",
			description: "Required",
			phone: "Please enter valid phone number",	
			country: "Please select country",
			gender: "Please select gender"
		}
	});
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