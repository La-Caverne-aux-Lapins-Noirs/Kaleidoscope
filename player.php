<?php
if(isset($testeur) && $testeur == "lobo951")
	{
		if (isset($is_onsite))
			{
			 if ($is_onsite == 1)
				{
					$deport_url = "http://hiphopworldtube.com/worldplayer.swf";
					$wait_click = 1;
				}
			else
				{
					$deport_url = "worldplayer.swf";
					$wait_click = 0;
				}
			}
?><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" 
					codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" 
					width="100%" 
					height="550px" 
					id="worldPlayer" 
					align="middle"
			>
				<param 
					name="allowFullScreen" 
					value="true" 
				/>
				<param 
					name="allowScriptAccess" 
					value="sameDomain" 
				/>
				<param 
					name="movie" 
					value="<?php echo $deport_url; ?>?film=<?php echo "upload_vid/".hash("sha256", $tube_general_vision['id_video'].$tube_general_vision['sel'], false).".flv"; ?>&amp;mini=<?php urlencode("index.php?fichier=tube.php&amp;tube=".$tube_general_vision['id_video']); ?>&amp;maxi=<?php urlencode("tube_full.php?tube=".$tube_general_vision['id_video']); ?>&amp;wait_click=<?php echo $wait_click; ?>"
				/>
				<param 
					name="quality" 
					value="high" 
				/>
				<param 
					name="bgcolor" 
					value="#000000" 
				/>
				<embed 
					src="<?php echo $deport_url; ?>?film=<?php echo "upload_vid/".hash("sha256", $tube_general_vision['id_video'].$tube_general_vision['sel'], false).".flv"; ?>&amp;mini=<?php urlencode("index.php?fichier=tube.php&amp;tube=".$tube_general_vision['id_video']); ?>&amp;maxi=<?php urlencode("tube_full.php?tube=".$tube_general_vision['id_video']); ?>&amp;wait_click=<?php echo $wait_click; ?>" 
					id="worldPlayerembed"
					quality="high" 
					bgcolor="#000000"
					allowFullScreen="true"
					width="100%" 
					height="550px" 
					name="worldPlayer" 
					align="middle" 
					allowScriptAccess="sameDomain" 
					type="application/x-shockwave-flash" 
					pluginspage="http://www.macromedia.com/go/getflashplayer" 
				/>
			</object>
<?php
	}
?>