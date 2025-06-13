<?= $this->include('templates/header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Attendance Record</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('attendance') ?>">Attendance</a></li>
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
                            <h3 class="card-title">Attendance Information</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('attendance/store') ?>" method="post">
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
                                    <label for="date">Date</label>
                                    <input type="text"
                                        class="form-control datepicker <?= ($validation->hasError('date')) ? 'is-invalid' : '' ?>"
                                        id="date" name="date" value="<?= old('date') ?>" placeholder="Select date"
                                        autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('date') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select
                                        class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : '' ?>"
                                        id="status" name="status">
                                        <option value="">Select Status</option>
                                        <option value="Present" <?= old('status') == 'Present' ? 'selected' : '' ?>>
                                            Present</option>
                                        <option value="Absent" <?= old('status') == 'Absent' ? 'selected' : '' ?>>Absent
                                        </option>
                                        <option value="Late" <?= old('status') == 'Late' ? 'selected' : '' ?>>Late
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('status') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea class="form-control" id="remarks" name="remarks" rows="2"
                                        placeholder="Enter remarks (optional)"><?= old('remarks') ?></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="<?= site_url('attendance') ?>" class="btn btn-default">Cancel</a>
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