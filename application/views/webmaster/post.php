<div class="cleartop"></div>
	<script type="text/javascript">
		function cekCilok(){
			var a = document.getElementById('siomay').value;
			var b = document.getElementById('cilok').value;
			if(b == a){
				return true;
			}else{
				alert('Helleh! Angka yang Anda masukkan salah!');
				document.getElementById('siomay').focus();
				return false;
			}
		}
		
	
	</script>
	
<div class="row" style="background:#F7F7F7">
	<div class="span5" style="float:none; margin:auto">
		<div class="card">
		  <?php echo form_open('simpanPost');?>
		   <div class="card-heading image">
				<?php if($this->session->userdata('logStatus') == 1){ 
					$name = $this->session->userdata('name'); 
					$id = $this->session->userdata('user_id'); 
				?>
					<img src="<?php echo base_url().'asset/img/members/'.$this->session->userdata('pp');?>" width="50" alt="">
					<div class="card-heading-header">
						<h3><b>Quote Please!</b></h3>
						<span>Anda akan <i>ngeQuote</i> sebagai <b><?php echo $this->session->userdata('name');?></b>.</span>
					</div>
				<?php }else{ $name = 'anonymous'; $id = 'anonymous@quoteberbagi.com'; ?>
					<img src="<?php echo base_url().'asset/img/logoQB.png';?>"  width="100" alt="">
					<div class="card-heading-header">
						<h3><b>Quote Please!</b></h3>
						<span>Anda akan <i>ngeQuote</i> sebagai <b>anonymous</b>.<br/>atau silakan <a href="<?php echo base_url().'login';?>">Login</a> untuk ngeQuote dengan akun Anda</span>
					</div>
				<?php } ?>
			</div>
		   <div class="card-body">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<input type="text" name="name" placeholder="Nama Anda" class="input-custom" value="<?php echo $name;?>" readonly>
				<textarea name="quote" rows="4" class="input-custom" placeholder="Quote Anda!"></textarea>
				<select name="group" class="input-custom-select">
					<option value="1">Wisdom</option>
					<option value="2">Spirit</option>
					<option value="3">Joke</option>
				</select>
				<div class="flabel">Angka keberuntungan Anda</div>
				
				<input type="text" name="a" id ="cilok" value="<?php $this->load->view('cilok');?>" disabled>
				<input type="text" class="input-custom" name ="b" id="siomay" placeholder="Masukkan angka diatas, Please!" required/>
		   </div>
		   <div class="card-actions">
			  <input type="submit" name="submit" class="btn btn-primary" value="Submit Quote" onclick="return cekCilok()">
			  <input type="reset" name="reset" class="btn" value="Cancel">
		   </div>
		  <?php echo form_close();?>
		</div>
	</div>
</div>

<div class="clear"></div>

<hr/>
