<?php
/**
 * IWT Exercise 05: View Employees Table
 * Displays all records stored in phpMyAdmin MySQL database
 */

require_once 'db.php';

// Fetch all employees from database
$query = "SELECT * FROM employees ORDER BY id DESC";
$result = $conn->query($query);
$total_employees = $result ? $result->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Directory | IWT Exercise 05</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header Navigation -->
    <header class="navbar">
        <div class="nav-container">
            <a href="index.php" class="brand">🏢 TechCorp Employee Portal</a>
            <ul class="nav-links">
                <li><a href="index.php">+ Register New Employee</a></li>
                <li><a href="view_employees.php" class="active">View All Employees</a></li>
            </ul>
        </div>
    </header>

    <div class="container container-wide">
        <div class="card">
            
            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                <div>
                    <h2>Registered Employees Directory</h2>
                    <p>Live data fetched from MySQL Database: <code>iwt_exercise5.employees</code></p>
                </div>
                <div>
                    <span class="badge-tag" style="font-size: 13px; padding: 6px 12px;">Total Records: <?php echo $total_employees; ?></span>
                </div>
            </div>

            <?php if ($total_employees > 0): ?>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Emp ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Salary</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $count = 1;
                            while ($row = $result->fetch_assoc()): 
                            ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><strong><?php echo htmlspecialchars($row['emp_id']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                    <td><a href="mailto:<?php echo htmlspecialchars($row['email']); ?>" style="color: var(--primary); text-decoration: none;"><?php echo htmlspecialchars($row['email']); ?></a></td>
                                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                    <td><?php echo htmlspecialchars(date('d M Y', strtotime($row['dob']))); ?></td>
                                    <td><span class="badge-tag"><?php echo htmlspecialchars($row['department']); ?></span></td>
                                    <td><?php echo htmlspecialchars($row['designation']); ?></td>
                                    <td class="salary-tag">&#8377;<?php echo number_format($row['salary'], 2); ?></td>
                                    <td style="max-width: 200px;"><?php echo htmlspecialchars($row['address']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 40px 20px;">
                    <p style="font-size: 16px; color: var(--text-muted); margin-bottom: 20px;">No employee records currently found in the database.</p>
                    <a href="index.php" class="btn btn-primary">+ Register First Employee</a>
                </div>
            <?php endif; ?>

            <div style="margin-top: 25px; padding-top: 15px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <span style="font-size: 13px; color: var(--text-muted);">Database: MySQL / phpMyAdmin (iwt_exercise5)</span>
                <a href="index.php" class="btn btn-secondary">&larr; Return to Form</a>
            </div>

        </div>
    </div>

</body>
</html>
