<tr>
    <?php
    $nama_tw = "";
    for ($tr = 0; $tr < count($tw2); $tr++) {
        if ($join[$a]->id_tw == $tw2[$tr]->id) {
            $nama_tw = $tw2[$tr]->triwulan;
            $nama_tw = substr($nama_tw, 14, 1);
        }
    }
    // echo $nama_tw . "<br />";
    if ($nama_tw == 2) {
        for ($e = 1; $e < 4; $e++) { ?>
            <td align="center" bgcolor=" white"></td>
    <?php }
    } ?>

    <?php
    if ($nama_tw == 3) {
        for ($e = 1; $e < 7; $e++) { ?>
            <td bgcolor="white"></td>
    <?php }
    } ?>
    <?php
    if ($nama_tw == 4) {
        for ($e = 1; $e < 10; $e++) { ?>
            <td bgcolor="white"></td>
    <?php }
    } ?>

    <?php
    // for ($stk = 0; $stk < count($trx_status_tor); $stk++) {
    //     if ($trx_status_tor[$stk]->id_tor == $tor[$a]->id) {
    //         $ada += 1;
    //     } else {
    //         $ada = 0;
    //     }
    // }

    ?>
    <td style="background-color: #efefef;color:black" align="left" colspan="3"><?= "RAB" . " - " . $rab[$b]->masukan ?><br /><?php $nomer += 1 ?>

        <!-- <button class="badge badge-info" data-toggle="modal" data-placement="top" data-target="#detail_rab{{$rab[$b]->id}}">
            <i class="fa fa-tasks"></i>
        </button> -->
        @include('perencanaan/validasi/modal/rab/detail')
        <a href="{{url('/detailtor/'.  $join[$a]->tor_id)}}"><button class="badge badge-warning rounded">Detail
            </button></a>



    </td>
    <?php
    if ($nama_tw == 1) {
        for ($e = 1; $e < 10; $e++) { ?>
            <td align="center" bgcolor=" white"></td>
    <?php }
    } ?>
    <?php
    if ($nama_tw == 2) {
        for ($e = 1; $e < 7; $e++) { ?>
            <td align="center" bgcolor=" white"></td>
    <?php }
    } ?>
    <?php
    if ($nama_tw == 3) {
        for ($e = 1; $e < 4; $e++) { ?>
            <td bgcolor="white"></td>
    <?php
        }
    }

    ?>
</tr>