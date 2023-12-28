$(function() {
	'use strict';
	/*LIne-Chart */
	var ctx = document.getElementById("chartLine").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["Sun", "Mon", "Tus", "Wed", "Thu", "Fri", "Sat"],
			datasets: [{
				label: 'Profits',
				data: [20, 420, 210, 354, 580, 320, 480],
				borderWidth: 2,
				backgroundColor: 'transparent',
				borderColor: '#8760fb',
				borderWidth: 3,
				pointBackgroundColor: '#ffffff',
				pointRadius: 2
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,

			scales: {
				xAxes: [{
					ticks: {
						fontColor: "#77778e",
					 },
					display: true,
					gridLines: {
						color: 'rgba(119, 119, 142, 0.2)'
					}
				}],
				yAxes: [{
					ticks: {
						fontColor: "#77778e",
					 },
					display: true,
					gridLines: {
						color: 'rgba(119, 119, 142, 0.2)'
					},
					scaleLabel: {
						display: false,
						labelString: 'Thousands',
						fontColor: 'rgba(119, 119, 142, 0.2)'
					}
				}]
			},
			legend: {
				labels: {
					fontColor: "#77778e"
				},
			},
		}
	});

	/* Bar-Chart1 */
	var ctx = document.getElementById("chartBar1").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
			datasets: [{
				label: 'Sales',
				data: [200, 450, 290, 367, 256, 543, 345],
				borderWidth: 2,
				backgroundColor: '#9877f9',
				borderColor: '#9877f9',
				borderWidth: 2.0,
				pointBackgroundColor: '#ffffff',

			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			legend: {
				display: true
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						stepSize: 150,
						fontColor: "#77778e",
					},
					gridLines: {
						color: 'rgba(119, 119, 142, 0.2)'
					}
				}],
				xAxes: [{
					ticks: {
						display: true,
						fontColor: "#77778e",
					},
					gridLines: {
						display: false,
						color: 'rgba(119, 119, 142, 0.2)'
					}
				}]
			},
			legend: {
				labels: {
					fontColor: "#77778e"
				},
			},
		}
	});
});