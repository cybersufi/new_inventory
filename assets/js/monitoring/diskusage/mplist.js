Ext.define('DiskData', {
  	extend: 'Ext.data.Model',
  	fields: [
  		{name: 'mpid', type: 'string'},
  		{name: 'serverid', type: 'string'},
      	{name: 'mpname', type: 'string'},
 		{name: 'totalsize', type: 'number'},
 		{name: 'usedsize', type: 'number'},
 		{name: 'freesize', type: 'number'},
 		{name: 'usage', type: 'number'},
  	],
});

Ext.define('App.Monitoring.DiskUsage.MpListPanel', {
	requires: [
		'Ext.data.*',
		'Ext.grid.Panel',
	],
	
    	extend: 'Ext.grid.Panel',
    	alias: 'widget.diskusage-mplistpanel',
	title: 'Mountpoint List',
	autoScroll: true,
	columns: [{
        	dataIndex: 'mpname',
        	id: 'mpname',
        	header: 'Mountpoint Name',
        	sortable: true,
        	flex: 1,
    	}, {
        	dataIndex: 'totalsize',
        	id: 'totalsize',
        	header: 'Total Size',
        	sortable: true,	
        	flex: 0.5,
    	}, {
        	dataIndex: 'usedsize',
        	id: 'usedsize',
        	header: 'Used Size',
        	sortable: true,
        	flex: 0.5,
    	},{
        	dataIndex: 'freesize',
        	id: 'freesize',
        	header: 'Free Size',
        	sortable: true,
        	flex: 0.5,
    	},{
        	dataIndex: 'usage',
        	id: 'usage',
        	header: 'Usage %',
        	sortable: true,
        	flex: 0.5,
    	}, ],
    	
    	viewConfig: {
    		forceFit: true,
    		emptyText: 'No record found',
    	},
    	
    	listeners: {
        	'itemclick': function(view, rec) {
            	this.fireEvent('itmclick', this, rec);
        	}
    	},
    
    	initComponent: function() {
    		this.store = Ext.create('Ext.data.Store', {
			pageSize: 50,
			model: 'DiskData',
			remoteSort: true,
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: site_url+'/monitoring/diskusage/getmplist',
		 		reader: {
		            	type: 'json',
		            	root: 'data',
		            	totalProperty: 'total'
		        	}
	       	},
	       	//autoLoad: true,
	       	autoDestroy: true,
	   	});
	   	
	   	this.callParent(arguments);
	   	this.st = this.store;
    	},
    	
    	setServerId: function(serverid) {
    		Ext.getCmp('diskusage-mplist').getStore().load({params: {serverid: serverid}});
    	},
});