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
        <button id="cal-heatmap-PreviousDomain-selector" class="btn"><i class="fa fa-chevron-left"></i></button>
        <button id="cal-heatmap-NextDomain-selector" class="btn"><i class="fa fa-chevron-right"></i></button>
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
            itemName: "minute",
            itemSelector: "#cal-heatmap",
            domain: "month",
            subDomain: "day",
            data: "/src/data/data.csv",
            dataType: "csv",
            // Use the parser funcition after load
            afterLoadData: parser,
            start: new Date(2016, 6, 25),
            cellSize: 30,
            cellRadius: 3,
            cellPadding: 5,
            domainGutter: 25,
            domainMargin: 2,
            highlight: "now",
            range:5,
            tooltip:true,
            // missing values have 0 value
            considerMissingDataAsZero: true,
            domainDynamicDimension: true,
            previousSelector: "#cal-heatmap-PreviousDomain-selector",
            nextSelector: "#cal-heatmap-NextDomain-selector",
            label: {
              position: "bottom"
            },
            legend: [25, 35, 45, 55],
              //legendColors: ["#ecf5e2", "#232181"],
            legendColors: {
              min: "#fdffbe",
              max: "#232181",
              empty: "#dbddce",
              // base color for missing values if they are not selected as empty
              base: "#661156"
            },
              //empty: "white",
              //base: "gray",
              legendCellSize: 20
          });
      </script>
    </div>
  </div>
</div>
</div>
