<?php
/**
 * Created by PhpStorm.
 * User: Outpost-PC2
 * Date: 9/11/2015
 * Time: 11:14 AM
 */
?>
<html>
<body>
<table border="1">
<thead>
    <tr>
        <th width="30">No</th>
        <th width="180">Email</th>
        <th>Created</th>
    </tr>
    </thead>
<tbody>
<?php
$i = 0;
foreach($newsletters as $newsletter){
    $i++;
?>
    <tr>
        <td valign="top" align="center"><?php echo $i;?></td>
        <td valign="top"><?php echo $newsletter->email;?></td>
        <td valign="top"><?php echo $newsletter->created_at->format('d F Y');?></td>
    </tr>
<?php
}
?>
</tbody>
</table>
</body>
</html>