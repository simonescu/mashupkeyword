    <ul>

            <li>
            <ul>
<p>
<form method="post" action="<?php echo Router::url('/lawmakers/search'); ?>">
    <input type="hidden" name="_method" value="POST" />
    <input name="data[Search][query]" type="text" value="" class="query" id="Search" />
    <input type="submit" id="searchbtn" value="Search Profiles" />
</form>
</p>
<p></p>            
            </ul>
                <h3>Lobbyist @ Work</h3>
                <ul>
                    <li><a href="<?php echo Router::url('/lobbyists_filings'); ?>">Their Clients</a></li>
                </ul>

                <strong><em><?php echo $keyword; ?></em></strong> -
                random keyword men <?php echo number_format($wordused); ?> time(s) by Congress in 2008 <br/>
                
                <h3>MASH-it-UP</h3>
                
               <ul>
                    <li><img src="http://twitter.com/favicon.ico" class="favicon" width="12" /> <a href="<?php echo Router::url('/twitter/'. @urlencode($keyword)); ?>" title="Twitter Chatter">Twitter Post</a>  </li>
                    <li><img src="http://www.friendfeed.com/favicon.ico" class="favicon" width="12" /> <a href="<?php echo Router::url('/friendfeed/'. @urlencode($keyword)); ?>" title="Friend Feed">FriendFeed Chatter</a>  </li>
                    <li><img src="http://backtype.com/favicon.ico" class="favicon" width="12" /> <a href="<?php echo Router::url('/comments/'.@urlencode($keyword)); ?>" title="Comments: Blogs">User Comments</a>  </li>
                    <li><img src="http://www.technorati.com/favicon.ico" class="favicon" width="12" /> <a href="<?php echo Router::url('/technorati/'.@urlencode($keyword)); ?>" title="Blog Chatter">Blogs Chatter</a> </li>
                    <li><img src="http://www.flickr.com/favicon.ico" class="favicon" width="12" /> <a href="<?php echo Router::url('/flickr/'.@urlencode($keyword)); ?>" title="Images">Flickr Images</a>  </li>
                    <li><img src="http://youtube.com/favicon.ico" class="favicon" width="12" /> <a href="<?php echo Router::url('/youtube/'.@urlencode($keyword)); ?>" title="Videos">Youtube Videos</a>  </li>
                    <li><img src="http://www.google.com/favicon.ico" class="favicon" width="12" /> <a href="<?php echo Router::url('/news/'. @urlencode($keyword)); ?>" title="News">Google News</a> </li>
                    <li><img src="http://www.eventful.com/favicon.ico" class="favicon" width="12" /> <a href="<?php echo Router::url('/eventful/'.@urlencode($keyword)); ?>" title="Event">EventFul</a> </li>
                </ul>                
                <h2>About</h2>
                <ul>
                    <li><a href="<?php echo Router::url('/pages/about'); ?>">MASHUP::Keyword</a></li>
                </ul>
            </li>
        </ul>
        <div style="clear: both; height: 40px;">&nbsp;</div>

