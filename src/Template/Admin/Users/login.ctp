<style type="text/css">
	.message.error{
		width: 50%;
		display: table;
		float: none;
		margin: 0 auto;
		padding: 10px 30px;
		color: #a94442;
                 background-color: #f2dede;
                 border-color: #ebccd1;
		font-size: 14px;
		font-family: arial; 
	}
	.users-login{
		width: 50%;
		float: none;
		display: table;
		margin: 0 auto;
		padding: 50px 30px 30px 30px;
		background: rgba(0,0,0,0.3);
		border-radius: 5px;
		margin-top:200px;
		color: #fff;
	}
	.users-login form{
		width: 100%;
		float: left;
		margin: 0;
	}
	.users-login form div[class*="input"]{
		width: 100%;
		float: left;
		margin-bottom: 15px;
	}
	.users-login form div[class*="input"] label{
		width: 100%;
		float: left;
		margin-bottom: 11px;
		font-size: 16px;
		font-family: arial;
	}
	.users-login form div[class*="input"] input[type="text"],
	.users-login form div[class*="input"] input[type="password"]{
		width: 96%;
		height: 40px;
		padding: 7px 11px;
		font-size: 14px;
		font-family: arial;
		color: #333;
		border:1px solid #ddd;
		border-radius:50px;
	}
	.users-login form button[type="submit"]{
		border: none;
		background: none;
		font-size: 16px;
		color: #fff;
		text-transform: uppercase;
		float: right;
		background: rgba(255, 255, 255, 0.5);
		padding: 14px 30px;
		border-radius: 50px;
		cursor: pointer;
		margin-top:15px;
	}
        .user_avtar img {
        width: 100%;
        height: 100%;
        }  
        .user_avtar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 1px solid #ddd;
    overflow: hidden;
    position: absolute;
    left: 0;
    right: 0;
    top: 103px;
    margin-left: auto;
    margin-right: auto;
}

 
</style>  
 <div class="col-sm-12">
             <div class="sign-flash">
              <?= $this->Flash->render() ?>   
              </div>
      </div>
<div class="users-login ">
  

     <div class="user_avtar">
         <img src="<?php echo $this->request->getAttribute("webroot");?>img/registration.png">
     </div>
     

    <?= $this->Form->create() ?>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
        ?>
		<?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
	
</div>
