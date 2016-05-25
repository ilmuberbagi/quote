<div class="cleartop"></div>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
     <!--Sidebar content-->
		<ul class="nav nav-list affix-top">
			<li><a href="#semua">&raquo; Semua Quote</a></li>
			<li><a href="#user">&raquo; Users Quote</a></li>
			<li><a href="#anonym">&raquo; Anonymous</a></li>
		</ul>
    </div>
    <div class="span9">
      <!--Body content-->
		<h2 id="semua">» Kumpulan Quote Berbagi</h2>
		<table class="table table-bordered">
		<tr>
			<th>No.</th>
			<th>Quote</th>
			<th>Loves</th>
			<th>Like</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
		<?php if(!empty($quotes)){ $no=0; foreach ($quotes as $data){ $no++; 
			$s = array(
				0 => "<span class='badge' title='Landing'><i class='icon-remove'></i></span>",
				1 => "<span class='badge badge-success' title='Mengudara'><i class='icon-ok'></i></span>",
			);
		?>
		<tr>
			<td align="center"><?php echo $no.'.';?></td>
			<td><?php echo "<i class='icon-quote-left'></i> ".$data['isi']." <i class='icon-quote-right'></i><br/><code>".$data['first_name'].", "
				.date('d/M/Y H:i:s', strtotime($data['tanggal']))."</code>";?></td>
			<td align="center"><span class="badge badge-important"><?php echo count($love['_'.$data['qid']]);?></span></td>
			<td align="center"><span class="badge badge-success"><?php echo count($thumb['_'.$data['qid']]);?></span></td>
			<td><?php echo $s[$data['sts']];?></td>
			<td>							
				<div class="btn-group">
				  <a class="btn" href="#"><i class="icon-wrench icon-white"></i></a>
				  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="#modalDelete_<?php echo $data['qid'];?>" data-toggle="modal"><i class="icon-trash"></i> Delete</a></li>
					<?php if($data['sts'] == 1){?>
						<li><a href="#modalBan_<?php echo $data['qid'];?>" data-toggle="modal"><i class="icon-ban-circle"></i> Ban</a></li>
					<?php }else{?>
						<li><a href="#modalActive_<?php echo $data['qid'];?>" data-toggle="modal"><i class="icon-flag"></i> Publish</a></li>
					<?php } ?>
				  </ul>
				</div>
				<!-- Modal -->
				<div id="modalDelete_<?php echo $data['qid'];?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Delete Quote?</h3>
				  </div>
					<div class="modal-body">
						Anda yakin ingin menghapus Quote ini?<br/>
						Anda akan kehilangan <span class="badge badge-important"><?php echo count($love['_'.$data['qid']]);?> Loves</span> dan 
						<span class="badge badge-success"><?php echo count($thumb['_'.$data['qid']]);?> Jempol</span>
					</div>
					<?php echo form_open('removequotewm/'.$data['qid']);?>
					<div class="modal-footer">
						<button class="btn btn-danger">Hapus Saja</button>
						<button class="btn" data-dismiss="modal" aria-hidden="true">Jangan</button>
					</div>
					<?php echo form_close();?>
				</div>
				
				<!-- Modal -->
				<div id="modalBan_<?php echo $data['qid'];?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Banned/Block Quote?</h3>
				  </div>
					<div class="modal-body">
						Apakah Anda yakin Quote ini tidak layak untuk mengudara?<br/>
					</div>
					<?php echo form_open('blockquotewm/'.$data['qid']);?>
					<div class="modal-footer">
						<button class="btn btn-danger">Block Saja</button>
						<button class="btn" data-dismiss="modal" aria-hidden="true">Jangan</button>
					</div>
					<?php echo form_close();?>
				</div>
				
				<!-- Modal -->
				<div id="modalActive_<?php echo $data['qid'];?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Publish Quote?</h3>
				  </div>
					<div class="modal-body">
						Apakah Anda yakin Quote ini layak untuk mengudara?<br/>
					</div>
					<?php echo form_open('activequotewm/'.$data['qid']);?>
					<div class="modal-footer">
						<button class="btn btn-danger">Publish Saja</button>
						<button class="btn" data-dismiss="modal" aria-hidden="true">Jangan</button>
					</div>
					<?php echo form_close();?>
				</div>
				
			</td>
		</tr>
		<?php }} ?>
		</table>
		<?php echo $links;?>
	</div>
  </div>
</div>
<hr/>

