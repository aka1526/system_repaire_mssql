<html>
<head>
<title>ThaiCreate.Com PHP & SQL Server (PDO)</title>
</head>
<body>
<?php
 $serverName = '172.16.0.1';
$userName = 'akachai';
$userPassword = '42116533';
$dbName = 'system_repair';
 
try{
	$conn = new PDO("sqlsrv:server=$serverName ; Database = $dbName", $userName, $userPassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
	die(print_r($e->getMessage()));
}
?>
<table width="650" border="1">
  <tr>
    <th width="91"> <div align="center">CustomerID </div></th>
    <th width="98"> <div align="center">Name </div></th>
    <th width="198"> <div align="center">Email </div></th>
    <th width="97"> <div align="center">CountryCode </div></th>
    <th width="59"> <div align="center">Budget </div></th>
    <th width="71"> <div align="center">Used </div></th>
	<th width="50"> <div align="center">Detail </div></th>
  </tr>
<?php
while($result = $stmt->fetch( PDO::FETCH_ASSOC ))
{
?>
  <tr>
    <td><div align="center"><?php echo $result["CustomerID"];?></div></td>
    <td><?php echo $result["Name"];?></td>
    <td><?php echo $result["Email"];?></td>
    <td><div align="center"><?php echo $result["CountryCode"];?></div></td>
    <td align="right"><?php echo $result["Budget"];?></td>
    <td align="right"><?php echo $result["Used"];?></td>
	<td align="center"><a href="detail.php?CustomerID=<?php echo $result["CustomerID"];?>">Detail</a></td>
  </tr>
<?php
}
?>
</table>
<?php
$conn = null;
?>
</body>
</html>