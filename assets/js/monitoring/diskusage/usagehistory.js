Ext.define('HistoryData', {
  	extend: 'Ext.data.Model',
  	fields: [
  		{name: 'historydate', type: 'string'},
  		{name: 'historydata', type: 'number'},
  	],
});

Ext.define('App.Monitoring.DiskUsage.HistoryPanel', {
	requires: [
		'Ext.data.*',
		'Ext.grid.Panel',
		'Ext.chart.*',
	],
	
    	extend: 'Ext.panel.Panel',
    	alias: 'widget.diskusage-usagehistory',
	title: 'Usage History',
    	
    	layout: 'fit',
    	
    	initComponent: function() {
    		this.store = Ext.create('Ext.data.Store', {
			//pageSize: 50,
			model: 'HistoryData',
			remoteSort: true,
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: site_url+'/monitoring/diskusage/getusagehistory',
		 		reader: {
		            	type: 'json',
		            	root: 'data',
		            	totalProperty: 'total'
		        	}
	       	},
	       	autoLoad: true,
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
   				name: 'sdate',
   				id: 'sdate',
			    	width:100,
			    	allowBlank:false,
			    	editable:false,
		    		value: firstdate,
   			}, {
   				xtype: 'tbtext', 
   				text: 'To:'
   			}, {
   				xtype: 'datefield',
   				name: 'fdate',
   				id: 'fdate',
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
	   	this.ustore = this.store;
	   	this.mpname = null;
	   	this.serverid = null;
    	},
    	
    	onGoButtonClick: function() {
    		var sdate = Ext.getCmp('sdate').getValue();
    		var fdate = Ext.getCmp('fdate').getValue();
    		Ext.getCmp('diskusage-historypanel').ustore.load({
    			params:{
    				mpname: this.mpname, 
    				serverid: this.serverid,
    				sdate: sdate,
    				fdate: fdate,
    			}
    		});
    	},
    	
    	setMpName: function(mpname, serverid) {
    		var sdate = Ext.getCmp('sdate').getValue();
    		var fdate = Ext.getCmp('fdate').getValue();
    		this.mpname = mpname;
    		this.serverid = serverid;
    		Ext.getCmp('diskusage-historypanel').ustore.load({
    			params:{
    				mpname: this.mpname, 
    				serverid: this.serverid,
    				sdate: sdate,
    				fdate: fdate,
    			}
    		});
    	},
});