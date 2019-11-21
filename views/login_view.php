<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="col-md-12">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3 text-left">
                <?php if (!empty($result)): ?>
                    <h4 class="text-success mb-4"><?php echo $result; ?></h4>
                <?php endif; ?>
                <h4><?php echo $LOGIN_FORM_TITLE; ?></h4>
                <form id="loginForm">
                    <div class="form-row text-danger">
                        <div class="col-md-12 mb-3" id="errorsBlock"></div>
                    </div>
                    <div class="form-group mt-2" style="height: 80px">
                        <label><?php echo $USERNAME; ?></label>
                        <input type="text" name="username" class="form-control" id="usernameLogin"/>
                        <div></div>
                    </div>
                    <div class="form-group" style="height: 80px">
                        <label><?php echo $PASSWORD; ?></label>
                        <input type="password" name="password" class="form-control" id="passwordLogin"/>
                        <div></div>
                    </div>
                    <button id="loginSubmit" class="btn btn-success float-right"><?php echo $LOGIN_SUBMIT; ?></button>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="../public/js/login/loginValidation.js"></script>

<?php include ROOT . '/views/layouts/footer.php'; ?>

