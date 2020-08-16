<section class="content-header">
    <h1>
    Instructors
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Edit Instructor</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Instructor <strong>(ID: <?php echo $instructor->id; ?>)</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($instructor, ['id' => 'instructor-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
              	<div class="form-group">
             
                
                <div class="form-group">
                  <label for="exampleInputname">Name</label>
                  <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <?php echo $this->Form->control('email', ['class' => 'form-control', 'label' => false]); ?>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone</label>
                  <?php echo $this->Form->control('phone', ['id'=>'phone','class' => 'form-control','label' => false,'autocomplete'=>'off','maxlength'=>15]); ?>    
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select name="gender" class="form-control">
                    <option value="male" <?php if($instructor->gender=='male'){ echo "selected"; }?>>Male</option>
                    <option value="female" <?php if($instructor->gender=='female'){ echo "selected"; }?>>Female</option>
                    <option value="female" <?php if($instructor->gender=='other'){ echo "selected"; }?>>Other</option>
                  </select>
                </div>
                <?php

                $style_arr =array();

                foreach($instructor['instructorstyles'] as $inst)
                {

                $style_arr[] = $inst['styles']['id'];


                }
                ?>

                  <div class="form-group">
                  <label for="exampleInputEmail1">Choose Styles</label>
                  <select class="form-control select2" multiple="multiple" name="style_id[]" data-placeholder="Select Style" required>
                   <?php foreach($styles as $style)
                   {
                      ?>
                      <option value="<?php echo $style['id']; ?>" <?php if(in_array($style['id'],$style_arr)){ echo "selected";} ?>><?php echo $style['style']; ?></option>  
                  <?php
                   }
                     ?>
                     </select>
                </div>

                
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Age</label>
                  <?php echo $this->Form->control('age', ['class' => 'form-control', 'min'=> 0 , 'label' => false,'type'=>'number']); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <?php echo $this->Form->control('image', ['id' => 'profilePic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>   
                <img src="<?php echo ($instructor->image != '') ? $this->request->webroot.'images/introductoryimages/'.$instructor->image : $this->request->webroot.'images/introductoryimages/noimage.png'; ?>" class="previewHolder" style="width: 135px;"/>  
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.2/js/intlTelInput.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.2/js/utils.js"></script> 
<script>
 
var input = document.querySelector("#phone");
window.intlTelInput(input, {
  nationalMode: false,
  defaultCountry: "us",    
  preferredCountries: ["us"],
  hiddenInput: "phone",
  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.2/js/utils.js" // just for formatting/placeholders etc
});  
</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script>
 
$('.select2').select2();    

</script>
<script>  
$().ready(function() {
	$("#instructor-form").validate({
		rules: {
			name: "required", 
			phone: {
				required: true
			},

      style:{
      required: true
      }
			country: {
				required: true
			},
			gender: {
				required: true
			},
      image:
      {
        required: true
      }
		},
		messages: {
			name: "Please enter your name",
      phone: "Please enter valid phone number",	
      style: "Please choose styles", 
      gender: "Please select gender",
      image: "Please upload image",
		}
	});
});

</script>

<script>
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