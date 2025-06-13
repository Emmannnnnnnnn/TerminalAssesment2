<?= $this->include('templates/header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Students</li>
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
                            <h3 class="card-title">All Students</h3>
                            <div class="card-tools">
                                <a href="<?= site_url('students/add') ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add Student
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

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover data-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Course</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($students as $student): ?>
                                        <tr>
                                            <td><?= $student['id'] ?></td>
                                            <td class="text-center">
                                                <?php 
                                                // Determine the image source
                                                $imageSrc = base_url('assets/images/default-avatar.png'); // Default local avatar
                                                $imageAlt = 'Default Avatar';

                                                if (!empty($student['profile_photo']) && file_exists(FCPATH . 'uploads/students/' . $student['profile_photo'])) {
                                                    $imageSrc = base_url('uploads/students/' . $student['profile_photo']);
                                                    $imageAlt = $student['first_name'] . ' ' . $student['last_name'];
                                                } else {
                                                    // Fallback to ui-avatars if no photo and no local default avatar
                                                    if (!file_exists(FCPATH . 'assets/images/default-avatar.png')) {
                                                        $imageSrc = 'https://ui-avatars.com/api/?name=' . urlencode($student['first_name'].' '.$student['last_name']) . '&background=random&size=64';
                                                    }
                                                }
                                                ?>
                                                <img src="<?= $imageSrc ?>" alt="<?= $imageAlt ?>"
                                                    class="img-circle img-size-32"
                                                    style="width: 32px; height: 32px; object-fit: cover; cursor: pointer;"
                                                    onclick="showImageModal('<?= $imageSrc ?>', '<?= esc($student['first_name'] . ' ' . $student['last_name']) ?>')"
                                                    onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($student['first_name'].' '.$student['last_name']) ?>&background=random&size=64'">
                                            </td>
                                            <td>
                                                <strong><?= $student['first_name'] ?>
                                                    <?= $student['last_name'] ?></strong>
                                            </td>
                                            <td><?= $student['age'] ?></td>
                                            <td>
                                                <span class="badge badge-info">
                                                    <?= $student['course_name'] ?> (<?= $student['course_code'] ?>)
                                                </span>
                                            </td>
                                            <td>
                                                <a href="mailto:<?= $student['email'] ?>" class="text-primary">
                                                    <?= $student['email'] ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="tel:<?= $student['phone'] ?>" class="text-success">
                                                    <?= $student['phone'] ?>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?= site_url('students/view/'.$student['id']) ?>"
                                                        class="btn btn-sm btn-info" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?= site_url('students/edit/'.$student['id']) ?>"
                                                        class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?= site_url('students/delete/'.$student['id']) ?>"
                                                        class="btn btn-sm btn-danger" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this student?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
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
        </div>
    </section>
</div>
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Student Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid" style="max-height: 400px;">
            </div>
        </div>
    </div>
</div>

<script>
// Function to show image in modal
function showImageModal(imageSrc, studentName) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalImage').alt = studentName;
    document.getElementById('imageModalLabel').textContent = studentName + ' - Photo';
    $('#imageModal').modal('show');
}

// Initialize DataTable with custom settings
$(document).ready(function() {
    $('.data-table').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "ordering": true,
        "info": true,
        "paging": true,
        "searching": true,
        "pageLength": 10,
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "language": {
            "search": "Search students:",
            "lengthMenu": "Show _MENU_ students per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ students",
            "infoEmpty": "No students found",
            "infoFiltered": "(filtered from _MAX_ total students)",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        },
        "columnDefs": [{
                "targets": [1], // Photo column
                "orderable": false,
                "searchable": false
            },
            {
                "targets": [7], // Actions column
                "orderable": false,
                "searchable": false
            }
        ],
        "order": [
            [0, 'asc']
        ] // Default sort by ID
    });
});
</script>

<style>
/* Custom styles for better image display */
.img-circle {
    border-radius: 50%;
    border: 2px solid #dee2e6;
    transition: all 0.3s ease;
}

.img-circle:hover {
    border-color: #007bff;
    transform: scale(1.1);
}

/* Responsive table improvements */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 12px;
    }

    .btn-group .btn {
        padding: 0.25rem 0.4rem;
        font-size: 0.75rem;
    }
}

/* Badge improvements */
.badge-info {
    background-color: #17a2b8;
    font-size: 0.75em;
}

/* Modal improvements */
.modal-body img {
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>

<?= $this->include('templates/footer') ?>