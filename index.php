<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />

<title>AJAX &amp; PHP Click-Counter with Flat File Storage (text file)</title>
<!-- http://www.dynamicdrive.com/forums/entry.php?322-Click-Counter-with-Flat-File-Storage-(text-file)-AJAX-amp-PHP -->

<style>
html, body { margin:0; padding:0; font:16px/1.75 Verdana, Arial, Helvetica, sans-serif }
.page-content { padding:1em; max-width:64em; margin:auto }

.click-count { color:green; font-weight:bold }
</style>

</head>
<body>

<div class="page-content">

<h2>AJAX &amp; PHP Click-Counter with Flat File Storage (text file)</h2>
<p>Log and display clicks on any HTML element. Counts are saved to a .txt file with PHP, while AJAX displays the increasing number in real time. No page refresh required!</p>
<p>PHP5 required. Works in modern browsers and IE8+</p>
<br/>


<?php 

$clickcount = explode("\n", file_get_contents('counter.txt'));
foreach($clickcount as $line){
	$tmp = explode('||', $line);
	$count[trim($tmp[0])] = trim($tmp[1]);
	}

?>

<button class="click-trigger" data-click-id="click-001">Click Me</button> 
Clicked <span id="click-001" class="click-count"><?php echo $count['click-001'];?></span> times.
<br/><br/>

<button class="click-trigger" data-click-id="click-002">Click Me</button> 
Clicked <span id="click-002" class="click-count"><?php echo $count['click-002'];?></span> times.
<br/><br/>

<button class="click-trigger" data-click-id="click-003">Click Me</button> 
Clicked <span id="click-003" class="click-count"><?php echo $count['click-003'];?></span> times.
<br/><br/>


<h2>More demos and snippets</h2>
<p>Did you find this useful? There are more <a href="http://fofwebdesign.co.uk/freebies-for-websites/demos-and-snippets.php">demos and code snippets</a> this way.</p>
&nbsp;
</div><!-- closing ".page-content" -->


<script>
var clicks = document.querySelectorAll('.click-trigger'); // IE8
for(var i = 0; i < clicks.length; i++){
	clicks[i].onclick = function(){
		var id = this.getAttribute('data-click-id');
		var post = 'id='+id; // post string
		var req = new XMLHttpRequest();
		req.open('POST', 'counter.php', true);
		req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		req.onreadystatechange = function(){
			if (req.readyState != 4 || req.status != 200) return; 
			document.getElementById(id).innerHTML = req.responseText;
			};
		req.send(post);
		}
	}
</script>

</body>
</html>