<?php
include 'includes/init.php';

include 'includes/header.php';

$stmt = $mysqli->prepare("SELECT pictures, large_pic FROM img_grid");

$stmt->execute();

$stmt->bind_result($picture, $pictureLg);
?>

<div class="header-img">
    <h4 align="center">Stalker Art</h4>
</div>

<div class="containerImg">
    <div class="imgRow">
        <?php while ($stmt->fetch()) : ?>
            <div class="col"><img src="img/grid/<?= $picture ?>" class="imgInput" data-src="img/grid/<?= $pictureLg ?>"></div>
        <?php endwhile; ?>
    </div>
</div>

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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php
include 'includes/footer.php';
?>
