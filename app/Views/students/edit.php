<?= $this->include('templates/header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Student</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('students') ?>">Students</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Student Information</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('students/update/'.$student['id']) ?>" method="post"
                                enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="profile_photo">Profile Photo</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="photo-preview mb-3">
                                                        <?php 
                                                        $currentPhotoPath = 'uploads/students/' . $student['profile_photo'];
                                                        $imageSrc = base_url('assets/images/default-avatar.png'); // Default local avatar

                                                        if (!empty($student['profile_photo']) && file_exists(FCPATH . $currentPhotoPath)) {
                                                            $imageSrc = base_url($currentPhotoPath);
                                                        }
                                                        ?>
                                                        <img id="photo-preview" src="<?= $imageSrc ?>"
                                                            alt="Profile Preview" class="img-thumbnail"
                                                            style="width: 150px; height: 150px; object-fit: cover;">
                                                    </div>
                                                    <?php if (!empty($student['profile_photo'])): ?>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="remove_photo" name="remove_photo" value="1">
                                                        <label class="form-check-label" for="remove_photo">
                                                            Remove current photo
                                                        </label>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            class="custom-file-input <?= ($validation->hasError('profile_photo')) ? 'is-invalid' : '' ?>"
                                                            id="profile_photo" name="profile_photo" accept="image/*">
                                                        <label class="custom-file-label" for="profile_photo">
                                                            <?= !empty($student['profile_photo']) ? 'Choose new photo...' : 'Choose photo...' ?>
                                                        </label>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('profile_photo') ?>
                                                        </div>
                                                    </div>
                                                    <small class="form-text text-muted">
                                                        Allowed formats: JPG, JPEG, PNG, GIF. Maximum size: 2MB<br>
                                                        <?php if (!empty($student['profile_photo'])): ?>
                                                        Current photo: <?= $student['profile_photo'] ?>
                                                        <?php endif; ?>
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
                                                id="first_name" name="first_name"
                                                value="<?= old('first_name', $student['first_name']) ?>"
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
                                                id="last_name" name="last_name"
                                                value="<?= old('last_name', $student['last_name']) ?>"
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
                                                id="age" name="age" value="<?= old('age', $student['age']) ?>"
                                                placeholder="Enter age">
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
                                                    <?= old('course_id', $student['course_id']) == $course['id'] ? 'selected' : '' ?>>
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
                                        id="email" name="email" value="<?= old('email', $student['email']) ?>"
                                        placeholder="Enter email">
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
                                                id="phone" name="phone" value="<?= old('phone', $student['phone']) ?>"
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
                                        placeholder="Enter address"><?= old('address', $student['address']) ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('address') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="<?= site_url('students') ?>" class="btn btn-default">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
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

        // Uncheck remove photo checkbox if new photo is selected
        const removeCheckbox = document.getElementById('remove_photo');
        if (removeCheckbox) {
            removeCheckbox.checked = false;
        }
    } else {
        // If no file is selected, reset the label to "Choose photo..."
        const label = document.querySelector('.custom-file-label');
        label.textContent = 'Choose photo...';
    }
});

// Handle remove photo checkbox
const removeCheckbox = document.getElementById('remove_photo');
if (removeCheckbox) {
    removeCheckbox.addEventListener('change', function(e) {
        const photoPreview = document.getElementById('photo-preview');
        const fileInput = document.getElementById('profile_photo');
        const fileLabel = document.querySelector('.custom-file-label');

        if (e.target.checked) {
            // Show default avatar when remove is checked
            photoPreview.src = '<?= base_url('assets/images/default-avatar.png') ?>'; // Corrected path
            // Clear file input
            fileInput.value = '';
            fileLabel.textContent = 'Choose photo...';
        } else {
            // Restore original photo if checkbox is unchecked and there was a current photo
            const currentStudentPhoto =
                '<?= !empty($student['profile_photo']) ? base_url('uploads/students/' . $student['profile_photo']) : base_url('assets/images/default-avatar.png') ?>';
            photoPreview.src = currentStudentPhoto;
            fileLabel.textContent =
                '<?= !empty($student['profile_photo']) ? 'Choose new photo...' : 'Choose photo...' ?>';
        }
    });
}
</script>

<?= $this->include('templates/footer') ?>