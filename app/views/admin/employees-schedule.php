<?php
    session_start();

    // Page Title
    $pageTitle = 'Employees Schedule';

    // Includes (Path disesuaikan agar konsisten)
    include '../../models/connect.php';
    include '../../../config/Includes/functions/functions.php'; 
    include '../../../config/Includes/templates/admin-header.php';

    // Extra JS Files
    echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";

    // Check If user is already logged in
    if(isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4']))
    {
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
    
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Employees Schedule</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i>
                    Generate Report
                </a>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Employees Schedule</h6>
                </div>
                <div class="card-body">
                    <div class="sb-entity-selector" style="max-width:300px;">
                        <form action="employees-schedule.php" method="POST">
                            <div class="form-group">
                                <label class="control-label" for="emloyee_schedule_select">
                                    Select employee to set up the schedule:
                                </label>
                                <div style="display:inline-block;margin-bottom: 10px;">
                                    <?php 
                                        $stmt = $con->prepare('SELECT * FROM employees');
                                        $stmt->execute();
                                        $employees = $stmt->fetchAll();
                                    
                                        echo "<select class='form-control' name='employee_selected'>";
                                            foreach ($employees as $employee) 
                                            {
                                                $selected = (isset($_POST['employee_selected']) && $_POST['employee_selected'] == $employee['employee_id']) ? 'selected' : '';
                                                echo "<option value='".htmlspecialchars($employee['employee_id'])."' ".$selected.">".htmlspecialchars($employee['first_name'])." ".htmlspecialchars($employee['last_name'])."</option>";
                                            }
                                        echo "</select>";                                   
                                    ?>
                                </div>
                                <button type="submit" name="show_schedule_sbmt" class="btn btn-primary">Show schedule</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="alert alert-info">
                        Configure your week settings here. Just select start time and end time to set up employees working hours.
                    </div>
                    
                    <!-- SCHEDULE PART -->
                    <div class="sb-content" style="min-height: 500px;">
                        <?php
                            /** WHEN SHOW SCHEDULE BUTTON CLICKED **/
                            if(isset($_POST['show_schedule_sbmt']))
                            {
                        ?>
                                <form method="POST" action="employees-schedule.php">
                                    <input type="hidden" name="employee_id" value="<?php echo htmlspecialchars($_POST['employee_selected']); ?>">     
                                    <div class="worktime-days">
                                        <?php
                                            $employee_id = $_POST['employee_selected'];
                                            $stmt = $con->prepare('SELECT * FROM employees e, employees_schedule es WHERE es.employee_id = e.employee_id AND e.employee_id = ?');
                                            $stmt->execute(array($employee_id));
                                            $employees = $stmt->fetchAll();
                            
                                            $days = array(
                                                "1" => "Monday",
                                                "2" => "Tuesday",
                                                "3" => "Wednesday",
                                                "4" => "Thursday",
                                                "5" => "Friday",
                                                "6" => "Saturday",
                                                "7" => "Sunday"
                                            );
                                        
                                            // Available days
                                            $av_days = array();
                                            foreach($employees as $employee)
                                            {
                                                $av_days[] = $employee['day_id'];
                                            }
                                        
                                            foreach($days as $key => $value)
                                            {
                                                echo "<div class='worktime-day row'>";
                                                
                                                if(in_array($key, $av_days))
                                                {
                                                    echo "<div class='form-group col-md-4'>";
                                                        echo "<input name='".$value."' id='".$key."' class='sb-worktime-day-switch' type='checkbox' checked>";
                                                        echo "<span class='day-name'>". $value ."</span>";
                                                    echo "</div>";
                                                    
                                                    foreach($employees as $employee)
                                                    {
                                                        if($employee['day_id'] == $key)
                                                        {
                                                            echo "<div class='time_ col-md-8 row'>";
                                                                echo "<div class='form-group col-md-6'>";
                                                                    echo "<input type='time' name='".$value."-from' value='".htmlspecialchars($employee['from_hour'])."' class='form-control'>";
                                                                echo "</div>";
                                                                echo "<div class='form-group col-md-6'>";
                                                                    echo "<input type='time' name='".$value."-to' value='".htmlspecialchars($employee['to_hour'])."' class='form-control'>";
                                                                echo "</div>";
                                                            echo "</div>";
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    echo "<div class='form-group col-md-4'>";
                                                        echo "<input name='".$value."' id='".$key."' class='sb-worktime-day-switch' type='checkbox'>";
                                                        echo "<span class='day-name'>". $value ."</span>";
                                                    echo "</div>";
                                                    
                                                    echo "<div class='time_ col-md-8 row' style='display:none;'>";
                                                        echo "<div class='form-group col-md-6'>";
                                                            echo "<input type='time' name='".$value."-from' value='09:00' class='form-control'>";
                                                        echo "</div>";
                                                        echo "<div class='form-group col-md-6'>";
                                                            echo "<input type='time' name='".$value."-to' value='18:00' class='form-control'>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                }
                                                
                                                echo "</div>";
                                            }
                                        ?>
                                    </div>

                                    <!-- SAVE SCHEDULE BUTTON -->
                                    <div class="form-group mt-3">
                                        <button type="submit" name="save_schedule_sbmt" class="btn btn-info">Save schedule</button>
                                    </div>
                                </form>
                        <?php
                            }
                        ?>
                    </div>

                    <?php
                        /** WHEN SAVE SCHEDULE BUTTON CLICKED **/
                        if(isset($_POST['save_schedule_sbmt']))
                        {
                            $days = array(
                                "1" => "Monday",
                                "2" => "Tuesday",
                                "3" => "Wednesday",
                                "4" => "Thursday",
                                "5" => "Friday",
                                "6" => "Saturday",
                                "7" => "Sunday"
                            );

                            $stmt = $con->prepare("DELETE FROM employees_schedule WHERE employee_id = ?");
                            $stmt->execute(array($_POST['employee_id']));
                            
                            $updated = false;

                            foreach($days as $key => $value)
                            {
                                if(isset($_POST[$value]))
                                {   
                                    $stmt = $con->prepare("INSERT INTO employees_schedule(employee_id, day_id, from_hour, to_hour) VALUES (?, ?, ?, ?)");
                                    $stmt->execute(array($_POST['employee_id'], $key, $_POST[$value.'-from'], $_POST[$value.'-to']));
                                    $updated = true;
                                }
                            }

                            if($updated)
                            {
                    ?>
                                <script type="text/javascript">
                                    swal("Set Employee Schedule", "You have successfully updated the employee schedule!", "success");
                                </script>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
  
<?php 
        // Include Footer
        include '../../../config/Includes/templates/admin-footer.php';
    }
    else
    {
        header('Location: login.php');
        exit();
    }
?>