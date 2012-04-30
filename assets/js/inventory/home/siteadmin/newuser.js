Ext.define('App.Inventory.SiteAdmin.NewUserPanel', {
	requires: [
        'Ext.panel.Panel',
    	],
    	
    	extend: 'Ext.panel.Panel',
    	alias: 'widget.siteadmin-newuserpanel',
    
    	title: 'Logged User',
    
    	initComponent: function() {
    		this.items = [{
            	xtype: 'siteadmin-newusergrid',
            	id: 'newuser-grid',
            	forceFit: true,
            	border: false
	     }];
	     
	     this.callParent(arguments);
	     this.grid = Ext.getCmp('newuser-grid');
    	},
    	
    	reloadGrid: function() {
    		this.grid.getStore().load();
    	}

});

Ext.define('App.Inventory.SiteAdmin.NewUserGrid', {
	requires: [
		'Ext.data.*',
		'Ext.grid.Panel',
	],
	
    	extend: 'Ext.grid.Panel',
    	alias: 'widget.siteadmin-newusergrid',
    
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
        	dataIndex: 'email', 
        	header: 'User Email',
        	sortable: true,
    	}, {
        	dataIndex: 'status', 
        	header: 'User Status', 
        	sortable: true,
    	}],
    
    	initComponent: function() {
    		Ext.define('NewUser', {
		  	extend: 'Ext.data.Model',
		  	fields: [
		      	{name: 'userid', type: 'string'},
		 		{name: 'username', type: 'string'},
		 		{name: 'email', type: 'string'},
		 		{name: 'status', type: 'string'},
	       	],
	   	});
		   
		this.store = Ext.create('Ext.data.Store', {
			model: 'NewUser',
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: site_url+'/siteadmin/user/getnewuserlist',
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