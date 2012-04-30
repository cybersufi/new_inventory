Ext.define('App.Inventory.SiteAdmin.GroupList', {
	requires: [
        'Ext.container.Viewport',
        'Ext.layout.container.Border',
    	],
    
	init: function() {
        	Ext.QuickTips.init();
        	
        	Ext.create('Ext.container.Viewport', {
        		renderTo: Ext.getBody(),
            	layout: 'border',
            	minWidth: 600,
  			minHeight: 400,
            	items:[{
            		region: 'center',
            		border: false,
            		layout: 'fit',
            		items: [{
					title: 'User Group List',
					xtype: 'siteadmin-grouplistpanel',
					id: 'siteadmin-grouplist',
					tools: [{
						type:'refresh',
						handler: function() {
							var grid = Ext.getCmp('siteadmin-grouplist');
							grid.getStore().load();
						},	
						scope: this,
					}],
				}]
            	}]
		});
	},
});
