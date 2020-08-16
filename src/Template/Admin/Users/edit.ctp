<section class="content-header">
    <h1>
    Users
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li class="active">Edit User</li>
    </ol>
</section>

<section class="content">
  <div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit User <strong>(ID: <?php echo $user->id; ?>)</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($user, ['id' => 'user-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
            <div class="col-lg-12">
                <div class="form-group">
             
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <?php echo $this->Form->control('image', ['id' => 'profilePic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>   
                <img src="<?php echo ($user->image != '') ? $this->request->webroot.'images/users/'.$user->image : $this->request->webroot.'images/users/noimage.png'; ?>" class="previewHolder" style="width: 135px;"/>             
              </div>
            </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label for="exampleInputname">Name</label>
                  <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <?php
                   if($user['role'] == 'user')
                   {
                   echo $this->Form->control('email', ['class' => 'form-control', 'label' => false, 'disabled' => 'disabled']);

                   }
                   else
                   {
                       echo $this->Form->control('email', ['class' => 'form-control', 'label' => false]);

                   }
                   ?>
              </div>
                </div> 
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone</label>
                  <?php

                  if($user['role'] == 'user')
                  {
                    echo $this->Form->control('phone', ['class' => 'form-control', 'disabled' => 'disabled' ,'label' => false,'autocomplete'=>'off','id' =>'telephone']);
                  }
                  else
                  {
                    echo $this->Form->control('phone', ['class' => 'form-control' ,'label' => false]);
                  }

                  ?>
                </div>
                </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">

                 <div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select name="gender" class="form-control">
                    <option value="male" <?php if($user->gender=='male'){ echo "selected"; }?>>Male</option>
                    <option value="female" <?php if($user->gender=='female'){ echo "selected"; }?>>Female</option>
                    <option value="female" <?php if($user->gender=='other'){ echo "selected"; }?>>Other</option>
                  </select>
                </div>
                  </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Age</label>
                  <?php echo $this->Form->control('age', ['class' => 'form-control', 'min'=> 0 , 'label' => false,'type'=>'number']); ?>
                </div>
                
                </div>
              <!-- /.box-body -->

               <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success', 'style' => 'margin-left: 8px']) ?>
                <?php
                if($user['role'] == 'admin')
                  {
               echo  $this->Html->link(__('Change password'), ['action' => 'changepassword',$user->id], ['class' => 'btn btn-warning']);
               }
                ?>
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
    
    
    
$().ready(function() {
  $("#user-form").validate({
    rules: {
      name: {
          required: true
                },
      phone: {
        required: true,
      },
      gender: {
        required: true
      },
      age:
      {
        required: true,
        digits: true
      }
    },
    messages: {
      name: {
             required :"Please enter your name"
            },
      phone: "Please enter valid phone number", 
      country: "Please select country",
      gender: "Please select gender"
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