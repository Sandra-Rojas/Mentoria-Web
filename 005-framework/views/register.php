<h1>Register</h1>

<form method="POST">
  <div class="mb-3">
    <label class="form-label">Firstname</label>
    <input type="text" name = "firstname" value="<?= $model->firstname?>" class="form-control" >
       class="form-control <?= $model->hasError('firstname') ? 'is-invalid' : '' ?>">
       
    <div class="invalid-feedback">   
      <?= $model->getFirstError('firstname')?>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">LastName</label>
    <input type="text" name = "lastname" value = "<?= $model->lastname?>" class="form-control" >
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="text" name = "email" class="form-control" >
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="text" name="password" class="form-control"></input>
  </div>
  <div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="text" name="confirmPassword" class="form-control"></input>
  </div>
  

  <button type="submit" class="btn btn-primary">Save</button>
</form>

 

   
   
   