Ext.define('App.Monitoring.Dashboard', {
	requires: [
        'Ext.data.*',
        'Ext.container.Viewport',
        'Ext.layout.container.Border',
    	],
    
	init: function() {
        	Ext.QuickTips.init();
        	
        	Ext.create('Ext.Viewport', {
        		layout: {
        			type: 'border',
        			padding: 5
        		},
        		defaults: {
	            	split: true
	       	},
            	items:[{
				region: 'west',
				collapsible: true,
				title: 'Server List',
				width: '15%',
				layout: 'fit',
				items: [{
					xtype: 'dashboard-serverlistpanel',
					border: false,
					id: 'dashboard-serverlist',
					listeners: {
						'navclick': function (grid, serverid) {
							this.syncNavigation(serverid);
						},
						scope: this,
					}
				}]
			}, {
				xtype: 'panel',
				id: 'content-panel',
				region: 'center',
				layout: 'border',
				border: false,
				defaults: {
					split: true,
				},
				items: [{
					xtype: 'panel',
					region: 'north',
					border: false,
					height: '40%',
					layout: 'border',
					defaults: {
						split: true	
					},
					items: [{
						region: 'west',
						width: '80%',
						layout: 'fit',
						items: [{
							xtype: 'dashboard-cpuusagepanel',
							border: false,
							id: 'dashboard-cpuusagepanel'
						}]
					}, {
						xtype: 'panel',
						region: 'center',
						border: false,
						layout: 'border',
						defaults: {
							split: true,
						},
						items: [{
							xtype: 'panel',
							region: 'center',
							border: false,
							layout: 'fit',
							items: [{
								xtype: 'dashboard-cpupanel',
								border: false,
								id: 'dashboard-cpupanel'
							}]
						}, {
							xtype: 'panel',
							region: 'east',
							width: '100%',
							border: false,
							layout: 'fit',
							items: [{
								xtype: 'dashboard-memorypanel',
								border: false,
								id: 'dashboard-memorypanel'
							}]
						}]
					}, {
						region: 'east',
						width: '80%',
						layout: 'fit',
						items: [{
							xtype: 'dashboard-memoryusagepanel',
							border: false,
							id: 'dashboard-memusagepanel'
						}]
					}]
				}, {
					xtype: 'panel',
					region: 'center',
					border: false,
					layout: 'border',
					defaults: {
						split: true	
					},
					items: [{
						region: 'center',
						border: false,
						layout: 'fit',
						items: [{
							xtype: 'dashboard-mplistpanel',
							id: 'dashboard-mplist',
						}]
					}, {
						region: 'east',
						width: '100%',
						border: false,
						layout: 'fit',
						items: [{
							xtype: 'panel',
							layout: 'border',
							border: false,
							defaults: {
								split: true	
							},
							items: [{
								region: 'center',
								layout: 'fit',
								items: [{
									xtype: 'dashboard-cpuusagehistory',
									border: false,
									id: 'dashboard-cpuhistorypanel',
								}]
							}, {
								region: 'south',
								height: '50%',
								layout: 'fit',
								items: [{
									xtype: 'dashboard-memoryusagehistory',
									border: false,
									id: 'dashboard-memhistorypanel',
								}]
							}]
						}]
					}]
				}]
			}]
		});
		
	},
	
	updateComponent: function(serverid) {
		var mplist = Ext.getCmp('dashboard-mplist'),
			cpugauge = Ext.getCmp('dashboard-cpuusagepanel'),
			memgauge = Ext.getCmp('dashboard-memusagepanel'),
			cpuhist = Ext.getCmp('dashboard-cpuhistorypanel'),
			memhist = Ext.getCmp('dashboard-memhistorypanel'),
			cpudata = Ext.getCmp('dashboard-cpupanel');
		mplist.setServerId(serverid);
		cpugauge.setServerId(cpugauge, serverid);
		memgauge.setServerId(memgauge, serverid);
		cpuhist.setServerId(cpuhist, serverid);
		memhist.setServerId(memhist, serverid);
		cpudata.setServerId(cpudata, serverid);
	},
	
	syncNavigation: function(serverid) {
		this.updateComponent(serverid);
	},
	
});