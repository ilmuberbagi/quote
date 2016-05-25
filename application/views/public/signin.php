<div class="cleartop"></div>
<div class="row" style="background:#F7F7F7">
	<div class="card" style="margin:5% 20% 5% 20%">
		<div class="card-heading image">
			<div class="card-heading simple">
				<h3>Login</h3>
				<?php if($this->session->flashdata('msg') == 1){?>
				<div class="alert alert-block mini">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <?php echo validation_errors();?>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="card-body">
			<form class="form-horizontal" method="POST" action="<?php echo base_url().'login';?>">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
					  <input type="text" id="inputEmail" name="user" placeholder="Username atau Email" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Password</label>
					<div class="controls">
					  <input type="password" id="inputPassword" name="password" placeholder="Password" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
					  <a href="<?php echo $this->config->item('portal').'register';?>">Buat Akun</a> | 
					  <a href="<?php echo $this->config->item('portal').'reset';?>">Reset Password?</a>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
					  <input type="submit" name="submit" class="btn btn-primary" value="Login">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<hr/>