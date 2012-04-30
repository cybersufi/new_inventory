Ext.Loader.setConfig({enabled: true});
Ext.Loader.setPath('Ext.ux', '../../../ext/ux');

Ext.define('ServerData', {
  	extend: 'Ext.data.Model',
  	fields: [
  		{name: 'serverid', type: 'string'},
      	{name: 'servername', type: 'string'},
  	],
});

Ext.define('App.Monitoring.DiskUsage.ServerListPanel', {
	requires: [
		'Ext.data.*',
		'Ext.grid.*',
		'Ext.util.*',
		'Ext.grid.Panel',
    		'Ext.ux.form.SearchField',
	],
	
    	extend: 'Ext.grid.Panel',
    	alias: 'widget.diskusage-serverlistpanel',
	
	columns: [{
        	dataIndex: 'servername',
        	id: 'servername',
        	header: 'Server Name',
        	flex: 1,
    	}],
    	
    	autoScroll: true,
    	hideHeaders: true,
    	
    	viewConfig: {
    		forceFit: true,
    		emptyText: 'No record found',
    	},
    	
    	listeners: {
        	'itemclick': function(view, rec) {
            	this.fireEvent('navclick', this, rec.get('serverid'));
        	}
    	},
    	
    	initComponent: function() {
    		this.store = Ext.create('Ext.data.Store', {
			model: 'ServerData',
			remoteSort: true,
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: site_url+'/monitoring/diskusage/getserverlist',
		 		reader: {
		            	type: 'json',
		            	root: 'data',
		            	totalProperty: 'total'
		        	}
	       	},
	       	autoLoad: true,
	       	autoDestroy: true,
	   	});
	   	
	   	this.dockedItems = [{
	   		dock: 'top',
	   		xtype: 'toolbar',
	   		items: {
           		xtype: 'searchfield',
                	store: this.store,
                	flex: 1,
            	}
	   	}];
	   	
    		this.callParent(arguments);
    	},
});