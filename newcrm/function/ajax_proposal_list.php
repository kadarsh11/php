<?php
include("./function.php");
if($_GET['cid'])
{
	$customer_id=$_GET['cid'];
	$proposal_sql=sqlfetch("Select * FROM proposal WHERE cid='$customer_id' order by id desc");
							if(count($proposal_sql))
								foreach($proposal_sql as $proposal_data)
								{ ?>	
							<tr>
								<td><?=$proposal_data['date'];?></td>
								<td><a target="_blank" href="<?=SITE_URL?>proposal_detail.php?pid=<?=$proposal_data['id'];?>"><i class="fa fa-eye"></i></a></td>
							</tr>
								<?php
								}
							exit();
}
else
	echo 'Invalid Request';
exit();