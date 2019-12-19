<?php
include 'includes/init.php';

include 'includes/header.php';
?>

<div class="header-img">
    <h4 align="center">Stalker Art</h4>
</div>

<div class="containerImg">
    <div class="row">
        <div class="col"><img src="img/index.jpeg" class="imgInput"></div>
        <div class="col"><img src="img/index2.jpeg" class="imgInput"></div>
        <div class="col"><img src="img/index3.jpeg" class="imgInput"></div>
        <div class="col"><img src="img/index4.jpeg" class="imgInput"></div>
    </div>
</div>

<div class="containerImg">
    <div class="row">
        <div class="col"><img src="img/index5.jpeg" class="imgInput"></div>
        <div class="col"><img src="img/index6.jpeg" class="imgInput"></div>
        <div class="col"><img src="img/index7.jpeg" class="imgInput"></div>
        <div class="col"><img src="img/index8.jpeg" class="imgInput"></div>
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
                <img src="img/index.jpeg">
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
