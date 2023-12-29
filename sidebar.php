<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
<style>
  .nav-link:hover {
    background-color: rgb(210, 210, 210);

  }
</style>

<body>


  <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
    <!-- <button class="w3-bar-item w3-button w3-large d-flex justify-content-end" onclick="w3_close()">
      <iconify-icon icon="mdi:hamburger" width="30" height="30"></iconify-icon>
    </button> -->

    <div class="nav-link border" onclick="w3_close()">
      <a class="h3 my-2 mb-3 d-flex justify-content-center">
        <img  src="../img/sungroup.png" alt="" width="120" height="40" class="m-1 d-inline-block align-text-top">
      </a>
    </div>

    <li class="nav-link border d-grid gap-2">
      <a style="text-decoration: none;" class="btn " href="../V/admin_page.php">
        <iconify-icon icon="carbon:document-view" width="20" height="20"></iconify-icon>
        <span class="">Document Action Request</span>
      </a>
    </li>

    <li class="nav-link border d-grid gap-2">

      <a style="text-decoration: none;" class="btn   " href="../V/admin_assign.php">
        <iconify-icon icon="material-symbols:assignment-add-outline" width="20" height="20"></iconify-icon>
        <span class="mx-2">Assigned</span>
      </a>
    </li>

    <li class="nav-link border d-grid gap-2">
      <a style="text-decoration: none;" class="btn  " href="../V/admin_see_assign_all.php">
        <iconify-icon icon="material-symbols:assignment-outline" width="20" height="20"></iconify-icon>
        <span class="mx-2">Assigned All</span>
      </a>
    </li>

    <li class="nav-link border d-grid gap-2">
      <a style="text-decoration: none;" class="btn " href="../V/edit_user.php">
        <iconify-icon icon="prime:user-edit" width="20" height="20"></iconify-icon>
        <span class="mx-2">จัดการผู้ใช้</span>
      </a>
    </li>

    <li class="nav-link border d-grid gap-2">
      <a style="text-decoration: none;" class="btn " href="../V/master_folder.php">
        <iconify-icon icon="material-symbols:drive-folder-upload-outline" width="20" height="20"></iconify-icon>
        <span class="mx-2">อัปโหลดไฟล์</span>
      </a>
    </li>

    <!-- <li class="nav-link border">
      <a style="text-decoration: none;" class="btn mb-3 " href="../V/edit_degree.php">
        <iconify-icon icon="fluent-mdl2:workforce-management"></iconify-icon>
        <span class="mx-2">ระดับ USER</span>
      </a>
    </li> -->

    <!-- <li class="nav-link border">
      <a style="text-decoration: none;" class="btn  mb-3  " href="../V/edit_degree_super.php">
        <iconify-icon icon="fluent-mdl2:recruitment-management"></iconify-icon>
        <span class="mx-2">ระดับ SUPER</span>
      </a>
    </li> -->

    <li class="nav-link border d-grid gap-5 ">
      <a style="text-decoration: none;" class="btn" href="../report/approve_report.php">
        <iconify-icon icon="tabler:report" width="20" height="20"></iconify-icon>
        <span class="mx-2">Master List</span>
</a>
    </li>

    <div class="nav-link mt-5  d-grid gap-2">
      <a onclick="deleteItems();" href="../C/alert_logout.php" class="btn btn-danger">Logout
      </a>

    </div>
  </div>
  </div>
  </div>

  <div id="main">

    <div class="w3-teal">
      <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
      <div class="w3-container">
      </div>
    </div>



    <script>
      document.getElementById("main").style.marginLeft = "19%";
      document.getElementById("mySidebar").style.width = "18%";
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("openNav").style.display = 'none';

      function w3_open() {
        document.getElementById("main").style.marginLeft = "19%";
        document.getElementById("mySidebar").style.width = "18%";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("openNav").style.display = 'none';
      }

      function w3_close() {
        document.getElementById("main").style.marginLeft = "0%";
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
      }


      function deleteItems() {
        localStorage.clear();
      }

      
    </script>

</body>

</html>

<script>
  // Get all the links in the sidebar
  const links = document.querySelectorAll("div a");

  // Iterate through the links and add the active class to the current link
  for (let i = 0; i < links.length; i++) {
    const link = links[i];
    const currentUrl = window.location.href;

    // If the link is the current page, add the active class
    if (link.href === currentUrl) {
      link.classList.add("active");
    }
  }
</script>