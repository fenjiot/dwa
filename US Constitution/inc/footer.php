<div id="footer" class="span-24 last">
	<p>This php version of the United States Constitution was adapted from <a href="http://www.house.gov/">U.S. House of Representatives</a> website at <a href="http://www.house.gov/house/Constitution/Constitution.html">http://www.house.gov/Constitution/Constitution.html</a>. <br />
      <a href="http://www.archives.gov/exhibits/charters/constitution.html">Learn more about the United States Constitution at <span class="bold">The National Archives</span> online exhibit</a>.<br />
	<?php 
		$ip=$_SERVER['SERVER_ADDR']; 
		echo "IP: $ip";
		echo "<br />";
		echo "Last Modified: " . date("F d Y H:i:s.", getlastmod());
	?>
	</p>
</div>