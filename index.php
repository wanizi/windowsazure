
<html>
<head>
    <title>Index</title>
    <style type="text/css">
        body { background-color: #fff; border-top: solid 10px #000;
            color: #333; font-size: .85em; margin: 20; padding: 20;
            font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
        }
        h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
        h1 { font-size: 2em; }
        h2 { font-size: 1.75em; }
        h3 { font-size: 1.2em; }
        table { margin-top: 0.75em; }
        th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
        td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
    </style>
</head>
<body>
<h1>My ToDo List <font color="grey" size="5">(powered by PHP and Azure Tables) </font></h1>
<?php       
require_once "init.php";

try {
    $result = $tableRestProxy->queryEntities('tasks');
}
catch(ServiceException $e){
    $code = $e->getCode();
    $error_message = $e->getMessage();
    echo $code.": ".$error_message."<br />";
}

$entities = $result->getEntities();


for ($i = 0; $i < count($entities); $i++) {
	if ($i == 0) {
        echo "<table border='1'>
        <tr>
            <td>Name</td>
            <td>Category</td>
            <td>Date</td>
            <td>Mark Complete?</td>
            <td>Delete?</td>
        </tr>";
    }
    echo "
        <tr>
            <td>".$entities[$i]->getPropertyValue('name')."</td>
            <td>".$entities[$i]->getPropertyValue('category')."</td>
            <td>".$entities[$i]->getPropertyValue('date')."</td>";
            if ($entities[$i]->getPropertyValue('complete') == false)
                echo "<td><a href='markitem.php?complete=true&pk=".$entities[$i]->getPartitionKey()."&rk=".$entities[$i]->getRowKey()."'>Mark Complete</a></td>";
            else
                echo "<td><a href='markitem.php?complete=false&pk=".$entities[$i]->getPartitionKey()."&rk=".$entities[$i]->getRowKey()."'>Unmark Complete</a></td>";
            echo "
            <td><a href='deleteitem.php?pk=".$entities[$i]->getPartitionKey()."&rk=".$entities[$i]->getRowKey()."'>Delete</a></td>
        </tr>";
}


if ($i > 0)
    echo "</table>";
else
    echo "<h3>No items on list.</h3>";
?>

<hr/>
    <form action="additem.php" method="post">
        <table border="1">
            <tr>
                <td>Item Name: </td>
                <td><input name="itemname" type="textbox"/></td>
            </tr>
            <tr>
                <td>Category: </td>
                <td><input name="category" type="textbox"/></td>
            </tr>
            <tr>
                <td>Date: </td>
                <td><input name="date" type="textbox"/></td>
            </tr>
        </table>
        <input type="submit" value="Add item"/>
    </form>
</body>
</html>