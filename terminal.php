<?php
require_once("initdb.php");
if ($_SESSION['type'] != 0)
    {
        session_destroy();
        header("Location: index.php");
    }
if (!(isset($_SESSION['login']) AND ($_SESSION['login'] == 1)))
    {
        session_destroy();
        header("Location: index.php");
    }
?>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Tathva 13 Organiser: Administrator Terminal</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="all" />
<link rel="shortcut icon" href="taticon.png" type="image/png"/>
</head>
<body>
    <?php include("header.php");?>
    <div id="users">
    <?php include("modules/table-users.php");?>
    </div>
    <br>
    <div id="show">
    <?php include("modules/table-marketing.php");?>
    </div>
    <br>
    <?php
        $query="SELECT code, name, (SELECT name FROM event_cats WHERE event_cats.cat_id=events.cat_id) AS cat, validate FROM events";
        $result=$mysqli->query($query);
        $row=$result->fetch_assoc();
        if (!$row)
            echo "Sorry events table is empty.";
        else {
        ?>
    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg .tg-glis{font-size:10px}
    </style>
    <table class="tg" style="undefined;table-layout: fixed; width: 912px">
        <colgroup>
            <col style="width: 152px">
            <col style="width: 152px">
            <col style="width: 152px">
            <col style="width: 152px">
            <col style="width: 152px">
            <col style="width: 152px">
        </colgroup>
        <thead>
           <tr> 
                <th>Code</th> 
                <th>Event Name</th> 
                <th>Category</th> 
                <th>Validation</th> 
                <th>Delete</th>
                <th>Show Description</th>
            </tr>
        </thead>
    <?php
    do {
    $e = $row['code'];
    $event = "showEventDetails.php?event=$e";
    $x = "exec.php?e=$e";
    $v = "<a href='$x&a=";
    $v .= ($row['validate'] == 0) ? "val'>Validate" : "inv'>Invalidate";
    $v .= "</a>";
    echo "
        <tr>
            <td>$e</td> 
            <td>$row[name]</td> 
            <td>$row[cat]</td> 
            <td>$v</td>  
            <td><a href='javascript:alert(\"$x&a=del\");'>Delete</a></td>
            <td><a href='$event'>Show Description</a></td>
        </tr>";
    } while($row=$result->fetch_array());
    ?></table>
    <?php
}
?>
    <!--<?php
        $query="SELECT code, name, (SELECT name FROM event_cats WHERE event_cats.cat_id=events.cat_id) AS cat, shortdesc, longdesc, tags, contacts, prize, validate FROM events";
        $result=$mysqli->query($query);
        $row=$result->fetch_assoc();
        if (!$row)
            echo "Sorry events table is empty.";
        else {
        ?>
        <table>
            <thead>
	           <tr> 
               <th>Code</th> 
               <th>Event Name</th> 
               <th>Category</th> 
               <th>Short Desc</th>
	           <th>Long Desc</th> 
               <th>Tags</th> 
               <th>Contacts</th> 
	           <th>Prize</th> 
               <th>Validation</th> 
               <th>-del-</th></tr>
            </thead>
    <?php
    do {
	$e = $row['code'];
	$x = "exec.php?e=$e";
	$v = "<a href='$x&a=";
	$v .= ($row['validate'] == 0) ? "val'>Validate" : "inv'>Invalidate";
	$v .= "</a>";
	echo "<tr><td>$e</td> <td>$row[name]</td> <td>$row[cat]</td> <td>$row[shortdesc]</td>
		  <td><div class='overflow'>".str_replace(array('||sec||','||ttl||'),array('<h4>','</h4>'),$row['longdesc'])."</div></td> <td>$row[tags]</td> <td>".str_replace(array("||0||","||@||"),array("<br/>"," "),$row['contacts'])."</td>
		  <td>".str_replace("||@||","<br/>",$row['prize'])."</td> <td>$v</td>  <td><a href='javascript:alert(\"$x&a=del\");'>Delete</a></td></tr>";
    } while($row=$result->fetch_array());
    ?></table>
    <?php
}
?>-->
  <?php include('footer.php');?>

</body>
</html>