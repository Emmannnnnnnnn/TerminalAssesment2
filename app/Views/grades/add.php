<?= $this->include('templates/header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add New Grade</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('grades') ?>">Grades</a></li>
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
                            <h3 class="card-title">Grade Information</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('grades/store') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label for="student_id">Student</label>
                                    <select
                                        class="form-control select2 <?= ($validation->hasError('student_id')) ? 'is-invalid' : '' ?>"
                                        id="student_id" name="student_id">
                                        <option value="">Select Student</option>
                                        <?php foreach ($students as $student): ?>
                                        <option value="<?= $student['id'] ?>"
                                            <?= old('student_id') == $student['id'] ? 'selected' : '' ?>>
                                            <?= $student['first_name'] ?> <?= $student['last_name'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('student_id') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="course_id">Course</label>
                                    <select
                                        class="form-control select2 <?= ($validation->hasError('course_id')) ? 'is-invalid' : '' ?>"
                                        id="course_id" name="course_id">
                                        <option value="">Select Course</option>
                                        <?php foreach ($courses as $course): ?>
                                        <option value="<?= $course['id'] ?>"
                                            <?= old('course_id') == $course['id'] ? 'selected' : '' ?>>
                                            <?= $course['course_name'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('course_id') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="grade">Grade</label>
                                    <input type="number" step="0.01"
                                        class="form-control <?= ($validation->hasError('grade')) ? 'is-invalid' : '' ?>"
                                        id="grade" name="grade" value="<?= old('grade') ?>"
                                        placeholder="Enter grade (0-100)">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('grade') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <input type="text"
                                        class="form-control <?= ($validation->hasError('semester')) ? 'is-invalid' : '' ?>"
                                        id="semester" name="semester" value="<?= old('semester') ?>"
                                        placeholder="Enter semester (e.g., Fall 2023)">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('semester') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="<?= site_url('grades') ?>" class="btn btn-default">Cancel</a>
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