<!-- Example DataTables Card-->
<div class="card mb-3">
<div class="card-header">
  <i class="fa fa-table"></i> Lista e Blerjeve</div>
<div class="card-body">
  <?php if (isset($_SESSION['mesazhi'])){?>		
      <div class="alert alert-success malert">
          <?php echo $_SESSION['mesazhi'];
            unset($_SESSION['mesazhi']);
          ?>
      </div>
  <?php }?>
  <?php

    if(isset($_GET['source'])){
        $user_id = $_GET['user_id'];
        delteUser($user_id);
    }
  ?>

  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Nr Fatures</th>
          <th>Data e Fatures</th>
          <th>Klienti</th>
          <th>Pershkrimi</th>
          <th>Shuma</th>
          <th>Data e Pageses</th>
          <th>Statusi</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Nr Fatures</th>
          <th>Data e Fatures</th>
          <th>Klienti</th>
          <th>Pershkrimi</th>
          <th>Shuma</th>
          <th>Data e Pageses</th>
          <th>Statusi</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </tfoot>
      <tbody>
        <?php
        $buys=findBuys();
        while($buy=mysqli_fetch_array($buys)){
        $buy_id=$buy['sale_id'];
        echo "<tr>";
        echo "<td>".  $buy['sale_id'] . "</td>";
        echo "<td>".  $buy['sale_date'] . "</td>";
        echo "<td>".  $buy['client'] . "</td>";
        echo "<td>".  $buy['description'] . "</td>";
        echo "<td>".  $buy['total_price'] . "</td>";
        echo "<td>".  $buy['payment_date'] . "</td>";
        echo "<td>".  $buy['status'] . "</td>";
        echo "<td><a href='buys.php?source=edit_buy&buy_id=$buy_id'>Edit</a></td>";
        echo "<td><a href='buys.php?delete_buy=$buy_id' data-toggle='modal' data-target='#confirm-delete' class='confirm-delete'>Delete</a></td>";
        echo "</tr>";
        }
      ?>
      </tbody>
    </table>
  </div>
</div>
<?php if(isset($_GET['delete_buy'])){
      $delete_buy_id = $_GET['delete_buy'];
      delteBuy($delete_buy_id);
    }?>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Fshirja e blerjes
            </div>
            <div class="modal-body">
                A dëshironi të fshini këtë blerje ?
            </div>
            <div class="modal-footer">
              <a class='btn btn-danger delete_modal_link' 
              href=''> Po</a>
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Jo</a>
            </div>
        </div>
    </div>
</div>
<script>
setTimeout(function(){
    $('.malert').addClass('d-none');
},8000);
</script>

<script>

  $(document).ready(function(){

    $(".confirm-delete").on('click',function(){
      
      var href = $(this).attr("href");

      $(".delete_modal_link").attr("href",href);
      
    });

});
</script>