<?= $this->include('templates/header') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add New Student</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('students') ?>">Students</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="<?= site_url('students/store') ?>" method="post"
                                enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <!-- Profile Photo Section -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="profile_photo">Profile Photo</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="photo-preview mb-3">
                                                        <img id="photo-preview"
                                                            src="<?= base_url('assets/images/default-avatar.png') ?>"
                                                            alt="Profile Preview" class="img-thumbnail"
                                                            style="width: 150px; height: 150px; object-fit: cover;">
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            class="custom-file-input <?= ($validation->hasError('profile_photo')) ? 'is-invalid' : '' ?>"
                                                            id="profile_photo" name="profile_photo" accept="image/*">
                                                        <label class="custom-file-label" for="profile_photo">Choose
                                                            photo...</label>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('profile_photo') ?>
                                                        </div>
                                                    </div>
                                                    <small class="form-text text-muted">
                                                        Allowed formats: JPG, JPEG, PNG, GIF. Maximum size: 2MB
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text"
                                                class="form-control <?= ($validation->hasError('first_name')) ? 'is-invalid' : '' ?>"
                                                id="first_name" name="first_name" value="<?= old('first_name') ?>"
                                                placeholder="Enter first name">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('first_name') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text"
                                                class="form-control <?= ($validation->hasError('last_name')) ? 'is-invalid' : '' ?>"
                                                id="last_name" name="last_name" value="<?= old('last_name') ?>"
                                                placeholder="Enter last name">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('last_name') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="number"
                                                class="form-control <?= ($validation->hasError('age')) ? 'is-invalid' : '' ?>"
                                                id="age" name="age" value="<?= old('age') ?>" placeholder="Enter age">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('age') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course_id">Course</label>
                                            <select
                                                class="form-control select2 <?= ($validation->hasError('course_id')) ? 'is-invalid' : '' ?>"
                                                id="course_id" name="course_id">
                                                <option value="">Select Course</option>
                                                <?php foreach ($courses as $course): ?>
                                                <option value="<?= $course['id'] ?>"
                                                    <?= old('course_id') == $course['id'] ? 'selected' : '' ?>>
                                                    <?= $course['course_name'] ?> (<?= $course['course_code'] ?>)
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('course_id') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email"
                                        class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                                        id="email" name="email" value="<?= old('email') ?>" placeholder="Enter email">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email') ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text"
                                                class="form-control <?= ($validation->hasError('phone')) ? 'is-invalid' : '' ?>"
                                                id="phone" name="phone" value="<?= old('phone') ?>"
                                                placeholder="Enter phone number">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('phone') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea
                                        class="form-control <?= ($validation->hasError('address')) ? 'is-invalid' : '' ?>"
                                        id="address" name="address" rows="3"
                                        placeholder="Enter address"><?= old('address') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('address') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="<?= site_url('students') ?>" class="btn btn-default">Cancel</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
// Photo preview functionality
document.getElementById('profile_photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photo-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);

        // Update the label text
        const fileName = file.name;
        const label = document.querySelector('.custom-file-label');
        label.textContent = fileName;
    }
});
</script>

<?= $this->include('templates/footer') ?>