<?php 
    session_start();

    // Check if user is already logged in
    if(isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4']))
    {
        // Page Title
        $pageTitle = 'Dashboard';

        // Includes
        include '../../models/connect.php';
        include '../../../config/Includes/functions/functions.php';
        include '../../../config/Includes/templates/admin-header.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i>
                Generate Report
            </a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Clients</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo countItems("client_id","clients")?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bs bs-boy fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Services</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo countItems("service_id","services")?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bs bs-scissors-1 fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Employees</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo countItems("employee_id","employees")?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bs bs-man fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Appointments</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo countItems("appointment_id","appointments")?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Tables -->
        <div class="card shadow mb-4">
            <div class="card-header tab" style="padding: 0px !important; background: #36b9cc !important;">
                <button class="tablinks active" onclick="openTab(event, 'Upcoming')">Upcoming Bookings</button>
                <button class="tablinks" onclick="openTab(event, 'All')">All Bookings</button>
                <button class="tablinks" onclick="openTab(event, 'Canceled')">Canceled Bookings</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    
                    <!-- UPCOMING TABLE -->
                    <table class="table table-bordered tabcontent" id="Upcoming" style="display:table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Start Time</th>
                                <th>Booked Services</th>
                                <th>End Time Expected</th>
                                <th>Client</th>
                                <th>Employee</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = $con->prepare("SELECT * FROM appointments a, clients c 
                                                       WHERE start_time >= ? 
                                                       AND a.client_id = c.client_id 
                                                       AND canceled = 0 
                                                       ORDER BY start_time");
                                $stmt->execute([date('Y-m-d H:i:s')]);
                                $rows = $stmt->fetchAll();

                                if (empty($rows)) {
                                    echo "<tr><td colspan='6' class='text-center'>List of your upcoming bookings will be presented here</td></tr>";
                                } else {
                                    foreach ($rows as $row) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['start_time']) . "</td>";
                                        
                                        // Services List
                                        echo "<td>";
                                        $stmtServices = $con->prepare("SELECT service_name FROM services s, services_booked sb WHERE s.service_id = sb.service_id AND appointment_id = ?");
                                        $stmtServices->execute([$row['appointment_id']]);
                                        $services = $stmtServices->fetchAll(PDO::FETCH_COLUMN);
                                        $serviceList = array_map(function($s) { return "- " . htmlspecialchars($s); }, $services);
                                        echo implode("<br>", $serviceList);
                                        echo "</td>";

                                        echo "<td>" . htmlspecialchars($row['end_time_expected']) . "</td>";
                                        echo "<td><a href='#'>" . htmlspecialchars($row['client_id']) . "</a></td>";
                                        
                                        // Employee
                                        echo "<td>";
                                        $stmtEmployees = $con->prepare("SELECT first_name, last_name FROM employees e, appointments a WHERE e.employee_id = a.employee_id AND a.appointment_id = ?");
                                        $stmtEmployees->execute([$row['appointment_id']]);
                                        $emp = $stmtEmployees->fetch();
                                        if ($emp) {
                                            echo htmlspecialchars($emp['first_name'] . " " . $emp['last_name']);
                                        }
                                        echo "</td>";

                                        // Manage / Cancel
                                        $cancel_data = "cancel_appointment_" . $row["appointment_id"];
                                        ?>
                                        <td>
                                            <ul class="list-inline m-0">
                                                <li class="list-inline-item" data-toggle="tooltip" title="Cancel Appointment">
                                                    <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $cancel_data; ?>">
                                                        <i class="fas fa-calendar-times"></i>
                                                    </button>

                                                    <div class="modal fade" id="<?php echo $cancel_data; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Cancel Appointment</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to cancel this appointment?</p>
                                                                    <div class="form-group">
                                                                        <label>Tell Us Why?</label>
                                                                        <textarea class="form-control" id="appointment_cancellation_reason_<?php echo $row['appointment_id']; ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                                    <button type="button" data-id="<?php echo $row['appointment_id']; ?>" class="btn btn-danger cancel_appointment_button">Yes, Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                        <?php
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>

                    <!-- ALL BOOKINGS TABLE -->
                    <table class="table table-bordered tabcontent" id="All" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Start Time</th>
                                <th>Booked Services</th>
                                <th>End Time Expected</th>
                                <th>Client</th>
                                <th>Employee</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = $con->prepare("SELECT * FROM appointments a, clients c WHERE a.client_id = c.client_id ORDER BY start_time");
                                $stmt->execute();
                                $rows = $stmt->fetchAll();

                                if (empty($rows)) {
                                    echo "<tr><td colspan='5' class='text-center'>List of all bookings will be presented here</td></tr>";
                                } else {
                                    foreach ($rows as $row) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['start_time']) . "</td>";
                                        
                                        echo "<td>";
                                        $stmtServices = $con->prepare("SELECT service_name FROM services s, services_booked sb WHERE s.service_id = sb.service_id AND appointment_id = ?");
                                        $stmtServices->execute([$row['appointment_id']]);
                                        $services = $stmtServices->fetchAll(PDO::FETCH_COLUMN);
                                        echo htmlspecialchars(implode(" + ", $services));
                                        echo "</td>";

                                        echo "<td>" . htmlspecialchars($row['end_time_expected']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                                        
                                        echo "<td>";
                                        $stmtEmployees = $con->prepare("SELECT first_name, last_name FROM employees e, appointments a WHERE e.employee_id = a.employee_id AND a.appointment_id = ?");
                                        $stmtEmployees->execute([$row['appointment_id']]);
                                        $emp = $stmtEmployees->fetch();
                                        if ($emp) {
                                            echo htmlspecialchars($emp['first_name'] . " " . $emp['last_name']);
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>

                    <!-- CANCELED BOOKINGS TABLE -->
                    <table class="table table-bordered tabcontent" id="Canceled" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Start Time</th>
                                <th>Client</th>
                                <th>Cancellation Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = $con->prepare("SELECT * FROM appointments a, clients c WHERE canceled = 1 AND a.client_id = c.client_id");
                                $stmt->execute();
                                $rows = $stmt->fetchAll();

                                if (empty($rows)) {
                                    echo "<tr><td colspan='3' class='text-center'>List of your canceled bookings will be presented here</td></tr>";
                                } else {
                                    foreach ($rows as $row) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['start_time']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['cancellation_reason'] ?? '') . "</td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

<?php
        // Include Footer (Sesuaikan path jika diperlukan)
        include '../../../config/Includes/templates/admin-footer.php';
    }
    else
    {
        header('Location: login.php');
        exit();
    }
?>