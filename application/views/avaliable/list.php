<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 27-07-2018
 * Time: 11:47 AM
 */

/*
print_r("<pre>");
print_r($final);
print_r("</pre>");
 */
/*print_r("<pre>");
print_r($results);
print_r("</pre>");*/

?>




<div class="row">



</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Spares Availablity List
            </header>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr style="background-color: #b7fffc; color: white">
                        <th>S.No</th>
                        <th>Spare Id</th>
                        <th>Part No</th>
                        <th>Spare Name</th>
                        <th>Qty Required</th>
                        <th>Qty Available</th>
                        <th>Result</th>
                        <th>Additional</th>
                        <th>Estimate</th>


                    </tr>
                    </thead>

                    <?php
                    $i=0;
                    $max_pro_count=array();
                    foreach ($results as $result)
                    {
                        $i=$i+1;
                       if ($result['qty_available']>=$result['qty_need'])
                       {
                           $colorvar="style='background-color: green;color:white'";
                           $res="Pass";
                           $req="";
                           $quotient = (int)($result['qty_available'] /$result['qty_need']);
                           $max_pro_count[]=$quotient;
                       }else
                       {
                           $colorvar="style='background-color: red;color:white'";
                           $res="Failed";
                           $req=($result['qty_available']-$result['qty_need'])*(-1);
                           $quotient="";
                           $max_pro_count[]=0;
                       }

                        ?>
                        <tr <?php echo $colorvar ?>>
                            <td>  <?php echo $i ?> </td>
                            <td>  <?php echo $result['spare_id'] ?> </td>
                            <td>  <?php echo $result['part_no'] ?> </td>
                            <td>  <?php echo $result['spare_name'] ?> </td>
                            <td>  <?php echo $result['qty_need'] ?> </td>
                            <td>  <?php echo $result['qty_available'] ?> </td>
                            <td>  <?php echo $res   ?> </td>
                            <td>  <?php echo $req   ?> </td>
                            <td>  <?php echo $quotient  ?> </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>

            </div>
        </section>
    </div>
</div>

<div class="col-lg-12 ">
    <div class="row">
        <p> Avalibale Spares is ready to build  <b style="color:black "> <?php echo min($max_pro_count) ?> </b> Products </p>
        <p style="color: black"><blink>Calculation Completed</blink></p>


    </div>
</div>
<?php if(min($max_pro_count)>0)
{

?>
<form action="GetSpareFromStock" method="post">
	<input type="submit" value="Proceed to Take" class="btn btn-primary">
</form>
<?php
}
else
{
	?>
	<form action="SetPoTable" method="post">
		<input type="submit" value="Proceed to PO" class="btn btn-primary">
	</form>

<?php


}
?>

<style>
    blink {
        -webkit-animation: 2s linear infinite condemned_blink_effect; // for android
    animation: 2s linear infinite condemned_blink_effect;
    }
    @-webkit-keyframes condemned_blink_effect { // for android
    0% {
        visibility: hidden;
    }
    50% {
        visibility: hidden;
    }
    100% {
        visibility: visible;
    }
    }
    @keyframes condemned_blink_effect {
        0% {
            visibility: hidden;
        }
        50% {
            visibility: hidden;
        }
        100% {
            visibility: visible;
        }
    }
</style>
