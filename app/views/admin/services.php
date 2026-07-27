<?php
ob_start();
session_start();

// Page Title
$pageTitle = 'Services';

// Includes (Jalur Path Sesuai Struktur Folder Lu)
include '../../models/connect.php';
include '../../../config/Includes/functions/functions.php';
include '../../../config/Includes/templates/admin-header.php';

// Extra JS Files
echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";

// Check If user is already logged in
if (isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4'])) {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Services</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i>
                Generate Report
            </a>
        </div>
        
        <?php
        $do = isset($_GET['do']) && in_array($_GET['do'], array('Add', 'Edit')) ? htmlspecialchars($_GET['do']) : 'Manage';

        /* -------------------------------------------------------------------------- */
        /*                                MANAGE PAGE                                 */
        /* -------------------------------------------------------------------------- */
        if ($do == 'Manage') {
            $stmt = $con->prepare("SELECT s.*, sc.category_name 
                                   FROM services s 
                                   INNER JOIN service_categories sc ON s.category_id = sc.category_id");
            $stmt->execute();
            $rows_services = $stmt->fetchAll();
        ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Services</h6>
                </div>
                <div class="card-body">

                    <!-- ADD NEW SERVICE BUTTON -->
                    <a href="services.php?do=Add" class="btn btn-success btn-sm mb-3">
                        <i class="fa fa-plus"></i> Add Service
                    </a>

                    <!-- SERVICES TABLE -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Service Name</th>
                                    <th scope="col">Service Category</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Duration (min)</th>
                                    <th scope="col">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows_services as $service): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($service['service_name']); ?></td>
                                        <td><?php echo htmlspecialchars($service['category_name']); ?></td>
                                        <td style="width:30%"><?php echo htmlspecialchars($service['service_description']); ?></td>
                                        <td>$<?php echo htmlspecialchars($service['service_price']); ?></td>
                                        <td><?php echo htmlspecialchars($service['service_duration']); ?> min</td>
                                        <td>
                                            <?php $delete_modal_id = "delete_" . $service["service_id"]; ?>
                                            <ul class="list-inline m-0">
                                                <li class="list-inline-item" data-toggle="tooltip" title="Edit">
                                                    <a href="services.php?do=Edit&service_id=<?php echo $service['service_id']; ?>" class="btn btn-success btn-sm rounded-0">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-toggle="tooltip" title="Delete">
                                                    <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $delete_modal_id; ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade" id="<?php echo $delete_modal_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Service</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete the service "<strong><?php echo htmlspecialchars($service['service_name']); ?></strong>"?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button type="button" data-id="<?php echo $service['service_id']; ?>" class="btn btn-danger delete_service_bttn">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <?php
        /* -------------------------------------------------------------------------- */
        /*                                  ADD PAGE                                  */
        /* -------------------------------------------------------------------------- */
        } elseif ($do == 'Add') {
            $flag_add_service_form = 0;

            if (isset($_POST['add_new_service'])) {
                if (empty(test_input($_POST['service_name'])) || 
                    empty(test_input($_POST['service_duration'])) || 
                    !ctype_digit(test_input($_POST['service_duration'])) || 
                    empty(test_input($_POST['service_price'])) || 
                    !is_numeric(test_input($_POST['service_price'])) || 
                    empty(test_input($_POST['service_description'])) || 
                    strlen(test_input($_POST['service_description'])) > 250) {
                    $flag_add_service_form = 1;
                }
            }
        ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add New Service</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="services.php?do=Add">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_name">Service Name</label>
                                    <input type="text" class="form-control" value="<?php echo isset($_POST['service_name']) ? htmlspecialchars($_POST['service_name']) : ''; ?>" placeholder="Service Name" name="service_name">
                                    <?php if (isset($_POST['add_new_service']) && empty(test_input($_POST['service_name']))): ?>
                                        <div class="invalid-feedback d-block">Service name is required.</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $stmt = $con->prepare("SELECT * FROM service_categories");
                                $stmt->execute();
                                $rows_categories = $stmt->fetchAll();
                                ?>
                                <div class="form-group">
                                    <label for="service_category">Service Category</label>
                                    <select class="custom-select" name="service_category">
                                        <?php foreach ($rows_categories as $category): ?>
                                            <option value="<?php echo $category['category_id']; ?>">
                                                <?php echo htmlspecialchars($category['category_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_duration">Service Duration (min)</label>
                                    <input type="text" class="form-control" value="<?php echo isset($_POST['service_duration']) ? htmlspecialchars($_POST['service_duration']) : ''; ?>" placeholder="Service Duration" name="service_duration">
                                    <?php if (isset($_POST['add_new_service'])): ?>
                                        <?php if (empty(test_input($_POST['service_duration']))): ?>
                                            <div class="invalid-feedback d-block">Service duration is required.</div>
                                        <?php elseif (!ctype_digit(test_input($_POST['service_duration']))): ?>
                                            <div class="invalid-feedback d-block">Invalid duration. Must be an integer.</div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_price">Service Price ($)</label>
                                    <input type="text" class="form-control" value="<?php echo isset($_POST['service_price']) ? htmlspecialchars($_POST['service_price']) : ''; ?>" placeholder="Service Price" name="service_price">
                                    <?php if (isset($_POST['add_new_service'])): ?>
                                        <?php if (empty(test_input($_POST['service_price']))): ?>
                                            <div class="invalid-feedback d-block">Service price is required.</div>
                                        <?php elseif (!is_numeric(test_input($_POST['service_price']))): ?>
                                            <div class="invalid-feedback d-block">Invalid price format.</div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="service_description">Service Description</label>
                                    <textarea class="form-control" name="service_description" style="resize: none;"><?php echo isset($_POST['service_description']) ? htmlspecialchars($_POST['service_description']) : ''; ?></textarea>
                                    <?php if (isset($_POST['add_new_service'])): ?>
                                        <?php if (empty(test_input($_POST['service_description']))): ?>
                                            <div class="invalid-feedback d-block">Service description is required.</div>
                                        <?php elseif (strlen(test_input($_POST['service_description'])) > 250): ?>
                                            <div class="invalid-feedback d-block">Length must be under 250 characters.</div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="add_new_service" class="btn btn-primary">Add Service</button>
                    </form>

                    <?php
                    if (isset($_POST['add_new_service']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $flag_add_service_form == 0) {
                        $service_name = test_input($_POST['service_name']);
                        $service_category = $_POST['service_category'];
                        $service_duration = test_input($_POST['service_duration']);
                        $service_price = test_input($_POST['service_price']);
                        $service_description = test_input($_POST['service_description']);

                        try {
                            $stmt = $con->prepare("INSERT INTO services(service_name, service_description, service_price, service_duration, category_id) VALUES (?, ?, ?, ?, ?)");
                            $stmt->execute(array($service_name, $service_description, $service_price, $service_duration, $service_category));
                            ?>
                            <script type="text/javascript">
                                swal("New Service", "The new service has been created successfully", "success").then(() => {
                                    window.location.replace("services.php");
                                });
                            </script>
                            <?php
                        } catch (Exception $e) {
                            echo "<div class='alert alert-danger mt-3'>Error occurred: " . $e->getMessage() . "</div>";
                        }
                    }
                    ?>
                </div>
            </div>

        <?php
        /* -------------------------------------------------------------------------- */
        /*                                 EDIT PAGE                                  */
        /* -------------------------------------------------------------------------- */
        } elseif ($do == "Edit") {
            $service_id = (isset($_GET['service_id']) && is_numeric($_GET['service_id'])) ? intval($_GET['service_id']) : 0;

            if ($service_id) {
                $stmt = $con->prepare("SELECT * FROM services WHERE service_id = ?");
                $stmt->execute(array($service_id));
                $service = $stmt->fetch();
                $count = $stmt->rowCount();

                if ($count > 0) {
                    $flag_edit_service_form = 0;

                    if (isset($_POST['edit_service_sbmt'])) {
                        if (empty(test_input($_POST['service_name'])) || 
                            empty(test_input($_POST['service_duration'])) || 
                            !ctype_digit(test_input($_POST['service_duration'])) || 
                            empty(test_input($_POST['service_price'])) || 
                            !is_numeric(test_input($_POST['service_price'])) || 
                            empty(test_input($_POST['service_description'])) || 
                            strlen(test_input($_POST['service_description'])) > 250) {
                            $flag_edit_service_form = 1;
                        }
                    }
                    ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Service</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="services.php?do=Edit&service_id=<?php echo $service_id; ?>">
                                <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_name">Service Name</label>
                                            <input type="text" class="form-control" value="<?php echo isset($_POST['service_name']) ? htmlspecialchars($_POST['service_name']) : htmlspecialchars($service['service_name']); ?>" name="service_name">
                                            <?php if (isset($_POST['edit_service_sbmt']) && empty(test_input($_POST['service_name']))): ?>
                                                <div class="invalid-feedback d-block">Service name is required.</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                        $stmt = $con->prepare("SELECT * FROM service_categories");
                                        $stmt->execute();
                                        $rows_categories = $stmt->fetchAll();
                                        ?>
                                        <div class="form-group">
                                            <label for="service_category">Service Category</label>
                                            <select class="custom-select" name="service_category">
                                                <?php foreach ($rows_categories as $category): ?>
                                                    <option value="<?php echo $category['category_id']; ?>" <?php echo ($category['category_id'] == $service['category_id']) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($category['category_name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_duration">Service Duration (min)</label>
                                            <input type="text" class="form-control" value="<?php echo isset($_POST['service_duration']) ? htmlspecialchars($_POST['service_duration']) : htmlspecialchars($service['service_duration']); ?>" name="service_duration">
                                            <?php if (isset($_POST['edit_service_sbmt'])): ?>
                                                <?php if (empty(test_input($_POST['service_duration']))): ?>
                                                    <div class="invalid-feedback d-block">Service duration is required.</div>
                                                <?php elseif (!ctype_digit(test_input($_POST['service_duration']))): ?>
                                                    <div class="invalid-feedback d-block">Invalid duration. Must be an integer.</div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_price">Service Price ($)</label>
                                            <input type="text" class="form-control" value="<?php echo isset($_POST['service_price']) ? htmlspecialchars($_POST['service_price']) : htmlspecialchars($service['service_price']); ?>" name="service_price">
                                            <?php if (isset($_POST['edit_service_sbmt'])): ?>
                                                <?php if (empty(test_input($_POST['service_price']))): ?>
                                                    <div class="invalid-feedback d-block">Service price is required.</div>
                                                <?php elseif (!is_numeric(test_input($_POST['service_price']))): ?>
                                                    <div class="invalid-feedback d-block">Invalid price format.</div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="service_description">Service Description</label>
                                            <textarea class="form-control" name="service_description" style="resize: none;"><?php echo isset($_POST['service_description']) ? htmlspecialchars($_POST['service_description']) : htmlspecialchars($service['service_description']); ?></textarea>
                                            <?php if (isset($_POST['edit_service_sbmt'])): ?>
                                                <?php if (empty(test_input($_POST['service_description']))): ?>
                                                    <div class="invalid-feedback d-block">Service description is required.</div>
                                                <?php elseif (strlen(test_input($_POST['service_description'])) > 250): ?>
                                                    <div class="invalid-feedback d-block">Length must be under 250 characters.</div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="edit_service_sbmt" class="btn btn-primary">Save Changes</button>
                            </form>

                            <?php
                            if (isset($_POST['edit_service_sbmt']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $flag_edit_service_form == 0) {
                                $service_name = test_input($_POST['service_name']);
                                $service_category = $_POST['service_category'];
                                $service_duration = test_input($_POST['service_duration']);
                                $service_price = test_input($_POST['service_price']);
                                $service_description = test_input($_POST['service_description']);

                                try {
                                    $stmt = $con->prepare("UPDATE services SET service_name = ?, service_description = ?, service_price = ?, service_duration = ?, category_id = ? WHERE service_id = ?");
                                    $stmt->execute(array($service_name, $service_description, $service_price, $service_duration, $service_category, $service_id));
                                    ?>
                                    <script type="text/javascript">
                                        swal("Service Updated", "The service details were updated successfully", "success").then(() => {
                                            window.location.replace("services.php");
                                        });
                                    </script>
                                    <?php
                                } catch (Exception $e) {
                                    echo "<div class='alert alert-danger mt-3'>Error occurred: " . $e->getMessage() . "</div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "<div class='alert alert-danger'>Service ID not found.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Invalid Service ID.</div>";
            }
        }
        ?>
    </div>

<?php
    include '../../../config/Includes/templates/admin-footer.php';
} else {
    header('Location: index.php');
    exit();
}
ob_end_flush();
?>