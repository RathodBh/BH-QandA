// footer 
// print current year
const year = new Date().getFullYear();
const curYear = document.querySelector('#footer .year');

if(curYear.innerHTML == "2022")
{
    curYear.innerHTML = year;
}
else{
    curYear.innerHTML = curYear.innerHTML + "-" + year;
}

//set extra height of header
const header = document.querySelector('#header').clientHeight;
let extra = document.querySelector('#extra').style.height = header + 'px';
let allSetHeight = document.querySelectorAll('.setHeight');

allSetHeight.forEach((elem) => {
    elem.style.height = `calc(100vh - ${header}px)`;
});

//show and hide gotoTop
let goto = document.querySelector('#gotoTop');
window.addEventListener("scroll",()=>{
    if(window.scrollY > 500){
        goto.style.display = "block";
    }
    else{
        goto.style.display = "none";
    }
})

function modal(name, id) {
    var data = 'id=' + id;
    $.ajax
        ({
            url: 'include/modal/' + name,  //location of modal file
            method: 'post',
            data: data,
            success: function (msg) {
                $('#type_d').html(msg);
                // $('.modal_type').modal({
                //     "backdrop": "static",
                //     "keyboard": true
                // });
                my = $('.modal_type');
                $('.modal_type').show({
                    "backdrop": "static",
                    "keyboard": true,
                    "focus": true
                }
                );
                $('.modal_type .btn-close, .modal_type .btn-cls').click(function () {
                    my.hide();
                })

                $('.modal_type').on('show.bs.modal', function (e) {
                    $('.modal_type').addClass("fade")
                }
                );
            }, error: function () {
                alert("error");
            }
        });
}


//////////////// SweetAlert2 Functions ///////////////
function lll() {
    Swal.fire(
        'Good job!',
        'Sign up successfully ! You can Login Now',
        'success'
    )
}


function isValid() {
    if (document.registration.password.value != document.registration.cpass.value) {
        // alert("Password and Confirm Password Field do not match  !!");
        Swal.fire('Error!', 'Password and confirm password is not match', 'error');
        document.registration.cpass.focus();
        return false;
    }
    
    // else if (forms['registration'].password.value != forms['registration'].cpass.value){
    //     Swal.fire('Follow!', 'Please Fill all blanks', 'warning');
    //     return false;
    // }
    // forms['registration'].password.value == "" || forms['registration'].cpass.value == "" || forms['registration'].name.value == "" || forms['registration'].email.value == ""
    return true;
}

function userAvailability() {

    jQuery.ajax({
        url: "check_availability.php",
        data: 'email=' + $("#email").val(),
        type: "POST",
        success: function (data) {
            $("#user-availability-status1").html(data);
        },
        error: function () { }
    });
}
function setPoll(qid,option,id) {
    // alert();
    jQuery.ajax({
        url: "check_poll.php",
        data: 'qid=' + qid + '&option=' + option + '&id=' + id,
        type: "POST",
        success: function (data) {
            alert(data)
        },
        error: function () {
            alert("fail");
        }
    });

}
 //poll
    // var allRadio = document.querySelectorAll(".optionRadio");
    // allRadio.forEach((elem) => {
    //     elem.addEventListener('change', () => {
    //         jQuery.ajax({
    //             url: "check_poll.php",
    //             data: 'option=' + elem.value + '&id=' + elem.id,
    //             type: "POST",
    //             success: function (data) {
    //                 alert(data);
    //                 $("#poll_output").html(data);
    //             },
    //             error: function () {
    //                 alert("fail");
    //             }
    //         });

    //     });
    // });
