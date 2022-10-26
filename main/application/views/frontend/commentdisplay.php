 
 <?php 
	foreach($comments as $item) {
		$extra_class = "";
		for ($i = 1; $i < $item['level']; $i++) {
			$extra_class .= "child";
		}
		if ($item['reply_admin_id'] && $item['reply_admin_id'] != '') { 
			$this->load->model('adminsmodel');$admin_data = $this->adminsmodel->read(array('id'=>$item['reply_admin_id']),array(),true);
			$item['name'] = @$admin_data->name;
		}
	?>
 <li class="box <?=$extra_class;?> d-flex">
	<div class="fleft"><img src="<?php if (@$admin_data->avatar && @$admin_data->avatar != '' && ($item['reply_admin_id'] == @$admin_data->id)) {echo base_url($admin_data->avatar);} else {echo base_url('assets/img/default-avatar.png');}?>" class="com_img"></div>
	<div class="fright">
		<span class="com_name"> <?php echo $item['name']; ?></span> <span class="datetime"> - <?php echo date_format(date_create($item['create_time']),"d/m/Y"); ?></span> <br />
		<?php // if (($this->session->userdata('admingroup') == 'admin')){?>
		<?php // } ?>
		<span> <?php echo $item['comment']; ?></span>
		<span class="attachment">
			<?php if (@$item['attachment'] != '') {
			foreach (json_decode($item['attachment']) as $i) {?>
			<a href="<?=base_url($i)?>" class="fancy-img"><img src="<?=base_url($i)?>" style="height:48px;width: auto"></a>
			<?php }} ?>
		</span>
	</div>
</li>
<?php } ?>