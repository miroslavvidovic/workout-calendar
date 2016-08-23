<?php $this->layout('main_template');?>

<div id="page-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
        <h1>Calendar widget</h1>
        <p>This is a workout calendar widget, a widget similar to the GitHub activity calendar.
          It enables you to track your workout time on a daily basis.</p>
        <p>Never miss a day of training again.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <button id="cal-heatmap-PreviousDomain-selector" style="margin-bottom: 10px; margin-top: 20px" class="btn"><i class="fa fa-chevron-left"></i></button>
        <button id="cal-heatmap-NextDomain-selector" style="margin-bottom: 10px; margin-top: 20px" class="btn"><i class="fa fa-chevron-right"></i></button>
        <div id="cal-heatmap"></div>

      <!-- Heatmap calendar script -->
      <script type="text/javascript">
        // Every data format except json needs to be parsed first
        var parser = function(data) {
          "use strict";
          var d = {};
          var keys = Object.keys(data[0]);
          var i, total;
          for (i = 0, total = data.length; i < total; i++) {
            d[data[i][keys[0]]] = parseInt(data[i][keys[1]], 10);
          }
          return d;
        };

        // Create the heatmap
        var cal = new CalHeatMap();
          cal.init({
            itemSelector: "#cal-heatmap",
            domain: "month",
            subDomain: "day",
            data: "/src/data/data.csv",
            dataType: "csv",
            // Use the parser funcition after load
            afterLoadData: parser,
            start: new Date(2016, 6, 25),
            cellSize: 25,
            cellRadius: 3,
            cellPadding: 5,
            domainGutter: 25,
            highlight: "now",
            range:5,
            tooltip:true,
            considerMissingDataAsZero: true,
            domainDynamicDimension: true,
            previousSelector: "#cal-heatmap-PreviousDomain-selector",
            nextSelector: "#cal-heatmap-NextDomain-selector",
            label: {
              position: "bottom"
            },
            legend: [10, 20, 30, 40],
              legendColors: ["#ecf5e2", "#232181"],
              legendCellSize: 20
          });
      </script>
    </div>
  </div>
</div>
</div>
