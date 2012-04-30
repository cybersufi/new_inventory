Ext.define('HistoryData', {
  	extend: 'Ext.data.Model',
  	fields: [
  		{name: 'historydate', type: 'string'},
  		{name: 'historydata', type: 'number'},
  	],
});

Ext.define('App.Monitoring.Dashboard.CpuHistoryPanel', {
	requires: [
		'Ext.data.*',
		'Ext.grid.Panel',
		'Ext.chart.*',
	],
	
    	extend: 'Ext.panel.Panel',
    	alias: 'widget.dashboard-cpuusagehistory',
	title: 'CPU Usage History',
    	
    	layout: 'fit',
    	
    	initComponent: function() {
    		this.store = Ext.create('Ext.data.Store', {
			model: 'HistoryData',
			remoteSort: true,
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: site_url+'/monitoring/dashboard/getcpuhistory',
		 		reader: {
		            	type: 'json',
		            	root: 'data',
		            	totalProperty: 'total'
		        	}
	       	},
	       	//autoLoad: true,
	       	autoDestroy: true,
	   	});
	   	
	   	var currdate =  new Date();
    		var firstdate = (currdate.getMonth() + 1) + "/1/" + currdate.getFullYear();
	   	
	   	this.dockedItems = [{
	   		dock: 'top',
	   		xtype: 'toolbar',
	   		items: [{
   				xtype: 'tbtext', 
   				text: 'Showing from:'
   			}, {
   				xtype: 'datefield',
   				name: 'csdate',
   				id: 'csdate',
			    	width:100,
			    	allowBlank:false,
			    	editable:false,
		    		value: firstdate,
   			}, {
   				xtype: 'tbtext', 
   				text: 'To:'
   			}, {
   				xtype: 'datefield',
   				name: 'cfdate',
   				id: 'cfdate',
			    	width:100,
			    	allowBlank:false,
			    	editable:false,
		    		value: currdate,
   			}, {
	            	text: 'Go',
	            	handler: this.onGoButtonClick,
	            	scope: this,
	        	},]
	   	}];
	   	
	   	this.items = [{
	  		xtype: 'chart',
	       	style: 'background:#fff',
	       	flex: 1,
   			shadow: true,
   			animate: true,
   			store: this.store,
			axes: [{
				type: 'Numeric',
       			position: 'left',
       			fields: ['historydata'],
       			label: {
       				renderer: Ext.util.Format.numberRenderer('0,0'),
       				font: '9px Arial',
                	},
       			minimum: 0,
       			minorTickSteps: 1,
               	grid: {
     	     		odd: {
                        		opacity: 1,
                        		fill: '#ddd',
	                        	stroke: '#bbb',
	                        	'stroke-width': 0.5
                    	}
                   }
			}, {
  				type: 'Category',
       			position: 'bottom',
       			fields: ['historydate'],
       			label: {
      				renderer: function(v) {
	     				return Ext.String.ellipsis(v, 15, false);
           			},
           			font: '9px Arial',
           			rotate: {
          				degrees: 315
           			}
       			}
   			}],
   			series: [{
  				type: 'line',
       			axis: 'left',
       			highlight: true,
       			tips: {
          			trackMouse: true,
                    	width: 130,
                    	height: 40,
                    	renderer: function(storeItem, item) {
                        		this.setTitle(storeItem.get('historydata') + '% utilization in<br /> ' + storeItem.get('historydate'));
                    	}
                	},
       			style: {
           			fill: '#456d9f'
       			},
       			highlightCfg: {
           			fill: '#a2b5ca'
       			},
       			label: {
       				font: '9px Arial',
           			display: 'outsideEnd',
           			field: 'historydata',
           			color: '#000',
           			orientation: 'vertical',
           			'text-anchor': 'right'
       			},
       			xField: 'historydate',
       			yField: ['historydata'],
   			}],
	   	}];
	   	
	   	this.callParent(arguments);
	   	this.cpustore = this.store;
	   	this.serverid = null;
    	},
    	
    	onGoButtonClick: function() {
    		var sdate = Ext.getCmp('csdate').getValue();
    		var fdate = Ext.getCmp('cfdate').getValue();
    		Ext.getCmp('dashboard-cpuhistorypanel').cpustore.load({
    			params:{
    				serverid: this.serverid,
    				sdate: sdate,
    				fdate: fdate,
    			}
    		});
    	},
    	
    	setServerId: function(obj, serverid) {
    		var sdate = Ext.getCmp('csdate').getValue();
    		var fdate = Ext.getCmp('cfdate').getValue();
    		this.serverid = serverid;
    		obj.cpustore.load({
    			params:{
    				serverid: this.serverid,
    				sdate: sdate,
    				fdate: fdate,
    			}
    		});
    	},
});