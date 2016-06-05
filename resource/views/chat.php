	
	<div class="chatBox des_showBox" role="dialog"></div>
	
	<div class="chlistBox des_showBox" role="dialog">
		<div bgcolor="#F0F0F0" >
					<DIV id="smiles" style="visibility: hidden; top:0; position:absolute;"></DIV>
					<center id="head" style="visibility: visible;">
					
						<table style="width: 200px" cellspacing="0" cellpadding="0"> <tr> 
							<td style="width: 5%"><img src="/img/desing/chlist/0.png" onclick="show_srt_wth()" style="cursor:pointer"></td> 
							<td style="width: 80%" id="head2" align="center"><img src="/img/desing/chlist/r.gif" onclick="chlist.update();" style="cursor:pointer"></td> 
							<td style="text-align: right; width: 5%"><img src="/img/desing/chlist/01.png" onclick="location='/weather.php?a=1&'+MYrand()+'" style="cursor:pointer"></td> 
						</tr> </table>
					
					</center>
					
					<div id="chlist_list" style="width:100%;">&nbsp;</div>
					
					<div style="position:absolute; left:0px; top:0px; z-index: 2; width:80 ; height:40; display:none;" class="menu" id="description"></div>
					<div id=menu class="menu"></div>
					<TEXTAREA id=cpnick style="display:none;"></TEXTAREA>
					
		</div>
	</div>