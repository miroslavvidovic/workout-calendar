<?php $this->layout('main_template') ?>

<div id="page-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
        <h1>Data</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="container">
          <table class="table">
        <?php
        use WCal\Model\Data as Data;
        
        $data = new Data();
        $results = $data->readAll();
        
        foreach ($results as $key => $value) {
          // Skip the csv file header
          if($key == 0){
            echo "<thead>
                    <tr>
                      <th>ID</th>
                      <th>Date</th>
                      <th>Minutes</th>
                      <th>Action</th>
                    </tr>
                  </thead>
            ";
          } else {
            echo "<tbody>
                    <tr>
                      <td>$key</td>
                      <td>". date('d.m.Y.',$value[0]). "</td>
                      <td>$value[1]</td>
                      <td><a href='/update/$key/' class='btn btn-primary'>Update</a> <a href='/delete/$key/' class='btn btn-danger'>Delete</a></td>
                    </tr>
            ";
          }
        }
        echo "</tbody>"
        ?>
      </table>
      </div>
      </div>
    </div>
  </div>
</div>
