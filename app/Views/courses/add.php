<?= $this->include('templates/header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add New Course</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('courses') ?>">Courses</a></li>
                        <li class="breadcrumb-item active">Add</li>
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
                            <h3 class="card-title">Course Information</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('courses/store') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label for="course_name">Course Name</label>
                                    <input type="text"
                                        class="form-control <?= ($validation->hasError('course_name')) ? 'is-invalid' : '' ?>"
                                        id="course_name" name="course_name" value="<?= old('course_name') ?>"
                                        placeholder="Enter course name">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('course_name') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="course_code">Course Code</label>
                                    <input type="text"
                                        class="form-control <?= ($validation->hasError('course_code')) ? 'is-invalid' : '' ?>"
                                        id="course_code" name="course_code" value="<?= old('course_code') ?>"
                                        placeholder="Enter course code">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('course_code') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea
                                        class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : '' ?>"
                                        id="description" name="description" rows="3"
                                        placeholder="Enter description"><?= old('description') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('description') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="<?= site_url('courses') ?>" class="btn btn-default">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->include('templates/footer') ?>