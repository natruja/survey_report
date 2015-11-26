   $(document).ready(function() {
   	 	      	var options = {
        			 chart: {
        			  	renderTo: 'total',
			            plotBackgroundColor: null,
		                plotBorderWidth: null,
		                plotShadow: false,
			            options3d: {
			                enabled: true,
			                alpha: 30,
			                beta: 0
		            	}
			        },
            		 title: {
                			text: 'ข้อมูลการโทรที่ติดต่อได้' //
           			 },
           			 tooltip: {
				        formatter: function() {
				            return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2)+' %';
				        }
				         
				    },
				     
           			plotOptions: {
				        pie: {
				            allowPointSelect: true,
				            innerSize: 100,
				            depth: 45,
				            cursor: 'pointer',
				            dataLabels: {
				                // enabled: true,
				                // color: '#000000',
				                // connectorColor: '#000000',
				                formatter: function() {
				                    return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2)+' %';
				                }
				            },
				             showInLegend: true
				        }
				    },
           			 series: [{
           		 			  type: 'pie',
                              name: 'ข้อมูลการโทร',
                              data: [] 
                        }]
                 }
	        	$.getJSON("total.php", function(json) {
	                options.series[0].data = json;
	                chart = new Highcharts.Chart(options);
	            });  
	        	var  chart_new =  {
	          			chart: {
        			  	renderTo: 'type_3bb',
			            plotBackgroundColor: null,
		                plotBorderWidth:  null,
		                plotShadow: false,
			            options3d: {
			                enabled: true,
			                alpha: 30,
			                beta: 0
		            	}
			        },
            		 title: {
                			text: 'ลูกค้าที่ใช้งาน Internet อยู่' //
           			 },
           			 tooltip: {
				        formatter: function() {
				            return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2)+' %';
				        }
				    },
           			plotOptions: {
				        pie: {
				            allowPointSelect: true,
				            innerSize: 100,
				            depth: 45,
				            cursor: 'pointer',
				            dataLabels: {
				                // enabled: true,
				                // color: '#000000',
				                // connectorColor: '#000000',
				                formatter: function() {
				                    return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2)+' %';
				                }
				            },
				             showInLegend: true
				        }
				    },
           			 series: [{
           		 			  type: 'pie',
                              name: 'ข้อมูลการโทร',
                              data: []
                             
                        }]
                        
                 }				 
                 $.getJSON("user_useinter.php", function(data) {
	                chart_new.series[0].data = data;
	                user_use = new Highcharts.Chart(chart_new);           
	            }); 

                 var  upspeed =  {
	          			chart: {
        			  	renderTo: 'upspeed_3bb',
			            plotBackgroundColor: null,
		                plotBorderWidth:  null,
		                plotShadow: false,
			            options3d: {
			                enabled: true,
			                alpha: 30,
			                beta: 0
		            	}
			        },
            		 title: {
                			text: 'ลูกค้าที่ใช้งาน 3BB แล้วต้องการ Up Speed' //
           			 },
           			 tooltip: {
				        formatter: function() {
				            return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2)+' %';
				        }
				    },
           			plotOptions: {
				        pie: {
				            allowPointSelect: true,
				            innerSize: 100,
				            depth: 45,
				            cursor: 'pointer',
				            dataLabels: {
				                // enabled: true,
				                // color: '#000000',
				                // connectorColor: '#000000',
				                formatter: function() {
				                    return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2)+' %';
				                }
				            },
				             showInLegend: true
				        }
				    },
           			 series: [{
           		 			  type: 'pie',
                              name: 'ข้อมูลการโทร',
                              data: []
                             
                        }]
                 }				 
                 $.getJSON("user_bbb_upspeed.php", function(data) {
	                upspeed.series[0].data = data;
	                user_use = new Highcharts.Chart(upspeed);           
	            }); 


			    var  not_3bb =  {
	          			chart: {
        			  	renderTo: 'not-3bb',
			            plotBackgroundColor: null,
		                plotBorderWidth:  null,
		                plotShadow: false,
			            options3d: {
			                enabled: true,
			                alpha: 30,
			                beta: 0
		            	}
			        },
            		 title: {
                			text: 'ลูกค้าที่ไม่ได้ใช้งานของ 3BB แล้วในปัจจุบัน แต่สนใจกลับมาใช้งานของ 3BB อีกในอนาคต' //
           			 },
           			 tooltip: {
				        formatter: function() {
				            return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2)+' %';
				        }
				    },
           			plotOptions: {
				        pie: {
				            allowPointSelect: true,
				            innerSize: 100,
				            depth: 45,
				            cursor: 'pointer',
				            dataLabels: {
				                // enabled: true,
				                // color: '#000000',
				                // connectorColor: '#000000',
				                formatter: function() {
				                    return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2)+' %';
				                }
				            },
				             showInLegend: true
				        }
				    },
           			 series: [{
           		 			  type: 'pie',
                              name: 'ข้อมูลการโทร',
                              data: []
                             
                        }]
                 }				 
                 $.getJSON("user_not_bbb.php", function(data) {
	                not_3bb.series[0].data = data;
	                user_use = new Highcharts.Chart(not_3bb);           
	            }); 


                var  all_value =  {
	          			chart: {
        			  	renderTo: 'all-contact',
			            plotBackgroundColor: null,
		                plotBorderWidth:  null,
		                plotShadow: false,
			            options3d: {
			                enabled: true,
			                alpha: 30,
			                beta: 0
		            	}
			        },
            		 title: {
                			text: 'ภาพรวมการติดต่อลูกค้า' //
           			 },
           			 tooltip: {
				        formatter: function() {
				            return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2)+' %';
				        }
				    },
           			plotOptions: {
				        pie: {
				            allowPointSelect: true,
				            innerSize: 100,
				            depth: 45,
				            cursor: 'pointer',
				            dataLabels: {
				                // enabled: true,
				                // color: '#000000',
				                // connectorColor: '#000000',
				                formatter: function() {
				                    return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2)+' %';
				                }
				            },
				             showInLegend: true
				        }
				    },
           			 series: [{
           		 			  type: 'pie',
                              name: 'ข้อมูลการโทร',
                              data: []
                             
                        }]
                 }				 
                 $.getJSON("all_contact.php", function(data) {
	                all_value.series[0].data = data;
	                user_use = new Highcharts.Chart(all_value);           
	            }); 
	                      
  });   