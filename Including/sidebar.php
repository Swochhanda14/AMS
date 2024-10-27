<?php
require('../Including/db_connection.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
  header("location: ../index.php");
  exit();
}
?>


     
     <!-- sidenavbar  -->
      <div class="sidebar">
        <div class="menu-btn" style="z-index: 100">
          <span class="material-symbols-rounded open" aria-hidden="true"
            >menu</span
          >
        </div>

        <!-- logo space  -->
        <div class="head">
          <div class="user-img">
            <img src="../assets/logo/roll-call.png" alt="" />
          </div>

          <div class="user-detail">
            <p class="title">Addentify</p>
            <p class="name">Admin</p>
          </div>
        </div>
        <!-- logo space  -->

        <!-- nav list space  -->
        <div class="nav">
            <div class="menu">
                <p class="title">Main</p>
                <ul>
                  <li>
                    <a href="dashboard.php">
                      <span class="material-symbols-rounded">dashboard</span>
                      <span class="text">Dashboard</span>
                    </a>
                  </li>
                </ul>
              </div>  

          <div class="menu">
            <p class="title">Faculty</p>
            <ul>

              <li>
                <a href="#">
                  <span class="material-symbols-rounded">receipt_long</span>
                  <span class="text">Manage Classes</span>
                  <i class="fa-solid fa-caret-down arrow"></i>
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="addfaculty.php">
                      <span class="material-symbols-rounded">contact_mail</span>
                      <span class="text">Add Class</span>
                    </a>
                  </li>

                  <li>
                    <a href="viewclass.php">
                      <span class="material-symbols-rounded">view_list</span>
                      <span class="text">View Class</span>
                    </a>
                  </li>

                </ul>
              </li>

              <li>
                <a href="#">
                  <span class="material-symbols-rounded">receipt_long</span>
                  <span class="text">Manage Semester</span>
                  <i class="fa-solid fa-caret-down arrow"></i>
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="addsemester.php">
                      <span class="material-symbols-rounded">contact_mail</span>
                      <span class="text">Add Semester</span>
                    </a>
                  </li>

                  <li>
                    <a href="viewsemester.php">
                      <span class="material-symbols-rounded">view_list</span>
                      <span class="text">View Semester</span>
                    </a>
                  </li>

                </ul>
              </li>

            </ul>
          </div>

          <div class="menu">
            <p class="title">Teachers</p>
            <ul>

              <li>
                <a href="#">
                  <span class="material-symbols-rounded">receipt_long</span>
                  <span class="text">Manage Teachers</span>
                  <i class="fa-solid fa-caret-down arrow"></i>
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="addteacher.php">
                      <span class="material-symbols-rounded">contact_mail</span>
                      <span class="text">Add Teacher</span>
                    </a>
                  </li>

                  <li>
                    <a href="viewteacher.php">
                      <span class="material-symbols-rounded">contact_mail</span>
                      <span class="text">View Teacher</span>
                    </a>
                  </li>

                </ul>
              </li>

            </ul>
          </div>

          <div class="menu">
            <p class="title">Students</p>
            <ul>

              <li>
                <a href="#">
                  <span class="material-symbols-rounded">receipt_long</span>
                  <span class="text">Manage Students</span>
                  <i class="fa-solid fa-caret-down arrow"></i>
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="addstudent.php">
                      <span class="material-symbols-rounded">contact_mail</span>
                      <span class="text">Add Student</span>
                    </a>
                  </li>

                  <li>
                    <a href="viewstudent.php">
                      <span class="material-symbols-rounded">contact_mail</span>
                      <span class="text">View Student</span>
                    </a>
                  </li>

                </ul>
              </li>

            </ul>
          </div>
        </div>
        
        <hr/>
        <div class="menu">
          <p class="title">Privacy</p>
          <ul>
            <li>
              <a href="logout.php">
                <span class="material-symbols-rounded">logout</span>
                <span class="text">Logout</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- nav list space  -->
      </div>
      <!-- sidenavbar  -->