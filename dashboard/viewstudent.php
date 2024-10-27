<?php
require('../Including/db_connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- primary meta tags -->
    <title>Dashboard Login</title>
    <meta name="description" content="Attendence managemant system" />

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/logo/roll-call.png" type="image/svg+xml" />


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- links css      -->
    <?php
    require('../including/links.php');
    ?>
    <link rel="stylesheet" href="../css/dashboard.css" />

</head>

<body>
    <div class="container">

        <!-- sidebar  -->
        <?php
        require('../including/sidebar.php');
        ?>

        <!-- body part  -->
        <div class="dashboard">

            <?php
            require('../including/alertbox.php');
            ?>

            <!-- topheader    -->
            <?php
            require('../including/topheader.php');
            ?>

            <div class="dashboard-content">

                <div class="dashboard-title">
                    <h2>View Student</h2>
                    <h3><a href="dashboard.php">Dashboard</a>/ <a href="addstudent.php">Add Student</a>/ View Student
                    </h3>
                </div>

                <div class="table-container">

                    <h2>Student List</h2>

                    <div class="search-container">
                        <form action="" method="GET">
                            <div class="showentrie">
                                <label for="entries">Show</label>
                                <select name="entrie" onchange="this.form.submit()">
                                    <option value="10" <?php echo isset($_GET['entrie']) && $_GET['entrie'] == 10 ? 'selected' : ''; ?>>10</option>
                                    <option value="20" <?php echo isset($_GET['entrie']) && $_GET['entrie'] == 20 ? 'selected' : ''; ?>>20</option>
                                    <option value="50" <?php echo isset($_GET['entrie']) && $_GET['entrie'] == 50 ? 'selected' : ''; ?>>50</option>
                                    <option value="100" <?php echo isset($_GET['entrie']) && $_GET['entrie'] == 100 ? 'selected' : ''; ?>>100</option>
                                </select>
                                <label for="entries">Entries</label>
                            </div>

                            <div class="searchbar">
                                <input type="search" name="search"
                                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                                    placeholder="Search by first name or class">
                                <input type="submit" value="Search">
                            </div>
                        </form>
                    </div>

                    <div class="table">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>Admission Id</th>
                                    <th>Class</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $perPage = isset($_GET['entrie']) ? (int)$_GET['entrie'] : 10;
                                $offset = ($currentPage - 1) * $perPage;

                                $sql = "SELECT * FROM student";
                                if (isset($_GET['search']) && !empty($_GET['search'])) {
                                    $value = mysqli_real_escape_string($conn, $_GET['search']);
                                    $sql .= " WHERE CONCAT(id, class, fname) LIKE '%$value%'";
                                }

                                $countSql = "SELECT COUNT(*) as total FROM student";
                                if (isset($_GET['search']) && !empty($_GET['search'])) {
                                    $countSql .= " WHERE CONCAT(id, class, fname) LIKE '%$value%'";
                                }
                                $countResult = mysqli_query($conn, $countSql);
                                $countRow = mysqli_fetch_assoc($countResult);
                                $totalRecords = $countRow['total'];
                                $totalPages = ceil($totalRecords / $perPage);

                                $sql .= " LIMIT $offset, $perPage";
                                $data = mysqli_query($conn, $sql);
                                $total = mysqli_num_rows($data);

                                if ($total > 0) {
                                    $counter = $offset + 1; 
                                    while ($row = mysqli_fetch_assoc($data)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo htmlspecialchars($row['fname']); ?></td>
                                            <td><?php echo htmlspecialchars($row['lname']); ?></td>
                                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                                            <td><?php echo htmlspecialchars($row['admissionid']); ?></td>
                                            <td><?php echo htmlspecialchars($row['class']); ?></td>
                                            <td><?php echo htmlspecialchars($row['semester']); ?></td>
                                            <td class="actionbtn">
                                                <a href="editstudent.php?id=<?php echo $row['id']; ?>" class="btn update">Update</a>
                                                <a href="deletestudent.php?id=<?php echo $row['id']; ?>" class="btn delete">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No records found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="totalcount">
                        <p>Showign 1 to <span><?php echo $total; ?></span> of <span><?php echo $total; ?></span> Entries
                        </p>
                    </div>


                </div>


            </div>

        </div>
        <!-- body part  -->
    </div>
</body>
<script>
    $(document).ready(function () {
        $('.delete').click(function (e) {
            e.preventDefault();
            var id = $(this).closest('tr').find('td:first').text();
            $('.alertbox').css({
                "opacity": "1", "pointer-events": "auto", "transition": "top 0ms ease-in-out 0ms, opacity 200ms ease-in-out 0ms, transform 20ms ease-in-out 0ms"
            }).data('delete-id', id);
        });

        $('.btn1').click(function (e) {
            e.preventDefault();
            $('.alertbox').css({
                "opacity": "0", "pointer-events": "none", "transition": "top 0ms ease-in-out 200ms, opacity 200ms ease-in-out 0ms,transform 20ms ease-in-out 0ms"
            });
        });

        $('.btn2').click(function (e) {
            e.preventDefault();
            var id = $('.alertbox').data('delete-id');
            if (id) {
                window.location.href = 'deletestudent.php?id=' + id;
            }
        });
    });

</script>
<script src="../js/script.js"></script>

</html>