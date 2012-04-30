Ext.define('App.Inventory.SiteAdmin.Mainpage', {
	requires: [
        'Ext.container.Viewport',
        'Ext.layout.container.Border',
    	],
    
	init: function() {
        	Ext.QuickTips.init();
        	
        	Ext.create('Ext.container.Viewport', {
        		autoScroll: true,
        		minWidth: 1024,
        		minHeight: 600,
        		renderTo: Ext.getBody(),
            	layout: {
            		type: 'border',
            		padding: 5
        		},
	        	defaults: {
            		split: true
	        	},

            	items:[{
            		region: 'center',
            		border: false,
            		autoScroll: true,
            		minWidth: 400,
            		minHeight: 600,
            		layout: 'fit',
            		items: [{
					title: 'User Statistic',
					xtype: 'siteadmin-userstatpanel',
					id: 'siteadmin-userstatistic',
				}]
            	}, {
				region: 'east',
				collapsible: true,
				collapsed: true,
				title: 'User Information',
				width: 400,
				minWidth: 400,
            		minHeight: 600,
				border: false,
				layout: 'border',
				items: [{
					region: 'center',
					xtype: 'panel',
					id: 'siteadmin-gridpanel',
					layout: 'accordion',
					items: [{
						title: 'Logged User',
						xtype: 'siteadmin-loggeduserpanel',
						layout: 'fit',
						tools: [{
							type:'refresh',
							handler: function() {
								Ext.getCmp('siteadmin-loggeduser').reloadGrid();	
							},
						}],
						id: 'siteadmin-loggeduser',
					}, {
						title: 'New User',
						xtype: 'siteadmin-newuserpanel',
						layout: 'fit',
						tools: [{
							type:'refresh',
							handler: function() {
								Ext.getCmp('siteadmin-newuser').reloadGrid();	
							},
						}],
						id: 'siteadmin-newuser',
					}],
				}]
			}]
		});
	},
});