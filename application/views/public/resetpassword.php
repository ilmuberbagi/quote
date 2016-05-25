<div class="cleartop"></div>
<div class="row" style="background:#F7F7F7">
	<div class="card" style="margin:5% 20% 5% 20%">
		<div class="card-heading image">
			<div class="card-heading simple">
				<h3>Reset Password</h3>
			</div>
		</div>
		<div class="card-body">
			<form class="form-horizontal" method="POST" action="<?php echo base_url().'login';?>">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
					  <input type="email" id="inputEmail" name="user" placeholder="Email" required>
					  <input type="submit" name="submit" class="btn btn-primary" value="Send Request">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<hr/>