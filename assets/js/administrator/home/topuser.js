Ext.define('App.Inventory.SiteAdmin.TopUserPanel', {
	requires: [
        'Ext.panel.Panel',
    	],
    	
    	extend: 'Ext.panel.Panel',
    	alias: 'widget.siteadmin-topuserpanel',
    
    	title: 'Top 10 User',
    
    	initComponent: function() {
    		this.items = [{
            	xtype: 'siteadmin-topusergrid',
            	id: 'topuser-grid',
            	border: false
	     }];
	     
	     this.callParent(arguments);
	     this.grid = Ext.getCmp('topuser-grid');
    	},
    	
    	reloadGrid: function() {
    		this.grid.getStore().load();
    	}

});

Ext.define('App.Inventory.SiteAdmin.TopUserGrid', {
	requires: [
		'Ext.data.*',
		'Ext.grid.Panel',
	],
	
    	extend: 'Ext.grid.Panel',
    	alias: 'widget.siteadmin-topusergrid',
    
	xtype: 'grid',

    	columns: [{
        	dataIndex: 'userid', 
        	header: 'User ID',
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
    		Ext.define('TopUser', {
		  	extend: 'Ext.data.Model',
		  	fields: [
		      	{name: 'userid', type: 'string'},
		 		{name: 'username', type: 'string'},
		 		{name: 'usergroup', type: 'string'},
		 		{name: 'total', type: 'string'},
	       	],
	   	});
		   
		this.store = Ext.create('Ext.data.Store', {
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
	   	
    		this.callParent(arguments);
    	}
});