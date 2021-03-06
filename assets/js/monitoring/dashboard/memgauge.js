Ext.define('UsageData', {
  	extend: 'Ext.data.Model',
  	fields: [
  		{name: 'usagedata', type: 'number'},
  	],
});

Ext.define('App.Monitoring.Dashboard.MemoryUsagePanel', {
	requires: [
		'Ext.data.*',
		'Ext.panel.*',
		'Ext.chart.*', 
		'Ext.chart.axis.Gauge', 
		'Ext.chart.series.*',
	],
	
    	extend: 'Ext.panel.Panel',
    	alias: 'widget.dashboard-memoryusagepanel',
	title: 'Memory Usage Chart',
	
	layout: {
       	type: 'hbox',
       	align: 'stretch',
   	},
    	
    	initComponent: function() {
    		this.store = Ext.create('Ext.data.Store', {
			model: 'UsageData',
			remoteSort: true,
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: site_url+'/monitoring/dashboard/getmemusage',
		 		reader: {
		            	type: 'json',
		            	root: 'data',
		            	totalProperty: 'total'
		        	}
	       	},
	       	autoLoad: true,
	       	autoDestroy: true,
	   	});
	   	
	   	this.items = [{
  			xtype: 'chart',
  			style: 'background:#fff',
       		animate: {
           		easing: 'bounceOut',
           		duration: 500
       		},
       		store: this.store,
       		insetPadding: 25,
       		flex: 1,
       		axes: [{
           		type: 'gauge',
           		position: 'gauge',
           		minimum: 0,
           		maximum: 100,
           		steps: 10,
           		margin: 7
       		}],
       		series: [{
       			type: 'gauge',
           		field: 'usagedata',
           		donut: 70,
           		colorSet: ['#3AA8CB', '#ddd'],
           		tips: {
          			trackMouse: true,
                    	width: 130,
                    	height: 40,
                    	renderer: function(storeItem, item) {
                        		this.setTitle(storeItem.get('usagedata') + '% utilization ');
                    	}
                	},
       		}]
   		}];
	   	
	   	this.callParent(arguments);
	   	this.memstore = this.store;
    	},
    	
    	setServerId: function(obj, serverid) {
    		obj.memstore.load({params: {serverid: serverid}});
    	},
});