 <div class="modal modal_type" id="loginModal">
     <div class="modal-dialog">
         <div class="modal-content">

             <div class="modal-header bg-success">
                 <h4 class="modal-title text-light">Login</h4>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>

             <div class="modal-body">
                 <form action="processing" method="POST">
                     <input type="hidden" name="fun" value="user_login">
                     <div class="mb-3 mt-3">
                         <label for="email" class="form-label">Email:</label>
                         <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                     </div>
                     <div class="mb-3">
                         <label for="pwd" class="form-label">Password:</label>
                         <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
                     </div>
                     <button type="submit" class="btn btn-success">Submit</button>
                 </form>
             </div>

             <div class="modal-footer">
                 <input type="button" value="Sign Up" class="btn btn-outline-secondary mx-2" onclick="modal('user-register')">
                 <input type="button" value="Forget password" class="btn btn-outline-dark mx-2" onclick="modal('forget-password')">
                 <button type="button" class="btn btn-outline-danger btn-cls" data-bs-dismiss="modal">Close</button>
             </div>

         </div>
     </div>
 </div>