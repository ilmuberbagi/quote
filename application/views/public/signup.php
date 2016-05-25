<script>
	function cekPass(){
		var a = document.getElementById('password').value;
		var b = document.getElementById('repassword').value;
		if(b == a){
			return true;
		}else{
			alert('Anda harus mengetikan ulang password!');
			document.getElementById('repassword').focus();
			return false;
		}
	}
</script>
<div class="cleartop"></div>
<div class="row" style="background:#F7F7F7">
	<div class="card" style="margin:5% 20% 5% 20%">
		<div class="card-heading image">
			<div class="card-heading simple">
				<h3>Sign Up</h3>
				
			</div>
		</div>
		<div class="card-body">
			<form class="form-horizontal" method="POST" action="<?php echo base_url().'simpanAkun';?>">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email *</label>
					<div class="controls">
					  <input type="email" id="inputEmail" name="email" placeholder="Email" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputFname">Nama Depan *</label>
					<div class="controls">
					  <input type="text" id="fname" name="fname" placeholder="Nama Depan" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputLname">Nama Belakang</label>
					<div class="controls">
					  <input type="text" id="lname" name="lname" placeholder="Nama Belakang" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputLname">Website</label>
					<div class="controls">
					  <input type="text" id="website" name="website" placeholder="Website/Blog">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputgender" placeholder="Gender">Jenis Kelamin</label>
					<div class="controls">
					  <select name="gender">
						<option value="1">Pria</option>
						<option value="0">Wanita</option>
					  </select>
					</div>
				</div>
				<hr/>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Password *</label>
					<div class="controls">
					  <input type="password" id="password" name="password" placeholder="Password" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputRepassword">Ulangi Password *</label>
					<div class="controls">
					  <input type="password" id="repassword" name="repassword" placeholder="Password" onchange="return cekPass()" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
					</div>
				</div>
				<hr/>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Quote Pertama Anda</label>
					<div class="controls">
					  <textarea name="quote" class="input-xlarge" id="quote"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
					  <input type="submit" name="submit" class="btn btn-primary" value="Buat Akun">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<hr/>