<?php
include 'includes/init.php';

include 'includes/header.php';

/**
 * Selects all pictures from img grid to display in modal
 */

$seq = 0;
$stmt = $mysqli->prepare("SELECT pictures, large_pic FROM img_grid");

$stmt->execute();

$stmt->bind_result($picture, $pictureLg);
?>
<script type="text/javascript">
    let imgSeq = 0;
</script>

<div class="header-img">
    <h4 align="center">Stalker Art</h4>
</div>

<div class="containerImg">
    <div class="imgRow">
        <?php while ($stmt->fetch()) :
            /**
             * You can add here something like images[] = "img/grid/<?= $pictureLg ?>" if it is simplier for you else you
             * can do it in javascript
             */
            ?>
            <div class="col"><img id="img<?= $seq ?>" src="img/grid/<?= $picture ?>" class="imgInput" data-src="img/grid/<?= $pictureLg ?>" data-seq="<?= $seq ?>"></div>
        <?php
            $seq++;
        endwhile;
        ?>
    </div>
</div>

<!-- bootstrap modal for pictures -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="img/grid/loader.png" class="modalImg" id="imgInModal">
            </div>
            <div class="modal-footer">
                <button id="prev-btn" class="btn btn-secondary">Prev</button><!-- a person clicks here, you get the previous image in the array and update src for imgInModal-->
                <button id="next-btn" class="btn btn-secondary">Next</button><!-- a person clicks here, you get the next image in the array and update src for imgInModal -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php
include 'includes/footer.php';
?>
