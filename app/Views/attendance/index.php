<?= $this->include('templates/header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Attendance Records</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
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
                            <h3 class="card-title">All Attendance Records</h3>
                            <div class="card-tools">
                                <a href="<?= site_url('attendance/add') ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add Record
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('message')): ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                <?= session()->getFlashdata('message') ?>
                            </div>
                            <?php endif; ?>

                            <table class="table table-bordered table-hover data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Student</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($attendance as $record): ?>
                                    <tr>
                                        <td><?= $record['id'] ?></td>
                                        <td><?= $record['first_name'] ?> <?= $record['last_name'] ?></td>
                                        <td><?= date('M d, Y', strtotime($record['date'])) ?></td>
                                        <td>
                                            <?php 
                                            $badgeClass = '';
                                            if ($record['status'] == 'Present') $badgeClass = 'success';
                                            elseif ($record['status'] == 'Absent') $badgeClass = 'danger';
                                            else $badgeClass = 'warning';
                                            ?>
                                            <span class="badge badge-<?= $badgeClass ?>"><?= $record['status'] ?></span>
                                        </td>
                                        <td><?= $record['remarks'] ?: 'N/A' ?></td>
                                        <td>
                                            <a href="<?= site_url('attendance/edit/'.$record['id']) ?>"
                                                class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= site_url('attendance/delete/'.$record['id']) ?>"
                                                class="btn btn-sm btn-danger" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this attendance record?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->include('templates/footer') ?>