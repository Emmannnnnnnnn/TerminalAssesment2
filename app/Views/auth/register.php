<?= $this->include('templates/header') ?>

<div class="hold-transition register-page"
    style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); min-height: 100vh;">
    <div class="register-box">
        <div class="register-logo mb-4">
            <a href="<?= site_url() ?>" style="color: white; text-decoration: none;">
                <i class="fas fa-graduation-cap mr-2"></i>
                <b style="font-weight: 700;">Student</b>Management
            </a>
        </div>

        <div class="card"
            style="border-radius: 10px; overflow: hidden; background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
            <div class="card-body register-card-body p-4">
                <h4 class="text-center mb-4" style="color: white;">Register a new membership</h4>

                <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success alert-dismissible"
                    style="background-color: rgba(5, 150, 105, 0.2); border-left: 4px solid #059669; color: white; border: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                        style="color: white;">×</button>
                    <?= session()->getFlashdata('message') ?>
                </div>
                <?php endif; ?>

                <form action="<?= site_url('register/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="input-group mb-3">
                        <input type="text"
                            class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                            id="username" name="username" value="<?= old('username') ?>" placeholder="Username"
                            style="background-color: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); color: white;">
                        <div class="input-group-append">
                            <div class="input-group-text"
                                style="background-color: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1);">
                                <span class="fas fa-user" style="color: white;"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('username') ?>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email"
                            class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email"
                            name="email" value="<?= old('email') ?>" placeholder="Email"
                            style="background-color: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); color: white;">
                        <div class="input-group-append">
                            <div class="input-group-text"
                                style="background-color: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1);">
                                <span class="fas fa-envelope" style="color: white;"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('email') ?>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password"
                            class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                            id="password" name="password" placeholder="Password"
                            style="background-color: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); color: white;">
                        <div class="input-group-append">
                            <div class="input-group-text"
                                style="background-color: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1);">
                                <span class="fas fa-lock" style="color: white;"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('password') ?>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password"
                            class="form-control <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : '' ?>"
                            id="confirm_password" name="confirm_password" placeholder="Retype password"
                            style="background-color: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); color: white;">
                        <div class="input-group-append">
                            <div class="input-group-text"
                                style="background-color: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1);">
                                <span class="fas fa-lock" style="color: white;"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('confirm_password') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms" style="color: #94a3b8;">
                                    I agree to the <a href="#" style="color: #7c3aed;">terms</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"
                                style="background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%); border: none;">
                                Register
                            </button>
                        </div>
                    </div>
                </form>

                <p class="mb-0 text-center mt-3">
                    <a href="<?= site_url('login') ?>" class="text-white">
                        <i class="fas fa-sign-in-alt mr-1"></i> I already have a membership
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>