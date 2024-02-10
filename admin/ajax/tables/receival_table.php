<?php include('../../../../config.php');
$branch = $_POST['select_branch'];

$getyearmonth = $mysqli->query("SELECT DATE_FORMAT(datereceived, '%Y-%m') as datequery
FROM acc_receivals where branch = '$branch'
GROUP BY
DATE_FORMAT(datereceived, '%Y-%m') ORDER BY DATE_FORMAT(datereceived, '%Y-%m') DESC");



?>
<style>
    .dataTables_filter {
        display: none;
    }

    .scrollbar-auto {
        scrollbar-width: thin;
        height: 550px;
        width: 105%;
        overflow-y: scroll;
    }
</style>


<div class="kt-section">
    <h5 class="kt-portlet__head-title">
        ACCOUNT DETAILS
    </h5>

    <div class="kt-section__content responsive scrollbar-auto">
        <div class="table-responsive">
            <table class="table" style="width: 100% !important;">
                <tbody>
                <?php
                while ($fetch = $getyearmonth->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php $dateyear = $fetch['datequery'];
                            echo '<span style="text-decoration:underline;text-transform: uppercase;
                               font-weight: 600;font-size: 15px">'.date('Y - F',strtotime($dateyear)).'</span>';
                            $getdetails = $mysqli->query("select * from acc_receivals where
                                                         branch = '$branch' AND SUBSTRING(datereceived, 1, 7) = '$dateyear'
                                                         order by datereceived DESC");?>

                            <table class="table table-sm table-hover">
                                <thead>
                                <tr>
                                    <th>Branch</th>
                                    <th>Date</th>
                                    <th>Offering</th>
                                    <th>Tithe</th>
                                    <th>Youth</th>
                                    <th>Children</th>
                                    <th>Pledge</th>
                                    <th>Seed</th>
                                    <th>Welfare</th>
                                    <th>First Fruit</th>
                                    <th>Contri.</th>
                                    <th>Partners</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($resdetails = $getdetails->fetch_assoc()){ ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $branchid = $resdetails['branch'];
                                            $getbranch = $mysqli->query("select * from branch where id = '$branchid'");
                                            $resbranch = $getbranch->fetch_assoc();
                                            echo $resbranch['name'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php $daterec = $resdetails['datereceived'];
                                            echo $new_date = date('jS(D)', strtotime($daterec));
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $off = $resdetails['offering'] ?>
                                        </td>
                                        <td>
                                            <?php echo $tit = $resdetails['tithe'] ?>
                                        </td>
                                        <td>
                                            <?php echo $you = $resdetails['youth'] ?>
                                        </td>
                                        <td>
                                            <?php echo $chi = $resdetails['children'] ?>
                                        </td>
                                        <td>
                                            <?php echo $ple = $resdetails['pledge'] ?>
                                        </td>
                                        <td>
                                            <?php echo $see = $resdetails['seed'] ?>
                                        </td>
                                        <td>
                                            <?php echo $wel = $resdetails['welfare'] ?>
                                        </td>
                                        <td>
                                            <?php echo $fir = $resdetails['firstfruit'] ?>
                                        </td>
                                        <td>
                                            <?php echo $con = $resdetails['contribution'] ?>
                                        </td>
                                        <td>
                                            <?php echo $par = $resdetails['partners'] ?>
                                        </td>
                                        <td style="font-weight: 500">
                                            <?php $tot = $off+$tit+$you+$chi+$ple+$see+$wel+$fir+$con+$par;
                                            echo number_format($tot,2);?>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                                <tr>
                                    <td colspan="2" style="font-weight: 500">
                                        TOTAL
                                    </td>
                                    <td style="font-weight: 500">
                                        <?php
                                        $getoffering = $mysqli->query("select sum(offering) as sumoffering from acc_receivals where
                                                         branch = '$branch' AND SUBSTRING(datereceived, 1, 7) = '$dateyear'");
                                        $resoffering = $getoffering->fetch_assoc();
                                        $offt = $resoffering['sumoffering'];
                                        echo number_format($offt,2);
                                        ?>
                                    </td>
                                    <td style="font-weight: 500">
                                        <?php
                                        $gettithe = $mysqli->query("select sum(tithe) as sumtithe from acc_receivals where
                                                         branch = '$branch' AND SUBSTRING(datereceived, 1, 7) = '$dateyear'");
                                        $restithe = $gettithe->fetch_assoc();
                                        $titt = $restithe['sumtithe'];
                                        echo number_format($titt,2);
                                        ?>
                                    </td>
                                    <td style="font-weight: 500">
                                        <?php
                                        $getyouth = $mysqli->query("select sum(youth) as sumyouth from acc_receivals where
                                                         branch = '$branch' AND SUBSTRING(datereceived, 1, 7) = '$dateyear'");
                                        $resyouth = $getyouth->fetch_assoc();
                                        $yout = $resyouth['sumyouth'];
                                        echo number_format($yout,2);
                                        ?>
                                    </td>
                                    <td style="font-weight: 500">
                                        <?php
                                        $getchildren = $mysqli->query("select sum(children) as sumchildren from acc_receivals where
                                                         branch = '$branch' AND SUBSTRING(datereceived, 1, 7) = '$dateyear'");
                                        $reschildren = $getchildren->fetch_assoc();
                                        $chit = $reschildren['sumchildren'];
                                        echo number_format($chit,2);
                                        ?>
                                    </td>
                                    <td style="font-weight: 500">
                                        <?php
                                        $getpledge = $mysqli->query("select sum(pledge) as sumpledge from acc_receivals where
                                                         branch = '$branch' AND SUBSTRING(datereceived, 1, 7) = '$dateyear'");
                                        $respledge = $getpledge->fetch_assoc();
                                        $plet = $respledge['sumpledge'];
                                        echo number_format($plet,2);
                                        ?>
                                    </td>
                                    <td style="font-weight: 500">
                                        <?php
                                        $getseed = $mysqli->query("select sum(seed) as sumseed from acc_receivals where
                                                         branch = '$branch' AND SUBSTRING(datereceived, 1, 7) = '$dateyear'");
                                        $resseed = $getseed->fetch_assoc();
                                        $seet = $resseed['sumseed'];
                                        echo number_format($seet,2);
                                        ?>
                                    </td>
                                    <td style="font-weight: 500">
                                        <?php
                                        $getwelfare = $mysqli->query("select sum(welfare) as sumwelfare from acc_receivals where
                                                         branch = '$branch' AND SUBSTRING(datereceived, 1, 7) = '$dateyear'");
                                        $reswelfare = $getwelfare->fetch_assoc();
                                        $welt = $reswelfare['sumwelfare'];
                                        echo number_format($welt,2);
                                        ?>
                                    </td>
                                    <td style="font-weight: 500">
                                        <?php
                                        $getfirstfruit = $mysqli->query("select sum(firstfruit) as sumfirstfruit from acc_receivals where
                                                         branch = '$branch' AND SUBSTRING(datereceived, 1, 7) = '$dateyear'");
                                        $resfirstfruit = $getfirstfruit->fetch_assoc();
                                        $firt = $resfirstfruit['sumfirstfruit'];
                                        echo number_format($firt,2);
                                        ?>
                                    </td>
                                    <td style="font-weight: 500">
                                        <?php
                                        $getcontribution = $mysqli->query("select sum(contribution) as sumcontribution from acc_receivals where
                                                         branch = '$branch' AND SUBSTRING(datereceived, 1, 7) = '$dateyear'");
                                        $rescontribution = $getcontribution->fetch_assoc();
                                        $cont = $rescontribution['sumcontribution'];
                                        echo number_format($cont,2);
                                        ?>
                                    </td>
                                    <td style="font-weight: 500">
                                        <?php
                                        $getpartners = $mysqli->query("select sum(partners) as sumpartners from acc_receivals where
                                                         branch = '$branch' AND SUBSTRING(datereceived, 1, 7) = '$dateyear'");
                                        $respartners = $getpartners->fetch_assoc();
                                        $part = $respartners['sumpartners'];
                                        echo number_format($part,2);
                                        ?>
                                    </td>
                                    <td style="font-weight: 600;color:red">
                                        <?php
                                        $tott = $offt +$titt+$yout+$chit+$plet+$seet+$welt+$firt+$cont+$part;
                                        echo number_format($tott,2)
                                        ?>
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                            <?php ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

