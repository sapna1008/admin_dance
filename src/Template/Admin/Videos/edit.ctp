 <section class="content-header">
    <h1>
    Video
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
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
                        <div class="loader" style="display:none;"></div>

              <div class="box-body">
              	<div class="form-group">
             
                
            <div class="form-group">
                  <label for="exampleInputEmail1">Instructor name</label>
                
                     <select name="instructor_id" class="form-control valid" id="instructor-id" aria-invalid="false">
                         <?php foreach($instructors as $key=>$val) { ?>
                         <option value="<?php echo $key;  ?>" <?php if($video->instructor_id == $key){ echo "selected"; } ?>><?php echo $val;  ?></option>
                         <?php  } ?>
                    </select>
                                
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Program</label>
                  <select name="program_id" id="program_id" class="form-control pro_option">
                    <option value="<?php echo $video->program_id['id']; ?>"><?php echo $video->program_id['name']; ?></option>
                  </select>
                </div>


                
                <div class="form-group">
                  <label for="exampleInputEmail1">Style Form</label>
                  <select name="style_id" id="styles" class="form-control no_option">
                    <option value="<?php echo $video->style_id['id']; ?>"><?php echo $video->style_id['name']; ?></option>
                  </select>
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
                      <video style="width: 20%;"><source src="<?php echo ($video->video != '') ? $this->request->webroot.'images/introductoryimages/'.$video->video : $this->request->webroot.'images/users/noimage.png'; ?>"/></video>
                    </div>
                    
                   <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false]); ?>
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
<style>
.loader {

    border: 16px solid #f3f3f3;

    border-top-color: rgb(243, 243, 243);
    border-top-style: solid;
    border-top-width: 16px;

border-radius: 77%;

border-top: 16px solid

    #3498db;
    width: 78px;
    height: 76px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    position: absolute;
    top: 36%;
    left: 40%;

}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<script>
        
$().ready(function() {
  $("#user-form").validate({
    rules: {
      instructor_id : "required",
      style_id: "required",
      program_id: "required",
      description: "required",

    },
    messages: {
      instructor_id : "Please select instructor name",
      style_id: "Please select any style",
      program_id: "Please select any program",
      descripton: "Please enter description",
    }
  });
});

</script>        
<script>

$("#instructor-id").on("change",function(){

var instructor_id = $(this).val();

$(".loader").show();


$.ajax({
            type: 'post',
            url: 'https://nancy.gangtask.com/dance/admin/videos/getStyles',
            data:'id='+instructor_id,
            success: function(response) 
            {
                $(".loader").hide();
                $(".pro_option").empty();
                $(".pro_option").append(response);
            }
        });



});


$("#program_id").on("change",function(){

var instructor_id = $("#instructor-id").val();
var program_id = $(this).val();

$(".loader").show();


$.ajax({
            type: 'post',
            url: 'https://nancy.gangtask.com/dance/admin/videos/getstylepro',
            data: { id:instructor_id,
                  pro_id: program_id
             },


            success: function(response) 
            {
                $(".loader").hide();
                $(".no_option").empty();
                $(".no_option").append(response);
            }
        });



});


  $('#profilePic').change(function (event) {
    var filePath = this.value;
    var allowedExtensions = /(\.mp4|\.docx|\.mpg)$/i;
     if(!allowedExtensions.exec(filePath)){
         document.getElementById('element2').innerHTML = 'Please upload file having extensions .mp4/.mpg';
        this.value = '';
        return false;
    }
    else
    {
        var file = URL.createObjectURL(event.target.files[0]);
       document.getElementById('element2').innerHTML = '<video width="20%;"><source src="' + file + '"></video>';
    }
});


</script>