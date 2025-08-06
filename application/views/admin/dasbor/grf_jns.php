
<script src="<?php echo base_url() ?>assets/charts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/charts/amcharts/serial.js" type="text/javascript"></script> 

<script>
	var chart;

	var saipul = [
	<?php
	foreach($brg as $brg) { 
		?>
		{
			"year": "<?php echo $this->tanggal->romawi(date('m',strtotime($brg['tanggal_minta']))) ?>",
			<?php 
			$bulan = date('m',strtotime($brg['tanggal_minta']));
			$tahun = date('Y',strtotime($brg['tanggal_minta']));

			$atk	= $this->dasbor_model->atk($bulan,$tahun);
			foreach ($atk as $atk ){ ?>
				"<?php echo $atk['nama_jenis'] ?>": <?php echo $atk['jumlah'] ?>,
			<?php } ?>

			<?php 
			$bulan = date('m',strtotime($brg['tanggal_minta']));
			$tahun = date('Y',strtotime($brg['tanggal_minta']));

			$cu		= $this->dasbor_model->cu($bulan,$tahun);
			foreach ($cu as $cu ){ ?>
				"<?php echo $cu['nama_jenis'] ?>": <?php echo $cu['jumlah'] ?>,
			<?php } ?>

			<?php 
			$bulan = date('m',strtotime($brg['tanggal_minta']));
			$tahun = date('Y',strtotime($brg['tanggal_minta']));

			$it		= $this->dasbor_model->it($bulan,$tahun);
			foreach ($it as $it ){ ?>
				"<?php echo $it['nama_jenis'] ?>": <?php echo $it['jumlah'] ?>,
			<?php } ?>


			<?php 
			$bulan = date('m',strtotime($brg['tanggal_minta']));
			$tahun = date('Y',strtotime($brg['tanggal_minta']));

			$art		= $this->dasbor_model->art($bulan,$tahun);
			foreach ($art as $art ){ ?>
				"<?php echo $art['nama_jenis'] ?>": <?php echo $art['jumlah'] ?>,
			<?php } ?>

			<?php 
			$bulan = date('m',strtotime($brg['tanggal_minta']));
			$tahun = date('Y',strtotime($brg['tanggal_minta']));

			$ctk		= $this->dasbor_model->ctk($bulan,$tahun);
			foreach ($ctk as $ctk ){ ?>
				"<?php echo $ctk['nama_jenis'] ?>": <?php echo $ctk['jumlah'] ?>,
			<?php } ?>

			<?php 
			$bulan = date('m',strtotime($brg['tanggal_minta']));
			$tahun = date('Y',strtotime($brg['tanggal_minta']));

			$alk		= $this->dasbor_model->alk($bulan,$tahun);
			foreach ($alk as $alk ){ ?>
				"<?php echo $alk['nama_jenis'] ?>": <?php echo $alk['jumlah'] ?>,
			<?php } ?>


		},
	<?php } ?>   
	];

	AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = saipul;
                chart.categoryField = "year";
                chart.plotAreaBorderAlpha = 15;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridAlpha = 0.9;
                categoryAxis.axisAlpha = 0;
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.stackType = "regular";
                valueAxis.gridAlpha = 0.5;
                valueAxis.axisAlpha = 0;
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // first graph
                var graph = new AmCharts.AmGraph();
                graph.title = "Alat Tulis Kantor (ATK)";
                graph.labelText = "[[value]]";
                graph.valueField = "Alat Tulis Kantor (ATK)";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                graph.lineColor = "#C72C95";
                graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
                chart.addGraph(graph);

                // second graph
                graph = new AmCharts.AmGraph();
                graph.title = "Barang IT";
                graph.labelText = "[[value]]";
                graph.valueField = "Barang IT";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                graph.lineColor = "#D8E0BD";
                graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
                chart.addGraph(graph);

                // third graph
                graph = new AmCharts.AmGraph();
                graph.title = "Alat Rumah Tangga";
                graph.labelText = "[[value]]";
                graph.valueField = "Alat Rumah Tangga";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                graph.lineColor = "#B3DBD4";
                graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
                chart.addGraph(graph);

                // fourth graph
                graph = new AmCharts.AmGraph();
                graph.title = "Cetakan";
                graph.labelText = "[[value]]";
                graph.valueField = "Cetakan";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                graph.lineColor = "#69A55C";
                graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
                chart.addGraph(graph);

                // fifth graph
                graph = new AmCharts.AmGraph();
                graph.title = "Alkes";
                graph.labelText = "[[value]]";
                graph.valueField = "Alkes";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                graph.lineColor = "#B5B8D3";
                graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
                chart.addGraph(graph);

                // sixth graph
                graph = new AmCharts.AmGraph();
                graph.title = "Cetakan Umum";
                graph.labelText = "[[value]]";
                graph.valueField = "Cetakan Umum";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                graph.lineColor = "#F4E23B";
                graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span class='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
                chart.addGraph(graph);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                legend.borderAlpha = 0.9;
                legend.horizontalGap = 30;
                chart.addLegend(legend);

                // WRITE
                chart.write("chartdiv");
            });

            // this method sets chart 2D/3D
            function setDepth() {
            	if (document.getElementById("rb1").checked) {
            		chart.depth3D = 0;
            		chart.angle = 0;
            	} else {
            		chart.depth3D = 25;
            		chart.angle = 30;
            	}
            	chart.validateNow();
            }
        </script>

        <div id="chartdiv" style="width: 1500px; height: 400px;"></div>
        <div style="margin-left:30px;">
        	<input type="radio" checked="true" name="group" id="rb1" onclick="setDepth()">2D
        	<input type="radio" name="group" id="rb2" onclick="setDepth()">3D
        </div>

