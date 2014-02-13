<pre>
<?php
$result = array();
exec("git stash 2>&1", $result);
exec("git fetch 2>&1", $result);

if(isset($_GET['go'])) {
    if($_GET['go']=='live') {
        exec("git checkout master --force 2>&1", $result);
        exec("git pull origin master 2>&1", $result);
    } else {
        exec("git checkout ".$_GET['go']." --force 2>&1", $result);
        exec("git pull origin ".$_GET['go']." 2>&1", $result);
    }
}

print_r($result);
