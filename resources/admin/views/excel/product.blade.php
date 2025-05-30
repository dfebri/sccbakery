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
        <th width="110">Image</th>
        <th>Code</th>
        <th width="180">Name</th>
        <th>Stock</th>
    </tr>
    </thead>
<tbody>
<?php
$i = 0;
foreach($products_list as $product){
    $i++;
?>
    <tr>
        <td valign="top" align="center"><?php echo $i;?></td>
        <td valign="middle" align="center" style="padding:2px; width:110px; height:110px; text-align:center;">
            &nbsp;
            <?php if($product->images()->first()) {?>
                <?php if($product->images()->first()['img'] != '')?>
                <img width="100" align="center" src="<?php echo URL::asset('resources/assets/uploads/products/400/'.$product->images()->first()['img']);?>" />
                &nbsp;
                <?php ?>
            <?php } ?>
        </td>
        <td valign="top"><?php echo $product->name;?></td>
        <td valign="top"><?php echo $product->subtitle;?></td>
        <td valign="top"><?php echo $product->description;?></td>
    </tr>
<?php
}
?>
</tbody>
</table>
</body>
</html>