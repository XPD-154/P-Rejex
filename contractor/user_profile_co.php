<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST">
                    <button type="submit" name="log_out" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end of Logout Modal-->

<!-- Modal for user profile-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
            $CNuniqueID=$_SESSION['CNuniqueID'];
            $query="SELECT * FROM PRcontractor WHERE CNuniqueId = '$CNuniqueID' LIMIT 1";
            $sql=$connection->prepare($query);
            $sql->execute();
            while($row=$sql->fetch(PDO::FETCH_ASSOC)){

                echo "Company Name: ".$row['CNcompany_name']."<br>";
                echo "Company Email: ".$row['CNemail']."<br>";
                echo "Company Phone Number: ".$row['CNphone_number']."<br>";

                $_SESSION['CNcompany_name'] = $row['CNcompany_name'];
                $_SESSION['CNemail'] = $row['CNemail'];
                $_SESSION['CNphone_number'] = $row['CNphone_number'];
            }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--end of Modal for user profile-->