<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="col-md-12">
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-md-8 mb-3 text-left">

                <h4 class="mb-4"><?php echo $REGISTER_FORM_TITLE; ?></h4>

                <form id="registerForm">
                    <div class="form-row text-danger">
                        <div class="col-md-12 mb-3" id="errorsBlock"></div>
                    </div>
                    <div class="form-row" style="height: 100px">
                        <div class="col-md-5 mb-3">
                            <label for="username"><?php echo $USERNAME; ?><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" required>
                            <div></div>
                        </div>
                        <div class="col-md-7 mb-3">
                            <label for="email"><?php echo $EMAIL; ?><span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div></div>
                        </div>
                    </div>
                    <div class="form-row" style="height: 100px">
                        <div class="col-md-6 mb-3">
                            <label for="firstName"><?php echo $FIRST_NAME; ?><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                            <div></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName"><?php echo $LAST_NAME; ?><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                            <div></div>
                        </div>
                    </div>
                    <div class="form-row" style="height: 100px">
                        <div class="col-md-6 mb-3">
                            <label for="password"><?php echo $PASSWORD; ?><span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="confirmPassword"><?php echo $CONFIRM_PASSWORD; ?><span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                   required>
                            <div></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="gender"><?php echo $GENDER; ?></label>
                                </div>
                                <select class="custom-select" id="gender" name="gender">
                                    <option selected disabled><?php echo $SELECT_GENDER; ?></option>
                                    <option value="Male"><?php echo $MALE_GENDER; ?></option>
                                    <option value="Female"><?php echo $FEMALE_GENDER; ?></option>
                                    <option value="Other"><?php echo $OTHER_GENDER; ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="uploadImage" accept="image/*"
                                       name="avatar">
                                <label class="custom-file-label" for="uploadImage" id="fileName"><?php echo $CHOOSE_FILE; ?></label>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="registerSubmit" class="btn btn-success float-right"><?php echo $REGISTER_SUBMIT; ?></button>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="../public/js/registration/registerValidation.js"></script>
<script src="../public/js/registration/registerSubmit.js"></script>
<script src="../public/js/registration/regEx.js"></script>

<?php include ROOT . '/views/layouts/footer.php'; ?>

