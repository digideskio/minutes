<?php $TOP_DIR='..'; include '../header.inc'; ?>

<!-- ==== HEADER -->
<section class="light-bg">
  <div class="container">
    <h1>TELECONFERENCES</h1>
    <hr>
    <p>
All Credentials Community Group teleconferences are open to the public. Anyone 
may join and participate. All calls are announced at least 24 hours in 
advance on the 
<a href="http://lists.w3.org/Archives/Public/public-credentials/">Credentials Community Group mailing list</a>.
    </p>
  </div><!-- container -->
</section>

<!-- ==== JOINING THE CALLS ==== -->
<section class="light-bg">
<div class="container" id="join">
    <h1 class="centered">JOINING THE CALLS</h1>
    <p>
The Credentials Community Group meets most Tuesdays to discuss Credentials strategy 
and technical issues related to the specifications. A typical meeting will have 
an agenda that is posted to the 
<a href="http://lists.w3.org/Archives/Public/public-credentials/">mailing list</a> 
at least 24 hours prior to the call. There are no costs associated with joining 
the group or limitations on who may join the teleconference as long as they 
agree to the 
<a href="http://www.w3.org/community/about/agreements/cla/">contribution agreement</a>.
    <p>
<strong><span class="icon icon-calendar"></span> Next Meeting</strong>: 
<?php
if(date('l', strtotime('today')) === 'Tuesday')
{
   print date('l, F jS (Y-m-d)', strtotime('today'));
}
else
{
   print date('l, F jS (Y-m-d)', strtotime('next Tuesday'));
}
?><br>
<strong><span class="icon icon-clock"></span> Time</strong>: 
1600 UTC / 8am San Francisco / 11am Boston / 4pm London<br>

<strong><span class="icon icon-mobile"></span> SIP</strong>: 
<a href="sip:credentials@opencreds.org">credentials@opencreds.org</a> (Windows / Mac OSX: use <a href="http://icanblink.com/">Blink</a>, Linux: use <a href="http://www.linphone.org/">Linphone</a>)<br>

<strong><span class="icon icon-phone-3"></span> Phone</strong>: 
<a href="tel:+15409614469;postd=p6304">+1.540.961.4469 x6304</a><br>

<strong><span class="icon icon-bubble"></span> IRC</strong>: 
<a href="irc://freenode.net/#credentials">irc://freenode.net/#credentials</a> (connect via <a href="http://webchat.freenode.net/?channels=#credentials">Web IRC</a>)<br>

<strong><span class="icon icon-alarm"></span> Duration</strong>: 
60 minutes
      </p>
      <p>
Make sure you have a good headset with a microphone as any background noise 
is distracting to others during the call. If there is excessive noise on your 
connection, you will be muted until you need to speak. If you cannot get SIP 
to work for you, there is an emergency dial-in number. If you use this number 
regularly, you will be expected to reimburse the group for call charges. 
SIP is free for both the caller and the callee - use it. Emergency dial-in 
number: <a href="tel:+15409614469;postd=p6304">+1.540.961.4469 x6304</a>
      </p>
    </div><!-- col-lg-6 -->
  </div><!-- row -->
</div><!-- container -->
</section>

<!-- ==== MEETINGS ARCHIVES ==== -->
<section class="light-bg">
<div class="container" id="archives">
  <div class="row white">
    <h1 class="centered"><span class="icon icon-safe"></span><br/> MEETING ARCHIVES</h1>
    <hr>
    <div class="col-lg-offset-1 col-lg-10">
      <p>
Audio and text logs of all Credentials Community Group calls are archived to 
help inform those that can't attend a particular call and to ensure 
transparency throughout the entire design and development process.
      </p>
<?php
// Generate the minutes summary cache
$mscfilename = "minutes-summary-cache.html";
$mtime = filemtime($mscfilename);

// refresh the cache on demand, every hour
$mcache = fopen($mscfilename, "c+");
if(!file_exists($mscfilename) or ((time() - $mtime) > 0)) // 3600
{
   $allMinutes = array_reverse(scandir('.'));
   foreach($allMinutes as $minutes)
   {
      if(preg_match("/201[0-9]-[0-9]{2,2}-[0-9]{2,2}/", $minutes))
      {
         fwrite($mcache, "<h3><a href=\"$minutes/\">Text and Audio Minutes for $minutes</a></h3>\n");

         // open the IRC log file
         $irclogfilename = $minutes . "/irc.log";
         $irclog = file($irclogfilename, 
            FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
         $topic = 1;

         // process the raw IRC log and output the topics
         fwrite($mcache, "      <ol>\n");
         foreach($irclog as $line_num => $line)
         {
            if(preg_match("/.*Topic: (.*)/", $line, $matches))
            {
               // link to each topic in the HTML minutes
               fwrite($mcache, 
                  "         <li>" .
                  htmlspecialchars($matches[1]) . 
                  " [<a href=\"$minutes/#topic-$topic\">" .
                  "permalink</a>]</li>\n");
               $topic += 1;
            }
         }
         fwrite($mcache, "      </ol>");
      }
   }
   
   fseek($mcache, 0);
   print fread($mcache, 65536);
}
else
{
   print fread($mcache, 65536);
}
fclose($mcache);
?>
      </p>
    </div><!-- col-lg-6 -->
  </div><!-- row -->
</div><!-- container -->
</section>

<!-- ==== SCRIBE TOOLS ==== -->
<section class="light-bg">
<div class="container" id="tools">
  <div class="row white">
    <h1 class="centered"><span class="icon icon-pencil"></span><br/> MEETING SCRIBE TOOLS</h1>
    <hr>
    <div class="col-lg-offset-1 col-lg-10">
      <p><a href="scribe-tool">Scribe Tool</a> - The scribe tool makes it easy to clean up minutes recorded in IRC.</p>

      </div>
    </div>
  </div>
</div>

?>

<?php $TOP_DIR='..'; include '../footer.inc'; ?>
