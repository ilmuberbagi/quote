<div class="cleartop"></div>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
     <!--Sidebar content-->
		<ul class="nav nav-list affix-top">
			<li><a href="#semua">&raquo; Semua Users</a></li>
			<li><a href="#verified">&raquo; Terverifikasi</a></li>
			<li><a href="#pending">&raquo; Pending</a></li>
		</ul>
    </div>
    <div class="span9">
      <!--Body content-->
		<h2 id="semua">» User Quote Berbagi</h2>
		<table class="table table-bordered">
		<tr>
			<th>No.</th>
			<th>Full Name</th>
			<th>Email</th>
			<th>Gender</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
		<?php if(!empty($users)){ $no=0; foreach ($users as $data){ $no++;
			$s = array(
				1 => "<span class='badge badge-inverse' title='Cowok'><i class='icon-male'></i></span>",
				0 => "<span class='badge' title='Cewek'><i class='icon-female'></i></span>",
			);
			$a = array(
				1 => "<span class='badge badge-success' title='On Air'><i class='icon-ok'></i></span>",
				0 => "<span class='badge' title='Pending'><i class='icon-ban-circle'></i></span>",
			);
		?>
		<tr>
			<td align="center"><?php echo $no.'.';?></td>
			<td><?php echo $data['first_name'].' '.$data['last_name'].'<br/><code>'.date('d/M/Y H:i:s', strtotime($data['date_reg'])).'</code>';?></td>
			<td><?php echo $data['email'];?></td>
			<td><?php echo $s[$data['gender']];?></td>
			<td><?php echo $a[$data['status']];?></td>
			<td>
				<div class="btn-group">
				  <a class="btn" href="#"><i class="icon-cogs icon-white"></i></a>
				  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="#modalDelete_<?php echo md5($data['email']);?>" data-toggle="modal"><i class="icon-trash"></i> Delete</a></li>
					<?php if($data['status'] == 1){?>
						<li><a href="#modalBan_<?php echo md5($data['email']);?>" data-toggle="modal"><i class="icon-ban-circle"></i> Ban</a></li>
					<?php }else{?>
						<li><a href="#modalActive_<?php echo md5($data['email']);?>" data-toggle="modal"><i class="icon-check"></i> Aktifkan</a></li>
					<?php } ?>
				  </ul>
				</div>			
				<!-- Modal -->
				<div id="modalDelete_<?php echo md5($data['email']);?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Delete Quote?</h3>
				  </div>
					<div class="modal-body">
						Anda yakin ingin menghapus User ini?
					</div>
					<?php echo form_open('deleteuser/'.md5($data['email']));?>
					<div class="modal-footer">
						<button class="btn btn-danger">Hapus Saja</button>
						<button class="btn" data-dismiss="modal" aria-hidden="true">Jangan</button>
					</div>
					<?php echo form_close();?>
				</div>
				
				<!-- Modal -->
				<div id="modalBan_<?php echo md5($data['email']);?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Banned/Block Quote?</h3>
				  </div>
					<div class="modal-body">
						Apakah Anda yakin ingin mengeBlock user ini?<br/>
					</div>
					<?php echo form_open('blockuser/'.md5($data['email']));?>
					<div class="modal-footer">
						<button class="btn btn-danger">Block Saja</button>
						<button class="btn" data-dismiss="modal" aria-hidden="true">Jangan</button>
					</div>
					<?php echo form_close();?>
				</div>
				
				<!-- Modal -->
				<div id="modalActive_<?php echo md5($data['email']);?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Aktifkan User?</h3>
				  </div>
					<div class="modal-body">
						Apakah Anda yakin user ini layak untuk menginspirasi?<br/>
					</div>
					<?php echo form_open('activateuser/'.md5($data['email']));?>
					<div class="modal-footer">
						<button class="btn btn-success">Layakan Saja</button>
						<button class="btn" data-dismiss="modal" aria-hidden="true">Jangan</button>
					</div>
					<?php echo form_close();?>
				</div>			</td>
		</tr>
		<?php }} ?>
		</table>
		<?php echo $links;?>
	</div>
  </div>
</div>
<hr/>

