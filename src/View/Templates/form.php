<?php $this->layout('main_template') ?>

<div id="page-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
        <h1>Insert data</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
          
        <?php
            use WCal\Controller\DataWorker;

            if (isset($id)){
                $worker = new DataWorker();
                $row = $worker->selectOne($id);
                $timestamp = date('d.m.Y.', $row[0]);
                $duration = $row[1];
        ?>
            <form role="form" method="post" action="/update/">
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <div class="form-group">
                <label for="timestamp">Date:</label>
                <input type="text" name="timestamp" id="datepicker" class="form-control" readonly="readonly" value="<?php echo $timestamp ?>">
              </div>
              <div class="form-group">
                <label for="value">Training duration in min:</label>
                <input name="value" type="number" id="duration" min="1" max="500" class="form-control" value="<?php echo $duration ?>" >
              </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        <?php
        
            } else {
        ?>
        <form role="form" method="post" action="/write/">
          <div class="form-group">
            <label for="timestamp">Date:</label>
            <input type="text" name="timestamp" id="datepicker" class="form-control" readonly="readonly">
          </div>
          <div class="form-group">
            <label for="value">Training duration in min:</label>
            <input name="value" type="number" id="duration" min="1" max="500" class="form-control" id="value">
          </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        
        <?php
        
            }
        ?>
      </div>
    </div>
  </div>
</div>
<script src="/js/moment.js"></script>
<script src="/js/pikaday.js"></script>
<script>
  var picker = new Pikaday({
    field: document.getElementById('datepicker'),
    format: 'DD.MM.YYYY',
    onSelect: function() {
      console.log(this.getMoment().format('Do MMMM YYYY'));
    }
  });
</script>
