<?php
$title = "FAQ";
include("include/header.php");
?>
<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center text-primary my-3">Frequently Asked Questions</h1>

            <div id="accordion" class="accordion">

                <div class="accordion-item">
                    <div class="accordion-header">
                        <a class="accordion-button" data-bs-toggle="collapse" href="#collapseOne">
                            Collapsible Group Item #1
                        </a>
                    </div>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordion">
                        <div class="accordion-body px-4">
                            Lorem ipsum..
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include("include/footer.php");
?>