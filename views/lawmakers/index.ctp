            
<div id="content">
    <div class="post">
        <div class="entry">
<div id="homepage_page">
<div id="homepage_right">
<h1> CongressSpacebook</h1>
<h2>...striving to make Congress more accountable and transparent...</h2>
<p>Here we're tracking each member's voting records, FEC reports, Campaign Finance summary, their opinions on the issues, and even their state's federal spending reports. </p>
<p>More to come...!</p>


<p><h3>Browse  <a href="<?php echo Router::url('/lawmakers/browse/house'); ?>" title="House">House</a> or <a href="<?php echo Router::url('/lawmakers/browse/senate'); ?>" title="Senate">Senate</a> member profiles</h3></p>
<p></p>
<h2>you may hear a congress person say...</h2>
<blockquote>
<p><strong>We</strong> have lawmaking power. The U.S. Constitution created <strong>us</strong> and named <strong>us</strong> the legislative branch - the branch with the power to write laws.</p>
<p> No laws can govern the nation unless <strong>we</strong> enacted them and have it approved by the President.</p>
</blockquote>
<p>
<h3>In the state of <?php echo $current_webuser->region; ?> the lawmakers are:</h3>
<p>
<?php
$i=0;
foreach ($current_congress as $current) {
    $fullname = $current['lawmaker']['firstname'].' '.$current['lawmaker']['lastname'];

?>
        <span><a class="url" rel="me" href="<?php echo Router::url('/profiles/'.$current['lawmaker']['username']); ?>" title="<?php echo $fullname;?>">
            <?php
                    $path_to_image = APP .'webroot' . DS .'img' . DS . 'lawmakers/40x50/'.$current['lawmaker']['bioguide_id'].'.jpg';
                    if(file_exists($path_to_image)) {
            ?>
        <img src="<?php echo Router::url('/img/lawmakers/40x50/'.$current['lawmaker']['bioguide_id'].'.jpg'); ?>" alt="" border="0" />
            <?php } else {  ?>
                <img src="<?php echo Router::url('/img/no_profile_img.jpg'); ?>" alt="" border="0" width="40" height="50"/>

            <?php } ?>
        </a></span>

<?php
    }
?>
</p>
<blockquote>
<strong>We</strong> have the "Power of the Purse." The Constitution grants <strong>us</strong> the power of the purse. Under Article 1 [section 8], <strong>we</strong> are given the power to tax and impose tariffs, duties, and other measures to collect revenue for the U.S. Treasury.
</blockquote>
</p>
</p>
<h3>Leaders of the 111th Congress</h3>
<p>
<?php
$i=0;
foreach ($leaders_congress as $leaders) {
    $fullname = $leaders['lawmaker']['firstname'].' '.$leaders['lawmaker']['lastname'];

?>
        <span><a class="url" rel="me" href="<?php echo Router::url('/profiles/'.$leaders['lawmaker']['username']); ?>" title="<?php echo $fullname;?>"><img src="<?php echo Router::url('/img/lawmakers/40x50/'.$leaders['lawmaker']['bioguide_id'].'.jpg'); ?>" alt="" border="0" /></a></span>

<?php
    }
?>
</p>
<blockquote>
<p> <strong>We</strong> are also given the authority to borrow money on credit on behalf of the United States. Article 1 [section 9, clause 7] of the U.S. Constitution, states no money can be appropriated [spent] out of the U.S. Treasury <strong>unless</strong> we Act. This means that governmental agencies and departments may not spend any money for their operations and programs that <strong>we</strong> have not appropriated nor use any federal money for any purpose that <strong>we</strong> have not expressly authorized...
</blockquote>
<?php
/*
        echo '<p>';
        echo '<strong>Federal Spending ' . $fedSpending->data->record->attributes()->description .': '. $current_webuser->region.' </strong><br/><br/>';
        echo 'Total Obligated Amount: $' . number_format($fedSpending->data->record->totals->total_ObligatedAmount, 2) . "<br/>";
        echo 'Rank Among states: ' . $fedSpending->data->record->totals->rank_among_states . "<br/>";
        echo 'Number of Contractors: ' . number_format($fedSpending->data->record->totals->number_of_contractors) . "<br/>";
        echo 'Number of Transactions: ' . number_format($fedSpending->data->record->totals->number_of_transactions) . "<br/>";
        echo '</p>';
        
        echo '<p>';
        echo '<strong>'.$fedSpending->data->record->top_known_congressional_districts->attributes()->description ."</strong><br/><br/>";
        foreach($fedSpending->data->record->top_known_congressional_districts->congressional_district as $_district) {
            echo $_district ."<br/>";
        }
        echo '</p>';

        echo '<p>';
        echo '<strong>Top products or services sold</strong>'."<br/><br/>";
        foreach($fedSpending->data->record->top_products_or_services_sold->product_or_service_category as $_prodsrv) {
            echo  $_prodsrv . "<br/>";
        }
        echo '</p>';

        echo '<p>';
        echo '<strong>Top contracting agencies</strong>'."<br/><br/>";
        foreach($fedSpending->data->record->top_contracting_agencies->agency as $_agency) {
            echo  $_agency . "<br/>";
        }
        echo '</p>';
        
        echo '<p>';
        echo '<strong>Top contractor parent companies</strong>'."<br/><br/>";
        foreach($fedSpending->data->record->top_contractor_parent_companies->contractor_parent_company as $_parent_comp) {
            echo  $_parent_comp . "<br/>";
        }
        echo '</p>';
        
        echo '<p>';
        echo '<strong>Total obligated amount in dollars by year</strong>'."<br/><br/>";
        $i=0;
        foreach($fedSpending->data->record->fiscal_years->fiscal_year as $_total_dollars) {
            echo 'Fical Year 200'.$i .': $'. number_format($_total_dollars) ."<br/>";
            $i++;
        }
        echo '</p>';

*/

?>
</p>

<!--
<h3>About..</h3>
-->
<p><strong> some of our members are <a href="<?php echo Router::url('/lawmakers_with_twitter_accounts'); ?>">using twitter</a></strong></p>
<p>
<?php
//$letters = range('a','z');
//foreach($letters as $letter) {
//    echo '<span style="padding:1px;font-size:16px;"><a href="'.Router::url('/lawmakers/browse/letter/'.strtoupper($letter)).'" title="'.strtoupper($letter).'"><strong>'.strtoupper($letter).'</a></strong></span>';
//}
?>
</p>


</div>

<div id="homepage_left">
<h2>You are from: <?php echo $current_webuser->region; ?> </h2>
<p><a style="hover:none;" href="<?php echo Router::url('/nearby/lawmakers'); ?>"><img src="<?php echo Router::url('/'); ?>img/states/<?php echo strtolower($current_webuser->region); ?>.png" alt="default" border="0" /></p></a>
<h3>Browse other states</h3>
<?php
    $max_size = 250; // max font size in %
    $min_size = 100; // min font size in %

    $max_qty = max(array_values($stateTagCloud));
    $min_qty = min(array_values($stateTagCloud));

    $spread = $max_qty - $min_qty;
    if (0 == $spread) { // we don't want to divide by zero
        $spread = 1;
    }

    $step = ($max_size - $min_size)/($spread);
    $i=0;
    foreach ($stateTagCloud as $key => $value) {
        $size = $min_size + (($value - $min_qty) * $step);
        echo '<a href="'.Router::url('/lawmakers/browse/state/'.$key).'" style="padding:2;font-size: '.$size.'%"';
        echo ' title="'.$value.' lawmakers in  '.$key.'"';
        echo '>'.$key.'</a> ';
        $i++;
    }

?>
<p></p>
<h3>Browse by party</h3> 
<p></p>
<p>
<?php
    $max_size = 250; // max font size in %
    $min_size = 100; // min font size in %

    $max_qty = max(array_values($partyTagCloud));
    $min_qty = min(array_values($partyTagCloud));

    $spread = $max_qty - $min_qty;
    if (0 == $spread) { // we don't want to divide by zero
        $spread = 1;
    }

    $step = ($max_size - $min_size)/($spread);
    $i=0;
    foreach ($partyTagCloud as $key => $value) {
        $size = $min_size + (($value - $min_qty) * $step);
        switch($key) {
            case 'D' :
                $key_str = 'Democratic';
                break;
            case 'R' :
                $key_str = 'Republican';
                break;
            case 'I' :
                $key_str = 'Independent';
            default :    
        }
        echo '<p><a href="'.Router::url('/lawmakers/browse/party/'.$key).'" style="padding:5px;font-size: '.$size.'%"';
        echo ' title="'.$value.' lawmakers in  '.$key.'"';
        echo '>'.$key_str.'</a></p> ';
        $i++;
    }

?>
</p>
<h3>.. or just <a href="<?php echo Router::url('/lawmakers/browse/'); ?>" title="Browse">Browse</a> them all.</h3>

</div> <!-- page_left -->
</div>
</p>
<p></p>
</div>
    </div>

</div>
        <div id="sidebar">
                <?php  echo $this->element('sidebar', array('keyword' => $keyword)); ?>
        </div>
</div>

