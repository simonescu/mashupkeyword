<div id="content">
    <div class="post">
        <div class="entry">

<div style="padding-left:90px;" class="lawmakers index">
<h2><?php __('Lawmakers in this region: ' .$current_webuser->region);?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% lawmakers out of %count% total', true)
));
?></p>
<p>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
</p>
<p></p>
<table cellpadding="0" cellspacing="5">
<?php
$i = 0;
foreach ($lawmakers as $lawmaker):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
    $keyword = $lawmaker['Lawmaker']['firstname'] . ' ' .$lawmaker['Lawmaker']['lastname'];
?>
	<tr<?php echo $class;?>>
        <td valign="top">
        <span><a href="<?php echo Router::url('/profiles/'.$lawmaker['Lawmaker']['username']); ?>"><img src="<?php echo Router::url('/img/lawmakers/100x125/'.$lawmaker['Lawmaker']['bioguide_id'].'.jpg'); ?>" alt="" border="0" /></a></span>
        </td>
		<td>
			<?php echo $lawmaker['Lawmaker']['firstname']; ?>
			<?php echo $lawmaker['Lawmaker']['lastname']; ?>
			[<?php echo $lawmaker['Lawmaker']['party']; ?>-
			<?php echo $lawmaker['Lawmaker']['state']; ?>] <br/>
            Office: <?php echo $lawmaker['Lawmaker']['congress_office']; ?><br/>
            Phone:  <?php echo $lawmaker['Lawmaker']['phone']; ?><br/>
            Email: <?php echo $lawmaker['Lawmaker']['email']; ?><br/>
            <p>mashup: 
            <span><a href="<?php echo Router::url('/news/'. @urlencode($keyword)); ?>" title="Latest News"> news</a> </span>
            <span><a href="<?php echo Router::url('/technorati/'.@urlencode($keyword)); ?>" title="Blog Chatter">blogs</a> </span>
            <span><a href="<?php echo Router::url('/comments/'.@urlencode($keyword)); ?>" title="Comments: Blogs">comments</a>  </span>
            <?php if(!empty($lawmaker['Lawmaker']['lastname'])) { ?>
            <span><a href="<?php echo Router::url('/social_stream/user/'.@urlencode($keyword)); ?>" title="Comments: Blogs">comments</a>  </span>
            <?php
            $url = "http://www.govtrack.us/congress/person_api.xpd?id=".$lawmaker['Lawmaker']['govtrack_id'];
            //fixme: supressing this for now
            $response = @file_get_contents($url);
            ?><br/>
            Biographical Information <a href="http://bioguide.congress.gov/scripts/biodisplay.pl?index=<?php echo $lawmaker['Lawmaker']['bioguide_id']; ?>" target="_new">
about</a><br/>
            Voting: <a href="http://votesmart.org/voting_category.php?can_id=<?php echo $lawmaker['Lawmaker']['votesmart_id']; ?>" target="_new">record</a><br/>
            Campaign Finance/Money : <a href="http://www.opensecrets.org/politicians/summary.php?cid=<?php echo $lawmaker['Lawmaker']['crp_id']; ?>" target="_new">summary
</a><br/>
            FEC Candidate Summary : <a href="http://query.nictusa.com/cgi-bin/cancomsrs/?_08+<?php echo $lawmaker['Lawmaker']['fec_id']; ?>" target="_new">reports</a><br/
>
            <?php if(isset($congresspedia_name)) { ?>
                Congresspedia URL: <a href="http://www.sourcewatch.org/index.php?title=<?php echo $congresspedia_name; ?>" target="_new"><?php echo $congresspedia_name; ?></a><br/>

                <?php if(preg_match('/House/',$lawmaker['Lawmaker']['congress_office'])) { ?>
                    On the issues: <a href="http://senate.ontheissues.org/House/<?php echo $congresspedia_name; ?>.htm" target="_new">history</a>
                <?php }  else  {?>
                    On the issues: <a href="http://senate.ontheissues.org/Senate/<?php echo $congresspedia_name; ?>.htm" target="_new">history</a>
                <?php } ?>
            <?php } ?>

            <?php } ?>
            </p>
        <br/>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<p>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
</p>
<p></p>
<p>Powered by:<a href="http://services.sunlightlabs.com/api/" target="_new">Sunlight Labs API</a> data feed.</p>
</div>
</div>
    </div>
</div>
        <div id="sidebar">
                <?php  echo $this->element('sidebar', array('keyword' => $keyword)); ?>
        </div>

