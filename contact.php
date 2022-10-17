<?php
$title = 'Contact us';
include('include/header.php');
?>

<main>
    <div class="cimg_holder">
        <div class="cimg"></div>
        <h2 class="text-nowrap">GET IN TOUCH</h2>
    </div>
    <div class="img_cover d-flex justify-content-center align-items-center">
        <p class="text-center">USE THE FORM BELOW TO DROP US AN E-MAIL</p>
    </div>
    <div class="arrow d-flex justify-content-center align-items-center">
        <a href="#arr"><i class="fas fa-angle-double-down text-center fa-3x mb-2"></i></a>
    </div>

    <form class="form" action="processing" method="POST">
        <div class="container-fluid ">
            <div class="row mb-3">
                <div class="col-lg-6 ">

                    <div class="container-fluid p-4  bg-white shadow">
                        <div class="row">
                            <input type="hidden" name="fun" value="contact">
                            <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                <input type="text" name="fname" placeholder="First name" class="form-control">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                <input type="text" name="lname" placeholder="Last name" class="form-control">
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                <input type="email" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 my-2">
                                <input type="tel" name="contactno" placeholder="Phone number" class="form-control">
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <textarea name="message" placeholder="Message" class="form-control" style="resize: none;"></textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" name="btn_send" class="form-control btn btn-info">SEND</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 ">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14751.293946753343!2d72.58297912997307!3d22.435668564053028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395efdecafb7aeed%3A0xc6664a2c5f70b4d3!2sBudhej%2C%20Gujarat%20388620!5e0!3m2!1sen!2sin!4v1642340822412!5m2!1sen!2sin" allowfullscreen="" loading="lazy" style="border:0;height:100%;width:100%;" class="p-4 bg-white shadow"></iframe>

                </div>
            </div>

        </div>
    </form>
</main>
<div class="div" id="arr"></div>
<?php
include('include/footer.php');
?>