<div id="tl_buttons">
	<a href="<?php print $this->getReferer(ENCODE_AMPERSANDS); ?>" class="header_back" title="<?php print specialchars($GLOBALS['TL_LANG']['MSC']['backBT']); ?>">
		<?php print $GLOBALS['TL_LANG']['MSC']['backBT']; ?>
	</a>
</div>
<h2 class="sub_headline"><?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['sync'][0]; ?></h2>

<form action="<?php print ampersand($this->Environment->request, ENCODE_AMPERSANDS); ?>" id="tl_catalog_openimmo_sync" class="tl_form" method="post">
	<div class="tl_formbody_edit">
		<input type="hidden" name="FORM_SUBMIT" value="tl_catalog_openimmo_sync" />
		<div class="tl_tbox">
			<p style="line-height:16px; padding-top:6px;">
				<?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncConfirm']; ?>
			</p>
			<p><?php print $messages; ?></p>
			<?php if(!$this->send): ?>
				<?php if($this->files): ?>
				<table>
					<thead>
						<th></th>
						<th><?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncStatus']; ?></th>
						<th><?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncFile']; ?></th>
						<th><?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['fileTime']; ?></th>
						<th><?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['fileSize']; ?></th>
						<th><?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncTime']; ?></th>
						<th><?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncUser']; ?></th>
					</thead>
					<tbody>
					<?php foreach($this->files as $i => $file): ?>
						<tr class="status-<?php print $file['status']; ?><?php print($i%2==1)?'':' odd'; ?>">
							<td><input type="radio" name="tl_catalog_openimmo_sync_file" value="<?php print $file['file']; ?>" <?php print($file['checked'])?'checked="checked"':'';?>/></td>
							<td><div class="status-icon status-<?php print $file['status']; ?>"></div></td>
							<td><?php print $file['file']; ?></td>
							<td><?php print date('H:i:s d.m.Y',$file['time']); ?></td>
							<td><?php
							if($file['size']<1024) {
								print $file['size'].' Bytes';
							} elseif($file['size']>1024 && $file['size']<(1048576)) {
								print (round(($file['size']/1024)*10)/10)." KB";
							} elseif($file['size']>(1048576)) {
								print (round(($file['size']/1048576)*10)/10)." MB";
							}?></td>
							<td><?php print ($file['synctime']>0)?date('H:i:s d.m.Y',$file['synctime']):''; ?></td>
							<td><?php print $file['user']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php else: ?>
				<p class='tl_error'><?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['no_sync_files_found']; ?></p>
				<?php endif;?>
			<?php elseif($this->send): ?>
				<input type="hidden" name="tl_catalog_openimmo_sync_file" value="<?php print $this->sync_file; ?>" />
				<?php if($this->zip_unpacked==1): ?>
					<p class="tl_confirm"><?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncFileUnpacked']; ?></p>
					<input type="hidden" name="tl_catalog_openimmo_zip_unpacked" value="2">
				<?php else: ?>
				<?php if($this->success): ?>
					<p class="tl_confirm"><?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncSuccess']; ?></p>
					<?php else: ?>
					<p class="tl_error"><?php print $GLOBALS['TL_LANG']['tl_catalog_openimmo']['syncErrors'][$this->error]; ?></p>
				<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php if(!$this->send || $this->zip_unpacked==1): ?>
	<div class="tl_formbody_submit">
		<div class="tl_submit_container">
			<input type="submit" name="save" id="save" class="tl_submit" alt="regenerate dca" accesskey="s" value="<?php print specialchars($GLOBALS['TL_LANG']['tl_catalog_openimmo']['sync'][0]); ?>" />
		</div>
	</div>
	<?php endif; ?>
</form>