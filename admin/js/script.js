const menuIconButton = document.querySelector("[data-menu-icon-btn]")
const sidebar = document.querySelector("[data-sidebar]")

menuIconButton.addEventListener("click", () => {
  sidebar.classList.toggle("open")
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

//sweetAlert2

const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

//check for category is available or not
function categoryAvailability() {
  jQuery.ajax({
    url: "check_category.php",
    data: 'category=' + $("#category").val(),
    type: "POST",
    success: function (data) {
      $("#category_label").html(data);
    },
    error: function () { }
  });
}

//update verification
function updateVerify(id) {
  jQuery.ajax({
    url: "update_verify.php",
    data: 'table=' + $("#table_name").val() + '&id=' + id,
    type: "POST",
    success: function (data) {
      // location.reload()
      $("#best_label").html(data);

    },
    error: function () { }
  });
}


//update Best Answer
function updateBest(id) {
  jQuery.ajax({
    url: "update_verify.php",
    data: 'aid=' + id,
    type: "POST",
    success: function (data) {
      // location.reload()
    },
    error: function () { }
  });
}

//delete item
function deleteItem(id) {
  Swal.fire({
    title: "Are you sure?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {

      Toast.fire({
        icon: "success",
        title: "Your item has been deleted"
      });
      setTimeout(() => {
        jQuery.ajax({
          url: "delete.php",
          data: 'table=' + $("#table_name").val() + '&id=' + id,
          type: "POST",
          success: function (data) {
            location.reload()
          },
          error: function () { }
        });
      }, 1500);

    }
  })
}

//add contact us response
function contactReply(id) {
  Swal.fire({
    title: "Enter your response",
    input: "textarea",
    showCancelButton: true,
    confirmButtonText: 'Add'
  }).then((result) => {
    if (result.isConfirmed) {

      jQuery.ajax({
        url: "include/process/admin-process.php",
        data: 'id=' + id + '&val=' + result.value + '&fun=contact_reply',
        type: "POST",
        success: function (data) {
          Toast.fire({
            icon: "success",
            title: "Your response is added successfully"
          });
          setTimeout(() => {
            location.reload()
          }, 1500);

        },
        error: function () { }
      });
    }
  })
}


//edit contact us response
function editContactReply(id, res) {
  Swal.fire({
    title: "Edit your response",
    input: "textarea",
    // inputValue: res,
    showCancelButton: true,
    confirmButtonText: 'Update'
  }).then((result) => {
    if (result.isConfirmed) {

      jQuery.ajax({
        url: "include/process/admin-process.php",
        data: 'id=' + id + '&val=' + result.value + '&fun=contact_reply',
        type: "POST",
        success: function (data) {
          $("#type_d").html(data);
          Toast.fire({
            icon: "success",
            title: "Response updated"
          });
          setTimeout(() => {
            location.reload()
          }, 2000);

        },
        error: function () { }
      });

    }
  })
}


//code for counter numbers animation (index.php)
const counterNum = document.querySelectorAll('.counter-nums');
const speed = 4;

counterNum.forEach((curElem) => {
  const updateNumber = () => {
    //data-number property value
    const targetNum = parseInt(curElem.dataset.val);
    //startfrom
    const incNum = Math.trunc(targetNum / speed);
    const initialNum = parseInt(curElem.innerText);

    if (initialNum < targetNum) {
      curElem.innerText = initialNum + incNum;
      setTimeout(updateNumber, 100);
    }
    else if (curElem.dataset.val < curElem.innerText)
      curElem.innerText = curElem.dataset.val;
  }
  updateNumber();
})


//change pwd
function changePassword() {
  Swal.fire({
    title: "Change Password",
    input: "text",
    showCancelButton: true,
    confirmButtonText: 'Change'
  }).then((result) => {
    if (result.isConfirmed) {
      jQuery.ajax({
        url: "include/process/admin-process.php",
        data: 'fun=' + 'change_pwd' + '&val=' + result.value,
        type: "POST",
        success: function (data) {
          Toast.fire({
            icon: "success",
            title: "Your password is updated"
          });
          setTimeout(() => {
            location.reload()
          }, 2000);
        },
        error: function () {
          Toast.fire({
            icon: "error",
            title: "Your password is not updated"
          });
        }
      });
    }
  })
}
