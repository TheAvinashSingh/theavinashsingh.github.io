		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			var options = {
				chart: {
	                renderTo: 'container',
	                plotBackgroundColor: null,
	                plotBorderWidth: null,
	                plotShadow: false
	            },
	            title: {
	                text: 'Money Budgeted'
	            },
	            tooltip: {
	                formatter: function() {
	                    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
	                }
	            },
	            plotOptions: {
	                pie: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
	                    dataLabels: {
	                        enabled: true,
	                        color: '#000000',
	                        connectorColor: '#000000',
	                        formatter: function() {
	                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
	                        }
	                    }
	                }
	            },
	            series: [{
	                type: 'pie',
	                name: 'Browser share',
	                data: []
	            }]
	        }
	        
	        $.getJSON("data2x.php", function(json) {
				options.series[0].data = json;
	        	chart = new Highcharts.Chart(options);
	        });
	        
	        
	        
      	});
$(document).ready(function() {
			var options = {
				chart: {
	                renderTo: 'container1',
	                plotBackgroundColor: null,
	                plotBorderWidth: null,
	                plotShadow: false
	            },
	            title: {
	                text: 'Money Spent'
	            },
	            tooltip: {
	                formatter: function() {
	                    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
	                }
	            },
	            plotOptions: {
	                pie: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
	                    dataLabels: {
	                        enabled: true,
	                        color: '#000000',
	                        connectorColor: '#000000',
	                        formatter: function() {
	                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
	                        }
	                    }
	                }
	            },
	            series: [{
	                type: 'pie',
	                name: 'Browser share',
	                data: []
	            }]
	        }
	        
	        $.getJSON("data2y.php", function(json) {
				options.series[0].data = json;
	        	chart = new Highcharts.Chart(options);
	        });
	        
	        
	        
      	});

		</script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>