Ext.define('CpuData', {
  	extend: 'Ext.data.Model',
  	fields: [
  		{name: 'cpuusage', type: 'number'},
  		{name: 'cpuidle', type: 'number'},
  	],
});

Ext.define('App.Monitoring.Dashboard.CpuPanel', {
	requires: [
		'Ext.data.*',
		'Ext.panel.*',
	],
	
    	extend: 'Ext.panel.Panel',
    	alias: 'widget.dashboard-cpupanel',
    	border: false,
    	layout: 'fit',
    	
    	initComponent: function() {
    		
    		this.store = Ext.create('Ext.data.Store', {
			model: 'CpuData',
			remoteSort: true,
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: site_url+'/monitoring/dashboard/getcpudata',
		 		reader: {
		            	type: 'json',
		            	root: 'data',
		            	totalProperty: 'total'
		        	}
	       	},
	       	autoDestroy: true,
	   	});
    		
    		/*this.cudata = Ext.create('Ext.Panel',{
			id: 'cpu-usage',
			xtype: 'panel',
			title: 'CPU Usage',
			html: '<table width="100%" height="100%"><tr><td align="center" bgcolor="white"><b><font size="30em"> </font></b></td></tr></table>',
		});*/
    		
    		this.items = [{
  			xtype: 'panel',
  			layout: 'border',
  			border: false,
  			defaults: {
  				split: true,
  			},
  			items: [{
  				xtype: 'panel',
  				region: 'center',
  				layout: 'fit',
  				border: false,
  				items: [{
  					xtype: 'cpudata-cpuusage',
  					title: 'CPU Usage'
  				}],
  			}, {
  				region: 'south',
  				layout: 'fit',
  				border: false,
  				height: '50%',
  				items: [{
  					xtype: 'panel',
  					title: 'CPU Idle',
  					id: 'cpu-idle',
  					html: '<table width="100%" height="100%"><tr><td align="center"><b><font size="30em"> </font></b></td></tr></table>'
  				}]
  			}]
   		}];
	   	
	   	this.callParent(arguments);
	   	this.cpuusage = this.store;
	   	this.changeValue(0, 0);
    	},
    	
    	changeValue: function(cpuusage, cpuidle) {
    		this.down('cpudata-cpuusage').loadRecord(cpuusage);
    		
    		//var usagepanel = this.cdata;
    		//var usagepanel = this.up('cpu-usage');
    		//var usagetpl = Ext.create('Ext.Template','<table width="100%" height="100%"><tr><td align="center" bgcolor="{usagecolor}"><b><font size="30em">{cpuusage}</font></b></td></tr></table>');
    		//usagetpl.overwrite(this.cdata, usagedata);
    		//this.cdata.doComponentLayout();
	    	///usagepanel.highlight('#c3daf9', {block:true});
	    	//alert(usagepanel.html);
    		
    		//var idledata = {
    		//	usagecol: 'white',
    		//	cpuidle: cpuidle,
    		//};
    		//var idlepanel = Ext.getCmp('cpu-idle');
    		//var idletpl = new Ext.XTemplate('<table width="100%" height="100%"><tr><td align="center" bgcolor="yellow"><b><font size="30em">{cpuidle}</font></b></td></tr></table>');
    		//idletpl.overwrite(idlepanel.body, idledata);
	    	//idlepanel.body.highlight('#c3daf9', {block:true});
    		
    	},
    	
    	setServerId: function(obj, serverid) {
    		obj.cpuusage.load({params: {serverid: serverid}});
    		//alert(obj.cpuusage.getAt(0).get('cpuusage'));
    	},
});