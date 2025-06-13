<?= $this->include('templates/header') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: white;">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active" style="color: #94a3b8;">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box"
                        style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; border-radius: 10px;">
                        <div class="inner">
                            <h3><?= $studentCount ?></h3>
                            <p>Students</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="<?= site_url('students') ?>" class="small-box-footer"
                            style="background: rgba(0,0,0,0.1); color: white;">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box"
                        style="background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%); color: white; border-radius: 10px;">
                        <div class="inner">
                            <h3><?= $courseCount ?></h3>
                            <p>Courses</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <a href="<?= site_url('courses') ?>" class="small-box-footer"
                            style="background: rgba(0,0,0,0.1); color: white;">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box"
                        style="background: linear-gradient(135deg, #FF512F 0%, #DD2476 100%); color: white; border-radius: 10px;">
                        <div class="inner">
                            <h3><?= $gradeCount ?></h3>
                            <p>Grades</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <a href="<?= site_url('grades') ?>" class="small-box-footer"
                            style="background: rgba(0,0,0,0.1); color: white;">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box"
                        style="background: linear-gradient(135deg, #1D976C 0%, #93F9B9 100%); color: white; border-radius: 10px;">
                        <div class="inner">
                            <h3><?= $attendanceCount ?></h3>
                            <p>Attendance Records</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <a href="<?= site_url('attendance') ?>" class="small-box-footer"
                            style="background: rgba(0,0,0,0.1); color: white;">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Recent Students -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="color: white;">Recent Students</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    style="color: white;">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <?php foreach ($recentStudents as $student): ?>
                                <li class="item"
                                    style="background-color: rgba(255, 255, 255, 0.03); border-radius: 5px; margin-bottom: 5px;">
                                    <div class="product-img">
                                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($student['first_name'].' '.$student['last_name']) ?>&background=random"
                                            alt="Student Image" class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <a href="<?= site_url('students/edit/'.$student['id']) ?>" class="product-title"
                                            style="color: white;">
                                            <?= $student['first_name'] ?> <?= $student['last_name'] ?>
                                            <span class="badge badge-info float-right"
                                                style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);"><?= $student['age'] ?>
                                                yrs</span>
                                        </a>
                                        <span class="product-description" style="color: #94a3b8;">
                                            <?= $student['email'] ?>
                                        </span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="<?= site_url('students') ?>" class="uppercase" style="color: #7c3aed;">View All
                                Students</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->

                <!-- right col -->
                <section class="col-lg-5 connectedSortable">
                    <!-- Recent Attendance -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="color: white;">Recent Attendance</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    style="color: white;">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <?php foreach ($recentAttendance as $record): ?>
                                <li class="item"
                                    style="background-color: rgba(255, 255, 255, 0.03); border-radius: 5px; margin-bottom: 5px;">
                                    <div class="product-img">
                                        <?php 
                                        $badgeClass = '';
                                        if ($record['status'] == 'Present') $badgeClass = 'success';
                                        elseif ($record['status'] == 'Absent') $badgeClass = 'danger';
                                        else $badgeClass = 'warning';
                                        ?>
                                        <span
                                            class="img-size-50 rounded-circle d-flex align-items-center justify-content-center mt-3"
                                            style="background: linear-gradient(135deg, <?= $badgeClass == 'success' ? '#10b981' : ($badgeClass == 'danger' ? '#ef4444' : '#f59e0b') ?> 0%, <?= $badgeClass == 'success' ? '#059669' : ($badgeClass == 'danger' ? '#dc2626' : '#d97706') ?> 100%);">
                                            <i
                                                class="fas fa-<?= $record['status'] == 'Present' ? 'check' : ($record['status'] == 'Absent' ? 'times' : 'clock') ?>"></i>
                                        </span>
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title" style="color: white;">
                                            <?= $record['date'] ?>
                                            <span class="badge float-right"
                                                style="background: linear-gradient(135deg, <?= $badgeClass == 'success' ? '#10b981' : ($badgeClass == 'danger' ? '#ef4444' : '#f59e0b') ?> 0%, <?= $badgeClass == 'success' ? '#059669' : ($badgeClass == 'danger' ? '#dc2626' : '#d97706') ?> 100%);"><?= $record['status'] ?></span>
                                        </a>
                                        <span class="product-description" style="color: #94a3b8;">
                                            <?= $record['remarks'] ?: 'No remarks' ?>
                                        </span>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="<?= site_url('attendance') ?>" class="uppercase" style="color: #7c3aed;">View All
                                Attendance</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->include('templates/footer') ?>