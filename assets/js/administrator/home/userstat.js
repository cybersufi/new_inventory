Ext.define('App.Inventory.SiteAdmin.UserStatPanel', {
	requires: [
        'Ext.panel.Panel',
    	],
    	
    	extend: 'Ext.panel.Panel',
    	alias: 'widget.siteadmin-userstatpanel',
    	
    	minWidth: 800,
    	minHeigth: 720,
    	
    	title: 'User Statistic',
    	bodyPadding: 5,
    	
    	layout: {
       	type: 'vbox',
       	align: 'stretch'
   	},
    
    	initComponent: function() {
    		
    		Ext.define('TopUser', {
		  	extend: 'Ext.data.Model',
		  	fields: [
		      	{name: 'userid', type: 'string'},
		 		{name: 'username', type: 'string'},
		 		{name: 'usergroup', type: 'string'},
		 		{name: 'total', type: 'string'},
	       	],
	   	});
		   
		var st = Ext.create('Ext.data.Store', {
			model: 'TopUser',
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: top_user_url,
		 		reader: {
		            	type: 'json',
		            	root: 'data'
		        	}
	       	},
	       	autoLoad: true,
	   	});
    		
    		this.items = [{
      		height: 150,
           	layout: 'fit',
           	margin: '0 0 3 0',
           	items: [{
           		xtype: 'siteadmin-topuserchart',
            		id: 'topuser-chart',
            		store: st,
            		border: true,
            		listeners: {
            			'itemclick': function(item, storeItem) {
            				this.selectItem(storeItem);
            			},
            			scope: this
            		}
           	}]
       	}, {
       		layout: {type: 'hbox', align: 'stretch'},
            	flex: 3,
            	border: false,
            	bodyStyle: 'background-color: transparent',
            	items: [{
            		xtype: 'siteadmin-topusergrid',
            		id: 'topuser-grid',
            		width: '200',
            		store: st,
            		forceFit: true,
            		border: true,
            		listeners: {
            			'itemclick': function(row, record) {
            				this.selectItem(record);
            			},
            			scope: this
            		}
            	}, {
           		flex: 0.3,
           		layout: 'fit',
                	margin: '0 0 0 3',
                	title: 'User Details',
                	items: [{
            			xtype: 'siteadmin-topuserhistory',
	            		id: 'topuser-history',
	            		autoscrol: true,
	            		forceFit: true,
	            		border: false
	            	}]
          	}]
	     }];
	     
	     this.callParent(arguments);
	     this.grid = Ext.getCmp('topuser-grid');
	     this.barchart = Ext.getCmp('topuser-chart');
	     this.historygrid = Ext.getCmp('topuser-history');
	     this.barchart.series.get(0).highlight = false;
    	},
    	
	selectItem: function(storeItem) {
		var userid = storeItem.get('userid');
		//this.barchart.series.get(0).highlight = false;
		this.barchart.series.get(0).cleanHighlights();
		this.barchart.selectItem(storeItem);
		this.grid.selectItem(storeItem);
		this.historygrid.setValues(storeItem.get('userid'));
        	
	}
});

Ext.define('App.Inventory.SiteAdmin.TopUserGrid', {
	requires: [
		'Ext.data.*',	
		'Ext.grid.Panel',
	],
	
    	extend: 'Ext.grid.Panel',
    	alias: 'widget.siteadmin-topusergrid',
   	id: 'topuser-grid',
   	flex: 0.60,
   	title:'Top User Data',

   	columns: [{
        	dataIndex: 'userid', 
        	header: 'User ID',
        	width: 50,
        	sortable: true,
    	}, {
        	dataIndex: 'username', 
        	header: 'User Name',
        	sortable: true,
    	}, {
        	dataIndex: 'usergroup', 
        	header: 'User Group',
        	sortable: true,
    	}, {
        	dataIndex: 'total', 
        	header: 'Total Logged In',
        	sortable: true,
    	}],
	
	initComponent: function() {
    		this.callParent(arguments);
	},
	
   	listeners: {
       	selectionchange: function(model, records) {
       		if (records[0]) {
       			this.fireEvent('itemclick', this, records[0]);
       		}
       	}
   	},
   	
   	selectItem: function(storeItem) {
		selectionModel = this.getSelectionModel(); 
      	selectionModel.select(storeItem);
        	
	}
});

Ext.define('App.Inventory.SiteAdmin.TopUserChart', {
	requires: [
		'Ext.data.*',	
		'Ext.chart.Chart',
	],
	
    	extend: 'Ext.chart.Chart',
    	alias: 'widget.siteadmin-topuserchart',
   	id: 'topuser-chart',
   	
   	flex: 1,
   	shadow: true,
   	animate: true,
	axes: [{
		type: 'Numeric',
       	position: 'left',
       	fields: ['total'],
       	minimum: 0,
       	hidden: true
	}, {
  		type: 'Category',
       	position: 'bottom',
       	fields: ['username'],
       	label: {
      		renderer: function(v) {
	     		return Ext.String.ellipsis(v, 15, false);
           	},
           	font: '9px Arial',
           	rotate: {
          		degrees: 270
           	}
       	}
   	}],
   	series: [{
  		type: 'column',
       	axis: 'left',
       	highlight: true,
       	style: {
           	fill: '#456d9f'
       	},
       	highlightCfg: {
           	fill: '#a2b5ca'
       	},
       	label: {
           	contrast: true,
           	display: 'insideEnd',
           	field: 'total',
           	color: '#000',
           	orientation: 'vertical',
           	'text-anchor': 'middle'
       	},
       	listeners: {
           	'itemmouseup': function(item) {
           		selectedStoreItem = item.storeItem;
           		Ext.getCmp('topuser-chart').itemClick(item.storeItem);
           		return true;
           	},	
       	},
       	xField: 'username',
       	yField: ['total'],
   	}],
   	
   	itemClick: function(storeItem) {
   		this.fireEvent('itemclick', this, storeItem);
   	},
   	
   	selectItem: function(storeItem) {
       	var name = storeItem.get('username'),
           	series = this.series.get(0),
           	i, items, l;
       
       	series.highlight = true;
       	series.unHighlightItem();
       	series.cleanHighlights();
       	for (i = 0, items = series.items, l = items.length; i < l; i++) {
           	if (name == items[i].storeItem.get('username')) {
               	selectedStoreItem = items[i].storeItem;
               	series.highlightItem(items[i]);
               	break;
           	}
       	}
       	series.highlight = false;
	},
});

Ext.define('App.Inventory.SiteAdmin.TopUserHistory', {
	requires: [
		'Ext.data.*',	
		'Ext.grid.Panel',
	],
	
    	extend: 'Ext.grid.Panel',
    	alias: 'widget.siteadmin-topuserhistory',
   	id: 'topuser-history',
   	
	columns: [{
        	dataIndex: 'datetime', 
        	header: 'Login Time',
        	sortable: false,
    	}, {
        	dataIndex: 'ipaddress', 
        	header: 'Loggin From',
        	sortable: false,
    	}],
	
	initComponent: function() {
		Ext.define('UserHistory', {
		  	extend: 'Ext.data.Model',
		  	fields: [
		      	{name: 'datetime', type: 'string'},
		 		{name: 'ipaddress', type: 'string'},
	       	],
	   	});
		   
		this.store = Ext.create('Ext.data.Store', {
			model: 'UserHistory',
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: top_user_hist,
		 		reader: {
		            	type: 'json',
		            	root: 'data'
		        	}
	       	},
	       	autoLoad: true,
	   	});
	   	
    		this.callParent(arguments);
	},
	
	setValues: function(userid) {
		//alert(userid);
		var store = this.getStore()
		store.load({
			params: {
				userid: userid
			}
		})
  		//store.setBaseParam('userid', userid);
  		//store.reload();
	}
});
