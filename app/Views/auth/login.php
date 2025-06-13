<?= $this->include('templates/header') ?>

<div class="hold-transition login-page"
    style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); min-height: 100vh;">
    <div class="login-box">
        <div class="login-logo mb-4">
            <a href="<?= site_url() ?>" style="color: white; text-decoration: none;">
                <i class="fas fa-graduation-cap mr-2"></i>
                <b style="font-weight: 700;">Student</b>Management
            </a>
        </div>

        <div class="card"
            style="border-radius: 10px; overflow: hidden; background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
            <div class="card-body login-card-body p-4">
                <h4 class="text-center mb-4" style="color: white;">Sign in to your account</h4>

                <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible"
                    style="background-color: rgba(220, 38, 38, 0.2); border-left: 4px solid #dc2626; color: white; border: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                        style="color: white;">×</button>
                    <?= session()->getFlashdata('error') ?>
                </div>
                <?php endif; ?>

                <form action="<?= site_url('authenticate') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="input-group mb-3">
                        <input type="email"
                            class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                            name="email" placeholder="Email" value="<?= old('email') ?>"
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
                            name="password" placeholder="Password"
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

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember" style="color: #94a3b8;">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"
                                style="background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%); border: none;">Sign
                                In</button>
                        </div>
                    </div>
                </form>

                <div class="social-auth-links text-center mt-4 mb-3">
                    <p class="mb-2" style="color: #94a3b8;">- OR -</p>
                    <a href="#" class="btn btn-block btn-outline-light mb-2"
                        style="border-color: rgba(255, 255, 255, 0.2);">
                        <i class="fab fa-google mr-2"></i> Sign in with Google
                    </a>
                </div>

                <p class="mb-1 text-center">
                    <a href="forgot-password.html" style="color: #94a3b8;">I forgot my password</a>
                </p>
                <p class="mb-0 text-center">
                    <a href="<?= site_url('register') ?>" style="color: white;">Register a new membership</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>