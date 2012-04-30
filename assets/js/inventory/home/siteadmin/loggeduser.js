Ext.define('App.Inventory.SiteAdmin.LoggedUserPanel', {
	requires: [
        'Ext.panel.Panel',
    	],
    	
    	extend: 'Ext.panel.Panel',
    	alias: 'widget.siteadmin-loggeduserpanel',
    
    	title: 'Logged User',
    
    	initComponent: function() {
    		this.items = [{
            	xtype: 'siteadmin-loggedusergrid',
            	id: 'loggeduser-grid',
            	border: false
	     }];
	     
	     this.callParent(arguments);
	     this.grid = Ext.getCmp('loggeduser-grid');
    	},
    	
    	reloadGrid: function() {
    		this.grid.getStore().load();
    	}
	
});

Ext.define('App.Inventory.SiteAdmin.LoggedUserGrid', {
	requires: [
		'Ext.data.*',
		'Ext.grid.Panel',
	],
	
    	extend: 'Ext.grid.Panel',
    	alias: 'widget.siteadmin-loggedusergrid',
    
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
        	header: 'User group',
        	sortable: true,
    	}, {
        	dataIndex: 'ipaddress', 
        	header: 'IP Address',
        	sortable: true,
    	}, {
        	dataIndex: 'lastactivity', 
        	header: 'Last Activity',
        	sortable: true,
    	}],
    
    	initComponent: function() {
    		Ext.define('LoggedUser', {
		  	extend: 'Ext.data.Model',
		  	fields: [
		      	{name: 'lastactivity', type: 'string'},
		 		{name: 'userid', type: 'string'},
		 		{name: 'username', type: 'string'},
		 		{name: 'ipaddress', type: 'string'},
		 		{name: 'usergroup', type: 'string'}
	       	],
	   	});
		   
		this.store = Ext.create('Ext.data.Store', {
			model: 'LoggedUser',
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: site_url+'/siteadmin/user/getloggeduserlist',
		 		reader: {
		            	type: 'json',
		            	root: 'data'
		        	}
	       	},
	       	autoLoad: true,
	   	});
	   	
    		this.callParent(arguments);
    	},
});