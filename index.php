<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="PHP CRUD" />
        <meta name="author" content="Angel Rivera" />
        <title>PHP CRUD</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <!-- Sidenav Toggle Button-->
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
            <!-- Navbar Brand-->
            <!-- * * Tip * * You can use text or an image for your navbar brand.-->
            <!-- * * * * * * When using an image, we recommend the SVG format.-->
            <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
            <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.html">PHP CRUD</a>
           </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                           
                            <!-- Sidenav Heading (crud samples)-->
                            <div class="sidenav-menu-heading">CRUD Samples</div>
                            <!-- Sidenav Link (index - employee management)-->
                            <a class="nav-link" href="index.html">
                                <div class="nav-link-icon"><i data-feather="users"></i></div>
                                Employees
                            </a>
                            <!-- Sidenav Link (prouducts management)-->
                            <a class="nav-link" href="#!">
                                <div class="nav-link-icon"><i data-feather="shopping-bag"></i></div>
                                Products
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-fluid px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="users"></i></div>
                                            Employee List
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <button class="btn btn-sm btn-light text-primary" type="button" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                                            <i class="me-1" data-feather="plus"></i>
                                            Create New Group
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-fluid px-4">
                        <div class="card">
                            <div class="card-body">
                            <!-- Call database and select all employees to show -->
                            <?php
                                $connection = mysqli_connect("localhost","root","");
                                $db = mysqli_select_db($connection, 'phpcrud');

                                $query = "SELECT * FROM employees";
                                $query_run = mysqli_query($connection, $query);
                            ?>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <!-- Show datas in table -->
                                    <?php
                                        if($query_run)
                                        {
                                            foreach($query_run as $row)
                                            {
                                    ?>
                                    <tbody>
                                        <tr onclick="showEmployee(this)">
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['fname']; ?></td>
                                            <td><?php echo $row['lname']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['department']; ?></td>
                                            <td>
                                                <button class="btn btn-datatable btn-icon btn-transparent-dark me-2" type="button" data-bs-toggle="modal" data-bs-target="#editGroupModal"><i data-feather="edit"></i></button>
                                                <button class="btn btn-datatable btn-icon btn-transparent-dark"  type="button" data-bs-toggle="modal" data-bs-target="#deleteGroupModal"><i data-feather="trash-2"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- Echo no record found when there is no datas in table -->
                                    <?php           
                                            }
                                        }
                                        else 
                                        {
                                            echo "No Record Found";
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- add employee modal-->
                    <div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="createGroupModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createGroupModalLabel">Add New Employee</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="employeecrud/insertcode.php" method="POST">
                                        <!-- Form Group (First Name)-->
                                        <div class="mb-2">
                                            <label class="mb-1">First Name</label>
                                            <input class="form-control" name="fname" type="text" placeholder="Enter first name" required/>
                                        </div>
                                        <!-- Form Group (Last Name)-->
                                        <div class="mb-2">
                                            <label class="mb-1 small">Last Name</label>
                                            <input class="form-control" name="lname" type="text" placeholder="Enter last name" required/>
                                        </div>
                                        <!-- Form Group (Email)-->
                                        <div class="mb-2">
                                            <label class="mb-1 small">Email</label>
                                            <input class="form-control" name="email" type="email" placeholder="Enter email" required/>
                                        </div>
                                        <!-- Form Group (Department)-->
                                        <div class="mb-2">
                                            <label class="mb-1 small">Department</label>
                                            <select class="form-select" name="department" aria-label="Default select example">
                                                <option selected disabled>Select Department</option>
                                                <option value="IT">IT</option>
                                                <option value="Sales">Sales</option>
                                                <option value="Editor">Editor</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger-soft text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary-soft text-primary" name="insertdata" type="submit">Add Employee</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div> <!-- end -->
                    <!-- update employee modal-->
                    <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="editGroupModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editGroupModalLabel">Edit Employee</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="employeecrud/updatecode.php" method="POST">

                                    <input type="hidden" name="update_id" id="update_id">
                                        <!-- Form Group (First Name)-->
                                        <div class="mb-2">
                                            <label class="mb-1">First Name</label>
                                            <input class="form-control" name="fname" id="fname" type="text" placeholder="Enter first name" required/>
                                        </div>
                                        <!-- Form Group (Last Name)-->
                                        <div class="mb-2">
                                            <label class="mb-1 small">Last Name</label>
                                            <input class="form-control" name="lname" id="lname" type="text" placeholder="Enter last name" required/>
                                        </div>
                                        <!-- Form Group (Email)-->
                                        <div class="mb-2">
                                            <label class="mb-1 small">Email</label>
                                            <input class="form-control" name="email" id="email" type="email" placeholder="Enter email" required/>
                                        </div>
                                        <!-- Form Group (Department)-->
                                        <div class="mb-2">
                                            <label class="mb-1 small">Department</label>
                                            <select class="form-select" name="department" id="department" aria-label="Default select example">
                                                <option selected disabled>Select Department</option>
                                                <option value="IT">IT</option>
                                                <option value="Sales">Sales</option>
                                                <option value="Editor">Editor</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger-soft text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary-soft text-primary" name="updatedata" type="submit">Save Changes</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div> <!-- end -->
                     <!-- delete employee modal-->
                     <div class="modal fade" id="deleteGroupModal" tabindex="-1" role="dialog" aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteGroupModalLabel">Remove Employee</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="employeecrud/deletecode.php" method="POST">
                                    <div class="mb-3 mt-3 text-center">
                                    <input type="hidden" name="delete_id" id="delete_id">
                                        <h5>Are you sure you want to remove this data?</h5>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger-soft text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary-soft text-primary" name="deletedata" type="Submit">Remove</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div> <!-- end -->
                </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy; Rivera 2022</div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables/datatables-simple-demo.js"></script>
    </body>
</html>

    <script>
           //   this is where we get the row value and pass it on to the input field on a modal
          function showEmployee(row)
          {
          var j = row.cells;
          document.getElementById("update_id").value = j[0].innerHTML;
          document.getElementById("delete_id").value = j[0].innerHTML;
          document.getElementById("fname").value = j[1].innerHTML;
          document.getElementById("lname").value = j[2].innerHTML;
          document.getElementById("email").value = j[3].innerHTML;
          document.getElementById("department").value = j[4].innerHTML;
          }
      </script>
