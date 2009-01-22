<h2>Sponsored Bills</h2>
<p>
<?php
foreach($govtrack_results->SponsoredBills->Bill as $bill) {
    $_url_param = $bill->attributes()->Session .'-'.$bill->attributes()->Type.'-'.$bill->attributes()->Number;

    echo '<p><strong><a class="url" rel="me" href="'.Router::url('/').'profiles/'.$username.'/bill/'.$_url_param .'">'. $bill->attributes()->Session . ' ' . $bill->attributes()->Type . '' .$bill->attributes()->Number .'</a> ('. $bill->Status .')</strong></p>';
    echo '<p>' . $bill->OfficialTitle . '</p>';
}
?>
</p>
<h2>Co-Sponsored Bills</h2>
<p>
<?php
foreach($govtrack_results->CosponsoredBills->Bill as $bill) {
    echo '<p><strong><a class="url" rel="me" href="'.Router::url('/').'profiles/'.$username.'/bill/'.$_url_param .'">' . $bill->attributes()->Session . ' ' . $bill->attributes()->Type . '    ' .$bill->attributes()->Number .'</a> ('.$bill->Status.')</strong></p>';
    echo '<p>' . $bill->OfficialTitle . '</p>';
}
?>
</p>
<p><span>source: <a href="http://govtrack.us/" title="Govtrack.us" target="_new">Govtrack.us</a></span></p>

</div>
</div>
