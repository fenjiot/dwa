<?php

# Reverse the string and echo it to the page
echo strrev($_POST['name'])

# This doesn't work for some reason.  Going to use /process.php => yourapp.com/process.php to make this work 
# Change in reverser.js
# ajax url: '/process.php' with preceeding '/' vs 'process.php'
# error is occuring becuase yourapp.com/javascripts/process.php isn't being found...