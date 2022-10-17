 <div class="modal modal_type" id="addCategory">
     <div class="modal-dialog">
         <div class="modal-content">

             <div class="modal-header bg-success">
                 <h4 class="modal-title text-light">Add category</h4>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>

             <div class="modal-body">
                 <form action="include/process/admin-process" method="POST">
                     <input type="hidden" name="fun" value="add_category">
                     <div class="mb-3 mt-3">
                         <label for="category" class="form-label">category:</label>
                         <input type="text" class="form-control" id="category" placeholder="Enter category" name="category" oninput="categoryAvailability()" required>
                         <label class="form-label my-2" id="category_label"></label>
                     </div>
                     <button type="submit" class="btn btn-success" id="submit">Submit</button>
                 </form>
             </div>

             <div class="modal-footer">
                 <button type="button" class="btn btn-outline-danger btn-cls" data-bs-dismiss="modal">Close</button>
             </div>

         </div>
     </div>
 </div>