<?php
    session_start();

    // Check If user is already logged in
    if(isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4']))
    {
        // Page Title
        $pageTitle = 'Clients';

        // Includes (Diubah ke absolute/relative path yang konsisten)
        include '../../models/connect.php';
        include '../../../config/Includes/functions/functions.php'; 
        include '../../../config/Includes/templates/admin-header.php';
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
    
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Clients</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i>
                    Generate Report
                </a>
            </div>

            <!-- Clients Table Card -->
            <?php
                $stmt = $con->prepare("SELECT * FROM clients ORDER BY client_id DESC");
                $stmt->execute();
                $rows_clients = $stmt->fetchAll(); 
            ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Clients List</h6>
                </div>
                <div class="card-body">
                    
                    <!-- Clients Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">ID#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">E-mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (empty($rows_clients)) {
                                        echo "<tr><td colspan='5' class='text-center'>No clients found</td></tr>";
                                    } else {
                                        foreach($rows_clients as $client)
                                        {
                                            echo "<tr>";
                                                echo "<td>" . htmlspecialchars($client['client_id']) . "</td>";
                                                echo "<td>" . htmlspecialchars($client['first_name']) . "</td>";
                                                echo "<td>" . htmlspecialchars($client['last_name']) . "</td>";
                                                echo "<td>" . htmlspecialchars($client['phone_number']) . "</td>";
                                                echo "<td>" . htmlspecialchars($client['client_email']) . "</td>";
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
        // Include Footer dengan path yang sama seperti Dashboard
        include '../../../config/Includes/templates/admin-footer.php';
    }
    else
    {
        header('Location: login.php');
        exit();
    }
?>